using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using MetermanWeb.Dbase;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
using System.Globalization;
using MetermanWeb.MobileManagement.Classes;

namespace MetermanWeb.MobileManagement
{
    public partial class QuickMeterHistory : System.Web.UI.Page
    {
        public Common.CommonTasks.UserContractDet ucd;
        private DateTime fromDate;
        private DateTime toDate;
        private string MeterNoRec;

        protected void Page_Load(object sender, EventArgs e)
        {
            Users_UserDetail uud = (Users_UserDetail)Session["userDetails"];
            ucd = (Common.CommonTasks.UserContractDet)Session["UserContractDet"];

            if (!IsPostBack)
            {
                Classes.IDBHandler db = new Classes.DBHandler();
                if (Request.QueryString["MeterNo"] != null)
                {
                    MeterNoRec = Request.QueryString["MeterNo"];
                    lblMeterNo.Text = MeterNoRec;
                }
            }
        }

        protected void grdMeterReadingDetails_NeedDataSource(object sender, Telerik.Web.UI.GridNeedDataSourceEventArgs e)
        {
            try
            {
                fromDate = DateTime.ParseExact(string.Format("{0:dd/MM/yyyy}", DateTime.Today.AddMonths(-6)), "dd/MM/yyyy", CultureInfo.InvariantCulture);
                toDate = DateTime.ParseExact(string.Format("{0:dd/MM/yyyy}", DateTime.Today), "dd/MM/yyyy", CultureInfo.InvariantCulture);

                IDBHandler db = new DBHandler();
                List<WebNM_Rep_MeterReadingsDetailsBySearch_proc_Result> lstDetails = new List<WebNM_Rep_MeterReadingsDetailsBySearch_proc_Result>(db.GetMeterReadingDetailsBySearch(Convert.ToInt32(ucd.ContractID), MeterNoRec, "", "", "", "", "", fromDate, toDate));

                if (lstDetails.Count() > 0)
                {
                    grdMeterReadingDetails.DataSource = lstDetails;
                    grdMeterReadingDetails.Visible = true;
                }
                else
                {
                    grdMeterReadingDetails.Visible = false;
                }
            }
            catch (Exception er)
            {
                lblErrormsg.Visible = true;
                lblErrormsg.Text = "There was an error loading the report.  Please try again.";

                MetermanWeb.Common.ErrorLogging error = new MetermanWeb.Common.ErrorLogging();
                error.logError("grdMeterReadingDetails_NeedDataSource", "Error loading the Meter Reading Details. ContractID = " + ucd.ContractID, "889", er.Message + "-" + er.InnerException, "grdMeterReadingDetails_NeedDataSource", DateTime.Now, "MetermanWeb", 3);

            }
        }
    }
}