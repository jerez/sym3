namespace SYM3ServiceMonitor
{
    partial class MainForm
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(MainForm));
            this._notifyIcon = new System.Windows.Forms.NotifyIcon(this.components);
            this._contextMenuStrip = new System.Windows.Forms.ContextMenuStrip(this.components);
            this._apacheItem = new System.Windows.Forms.ToolStripMenuItem();
            this._iniciaApacheItem = new System.Windows.Forms.ToolStripMenuItem();
            this._detieneApacheItem = new System.Windows.Forms.ToolStripMenuItem();
            this._mysqlItem = new System.Windows.Forms.ToolStripMenuItem();
            this._iniciaMysqlItem = new System.Windows.Forms.ToolStripMenuItem();
            this._detieneMysqlItem = new System.Windows.Forms.ToolStripMenuItem();
            this.cerrarMonitorToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this._contextMenuStrip.SuspendLayout();
            this.SuspendLayout();
            // 
            // _notifyIcon
            // 
            this._notifyIcon.ContextMenuStrip = this._contextMenuStrip;
            this._notifyIcon.Icon = ((System.Drawing.Icon)(resources.GetObject("_notifyIcon.Icon")));
            this._notifyIcon.Text = "SYM 3 Monitor";
            this._notifyIcon.Visible = true;
            // 
            // _contextMenuStrip
            // 
            this._contextMenuStrip.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this._apacheItem,
            this._mysqlItem,
            this.cerrarMonitorToolStripMenuItem});
            this._contextMenuStrip.Name = "_contextMenuStrip";
            this._contextMenuStrip.Size = new System.Drawing.Size(156, 92);
            // 
            // _apacheItem
            // 
            this._apacheItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this._iniciaApacheItem,
            this._detieneApacheItem});
            this._apacheItem.Image = global::SYM3ServiceMonitor.Properties.Resources.red32;
            this._apacheItem.Name = "_apacheItem";
            this._apacheItem.Size = new System.Drawing.Size(155, 22);
            this._apacheItem.Text = "Apache";
            // 
            // _iniciaApacheItem
            // 
            this._iniciaApacheItem.Image = global::SYM3ServiceMonitor.Properties.Resources.play32;
            this._iniciaApacheItem.Name = "_iniciaApacheItem";
            this._iniciaApacheItem.Size = new System.Drawing.Size(152, 22);
            this._iniciaApacheItem.Text = "Iniciar";
            this._iniciaApacheItem.Click += new System.EventHandler(this._iniciaApacheItem_Click);
            // 
            // _detieneApacheItem
            // 
            this._detieneApacheItem.Image = global::SYM3ServiceMonitor.Properties.Resources.stop32;
            this._detieneApacheItem.Name = "_detieneApacheItem";
            this._detieneApacheItem.Size = new System.Drawing.Size(152, 22);
            this._detieneApacheItem.Text = "Detener";
            this._detieneApacheItem.Click += new System.EventHandler(this._detieneApacheItem_Click);
            // 
            // _mysqlItem
            // 
            this._mysqlItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this._iniciaMysqlItem,
            this._detieneMysqlItem});
            this._mysqlItem.Image = global::SYM3ServiceMonitor.Properties.Resources.red32;
            this._mysqlItem.Name = "_mysqlItem";
            this._mysqlItem.Size = new System.Drawing.Size(155, 22);
            this._mysqlItem.Text = "MySql";
            // 
            // _iniciaMysqlItem
            // 
            this._iniciaMysqlItem.Image = global::SYM3ServiceMonitor.Properties.Resources.play32;
            this._iniciaMysqlItem.Name = "_iniciaMysqlItem";
            this._iniciaMysqlItem.Size = new System.Drawing.Size(152, 22);
            this._iniciaMysqlItem.Text = "Iniciar";
            this._iniciaMysqlItem.Click += new System.EventHandler(this._iniciaMysqlItem_Click);
            // 
            // _detieneMysqlItem
            // 
            this._detieneMysqlItem.Image = global::SYM3ServiceMonitor.Properties.Resources.stop32;
            this._detieneMysqlItem.Name = "_detieneMysqlItem";
            this._detieneMysqlItem.Size = new System.Drawing.Size(152, 22);
            this._detieneMysqlItem.Text = "Detener";
            this._detieneMysqlItem.Click += new System.EventHandler(this._detieneMysqlItem_Click);
            // 
            // cerrarMonitorToolStripMenuItem
            // 
            this.cerrarMonitorToolStripMenuItem.Name = "cerrarMonitorToolStripMenuItem";
            this.cerrarMonitorToolStripMenuItem.Size = new System.Drawing.Size(155, 22);
            this.cerrarMonitorToolStripMenuItem.Text = "Cerrar Monitor";
            this.cerrarMonitorToolStripMenuItem.Click += new System.EventHandler(this.cerrarMonitorToolStripMenuItem_Click);
            // 
            // MainForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(292, 266);
            this.Name = "MainForm";
            this.ShowInTaskbar = false;
            this.Text = "Form1";
            this.WindowState = System.Windows.Forms.FormWindowState.Minimized;
            this._contextMenuStrip.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.NotifyIcon _notifyIcon;
        private System.Windows.Forms.ContextMenuStrip _contextMenuStrip;
        private System.Windows.Forms.ToolStripMenuItem _apacheItem;
        private System.Windows.Forms.ToolStripMenuItem _iniciaApacheItem;
        private System.Windows.Forms.ToolStripMenuItem _detieneApacheItem;
        private System.Windows.Forms.ToolStripMenuItem _mysqlItem;
        private System.Windows.Forms.ToolStripMenuItem _iniciaMysqlItem;
        private System.Windows.Forms.ToolStripMenuItem _detieneMysqlItem;
        private System.Windows.Forms.ToolStripMenuItem cerrarMonitorToolStripMenuItem;
    }
}

