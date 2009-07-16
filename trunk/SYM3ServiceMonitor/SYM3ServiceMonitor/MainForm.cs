using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using SYM3ServiceMonitor.Properties;

namespace SYM3ServiceMonitor
{
    public partial class MainForm : Form
    {
        public MainForm()
        {
            InitializeComponent();
        }

        protected override void OnLoad(EventArgs e)
        {
            base.OnLoad(e);
            EstablecerIconos();
            Sym3Controller.Instancia.PropertyChanged += new PropertyChangedEventHandler(Instancia_PropertyChanged);
        }

        protected override void OnClosing(CancelEventArgs e)
        {
            base.OnClosed(e);
            Sym3Controller.Instancia.Dispose();
        }

        private void Instancia_PropertyChanged(object sender, PropertyChangedEventArgs e)
        {
            EstablecerIconos();
        }

        private void EstablecerIconos()
        {
            if (Sym3Controller.Instancia.EjecutandoApache)
            {
                this._apacheItem.Image = Resources.green32;
                this._iniciaApacheItem.Enabled = false;
                this._detieneApacheItem.Enabled = true;
            }
            else
            {
                this._apacheItem.Image = Resources.red32;
                this._iniciaApacheItem.Enabled = true;
                this._detieneApacheItem.Enabled = false;
            }

            if (Sym3Controller.Instancia.EjecutandoMysql)
            {
                this._mysqlItem.Image = Resources.green32;
                this._iniciaMysqlItem.Enabled = false;
                this._detieneMysqlItem.Enabled = true;
            }
            else
            {
                this._mysqlItem.Image = Resources.red32;
                this._iniciaMysqlItem.Enabled = true;
                this._detieneMysqlItem.Enabled = false;
            }


        }

        private void _iniciaApacheItem_Click(object sender, EventArgs e)
        {
            Sym3Controller.Instancia.IniciarApache();
        }

        private void _iniciaMysqlItem_Click(object sender, EventArgs e)
        {
            Sym3Controller.Instancia.IniciarMysql();
        }

        private void _detieneApacheItem_Click(object sender, EventArgs e)
        {
            Sym3Controller.Instancia.DetenerApache();
        }

        private void _detieneMysqlItem_Click(object sender, EventArgs e)
        {
            Sym3Controller.Instancia.DetenerMysql();
        }

        private void cerrarMonitorToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
    }
}
