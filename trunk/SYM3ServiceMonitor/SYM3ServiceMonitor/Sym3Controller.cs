using System;
using System.Collections.Generic;
using System.Text;
using System.ServiceProcess;
using System.ComponentModel;

namespace SYM3ServiceMonitor
{
    class Sym3Controller : INotifyPropertyChanged, IDisposable
    {
        /// <summary>
        /// Instancia de la clase singleton
        /// </summary>
        public static Sym3Controller Instancia = new Sym3Controller();

        private ServiceController _httpdController;
        private ServiceController _myqldController;


        private Sym3Controller()
        {
            this._httpdController = new ServiceController("SYM3Httpd");
            this._myqldController = new ServiceController("SYM3Mysqld");
        }

        /// <summary>
        /// Propiedad que expone el estado de ejecucion del servicio
        /// </summary>
        public bool EjecutandoApache
        {
            get
            {
                return ObtenerEstadoServicio(this._httpdController) == ServiceControllerStatus.Running;
            }
        }

        /// <summary>
        /// Propiedad que expone el estado de ejecucion del servicio
        /// </summary>
        public bool EjecutandoMysql
        {
            get
            {
                return ObtenerEstadoServicio(this._myqldController) == ServiceControllerStatus.Running;
            }
        }

        /// <summary>
        /// Inicia el servicio httpd
        /// </summary>
        /// <returns>true si la ccion es llevada a cabo</returns>
        public bool IniciarApache()
        {
            return IniciarServicio(this._httpdController);
        }

        /// <summary>
        /// Inicia el servicio mysqld
        /// </summary>
        /// <returns>true si la ccion es llevada a cabo</returns>
        public bool IniciarMysql()
        {
            return IniciarServicio(this._myqldController);
        }

        /// <summary>
        /// Detiene el servicio httpd
        /// </summary>
        /// <returns>true si la ccion es llevada a cabo</returns>
        public bool DetenerApache()
        {
            return DetenerServicio(this._httpdController);
        }

        /// <summary>
        /// Detiene el servicio mysqld
        /// </summary>
        /// <returns>true si la ccion es llevada a cabo</returns>
        public bool DetenerMysql()
        {
            return DetenerServicio(this._myqldController);
        }

        /// <summary>
        /// Inicia un servicio
        /// </summary>
        /// <param name="servicio">servicio a iniciar</param>
        /// <param name="propiedadAfectada">nombre de la propiedad que se modifica</param>
        /// <returns>true si se completa la accion</returns>
        public bool IniciarServicio(ServiceController servicio)
        {
            bool retorno = false;

            ServiceControllerStatus estadodelServicio = ObtenerEstadoServicio(servicio);

            if (estadodelServicio != ServiceControllerStatus.Running)
            {
                try
                {
                    if (servicio.Status == ServiceControllerStatus.Paused)
                        servicio.Continue();
                    else
                        servicio.Start();
                    servicio.WaitForStatus(ServiceControllerStatus.Running);
                    retorno = true;
                    LanzaCambioPropiedad();
                }
                // si no logra cambiar el estado, simplemente informe que no se logro
                catch
                {
                    retorno = false;
                }

            }
            else retorno = false;
            return retorno;
        }

        private static ServiceControllerStatus ObtenerEstadoServicio(ServiceController servicio)
        {
            ServiceControllerStatus estadodelServicio;
            try
            {
                estadodelServicio = servicio.Status;
            }
            ///se atrapa la excepcion, si no puede retornar el estado es porque el servicio no esta instalado
            ///nunca deberia ocurrir
            catch
            {
                estadodelServicio = ServiceControllerStatus.Stopped;
            }
            return estadodelServicio;
        }

        /// <summary>
        /// Detiene un servicio
        /// </summary>
        /// <param name="servicio">servicio a detener</param>
        /// <param name="propiedadAfectada">nombre de la propiedad que se modifica</param>
        /// <returns>true si se completa la accion</returns>
        private bool DetenerServicio(ServiceController servicio)
        {
            bool retorno = false;
            ServiceControllerStatus estadodelServicio = ObtenerEstadoServicio(servicio);
            if (estadodelServicio != ServiceControllerStatus.Stopped)
            {
                try
                {
                    servicio.Stop();
                    servicio.WaitForStatus(ServiceControllerStatus.Stopped);
                    retorno = true;
                    LanzaCambioPropiedad();
                }
                // si no logra cambiar el estado, simplemente informe que no se logro
                catch
                {
                    retorno = false;
                }
            }
            else retorno = false;

            return retorno;
        }

        #region IDisposable Members

        public void Dispose()
        {
            this._myqldController.Dispose();
            this._httpdController.Dispose();
        }

        #endregion

        #region INotifyPropertyChanged Members

        public event PropertyChangedEventHandler PropertyChanged;

        private void LanzaCambioPropiedad()
        {
            if (null != PropertyChanged)
            {
                PropertyChanged(this, new PropertyChangedEventArgs(String.Empty));
            }
        }

        #endregion
    }
}
