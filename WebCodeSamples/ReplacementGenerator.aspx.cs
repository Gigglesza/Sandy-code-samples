using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.UI;
using System.Web.UI.WebControls;
using MetermanWeb.Dbase;
using System.Data;
using System.IO;
using System.Web.UI.HtmlControls;
using System.Configuration;
using Telerik.Web.UI;

namespace MetermanWeb.MobileManagement
{
    public partial class ReplacementGenerator : System.Web.UI.Page
    {
        public string isWebAdmin = "";
        public string isClientAdmin = "";
        public string isOperator = "";
        public string isMetermanClient="";
        public Common.CommonTasks.UserContractDet ucd;
        public Users_UserDetail uud;
        public bool alreadyRun = false;

        protected void Page_Load(object sender, EventArgs e)
        {
            uud = (Users_UserDetail)Session["userDetails"];
            ucd = (Common.CommonTasks.UserContractDet)Session["UserContractDet"];
            isWebAdmin = uud.IsWebAdmin == true ? "Y" : "";
            isClientAdmin = uud.IsClientAdmin == true ? "Y" : "";
            isOperator = uud.IsOperator == true ? "Y" : "";
            isMetermanClient = ucd.isMetermanClient==true ? "Y" : "";
            lblContractName.Text = "<br/>Client: " + ucd.ClientName + " | Contract: " + ucd.ContractName;
            
            if (!IsPostBack)
            {
                Classes.IDBHandler db = new Classes.DBHandler();
                //List<WebNM_GetUniqueRouteByContractID_proc_Result> routelst = db.GetUniqueRoutesByContractID(ucd, false).ToList();

                //Common.CommonTasks.Binddropdownlist<WebNM_GetUniqueRouteByContractID_proc_Result>(ddlRoute, routelst, "RouteName", "RouteName", "--Select--");

                //List<WebNM_RouteReadingStatus> statuslst = db.GetAllActiveRouteStatus().ToList();

                //Common.CommonTasks.Binddropdownlist<WebNM_RouteReadingStatus>(ddlReadingStatus, statuslst, "Description", "RouteReadingStatusID", "--Select--");
                //ddlReadingStatus.SelectedIndex = 1;

                //List<WebNM_GetMeterReaderDetailsByContract_proc_Result> readerlst = db.GetReaderDetailsByContractID(int.Parse(ucd.ContractID.ToString())).ToList();
                gvSearchResults.AllowPaging = uud.ShowPaging;
                loadGrid("RouteName ASC");

                //gvSearchResults.Columns[13].Visible = false;
                //Set the current sort field and order
                ViewState["SearchResultSortDirection"] = "ASC";
                ViewState["SearchResultSortExpression"] = "RouteName";
                //if (ucd.isMetermanClient || (uud.IsWebAdmin != true && uud.IsClientAdmin != true && uud.IsOperator != true))
                //{
                //    //btDelete.Visible = false; //commented out 28062013 by Jerome Dimairho as requested by Rudolf Earle
                //    btArchiveComplete.Visible = false;
                //}
                if (Session["alreadyRun"] == null)
                {
                    Session.Add("alreadyRun", "n");
                }
                else
                {
                    Session["alreadyRun"] = "n";
                }

                if (Session["openPopUp"] == null)
                {
                    Session.Add("openPopUp", "n");
                }
                else
                {
                    Session["openPopUp"] = "n";
                }
            }

            if ((Session["alreadyRun"] == "y"))
            {
                gvSearchResults.AllowPaging = uud.ShowPaging;
                loadGrid("RouteName ASC");
                Session["alreadyRun"] = "n";
            }

        }

        #region "Grid Functions"

        private void loadGrid(string strSort)
        {
        //    hidGridToExport.Value = "gvSearchResults";
        //    //DataTable dtFlat;
        //    List<WebNM_MeterReadingsHeader> mrhlst = new List<WebNM_MeterReadingsHeader>();
        //    DataTable dt = null;
        //    Classes.IDBHandler db = new Classes.DBHandler();

        //    int RouteStatusID = 0;
        //    string mapUrl = ConfigurationManager.AppSettings["MapApplicationURL"] + ConfigurationManager.AppSettings["MapStartPage"];

        //    if (ddlReadingStatus.SelectedItem.Text != "--Select--")
        //    {
        //        //Session["SearchCriteria"] = ddlReadingStatus.SelectedItem.Text;
        //        RouteStatusID = int.Parse(ddlReadingStatus.SelectedValue.ToString());

        //        dt = db.GetRouteManagementConsoleGrid(ucd.ContractID, RouteStatusID, ddlRoute.SelectedValue.ToString(), mapUrl);
        //    }
        //    else
        //    {
        //        if (ddlRoute.SelectedItem.Text == "--Select--")
        //        {
        //            lblError.Text = "Please select a status or route and then click on display.";
        //            lblError.Visible = true;
        //            gvSearchResults.DataSource = null;
        //            gvSearchResults.DataBind();

        //            //Repetition
        //            //gvSearchResults.DataSource = null;
        //            //gvSearchResults.DataBind();
        //        }
        //        else
        //        {
        //            //SD: 18/04/2011 - changed to use a stored procedure
        //            //mrhlst = db.GetWebNMMeterReadingsHeaderByRouteStatus(ddlRoute.SelectedValue.ToString());
        //            dt = db.GetRouteManagementConsoleGrid(ucd.ContractID, RouteStatusID, ddlRoute.SelectedValue.ToString(), mapUrl);
        //        }
        //    }

        //    if (dt != null)
        //    {
        //        if (dt.Rows.Count > 0)
        //        {
        //            //dt.DefaultView.Sort = strSort;
        //            gvSearchResults.DataSource = dt;
        //            gvSearchResults.DataBind();

        //            /* //Repetition
        //            gvSearchResults.DataSource = dt;
        //            gvSearchResults.DataBind();

        //            gvSearchResults.DataSource = dt;
        //            gvSearchResults.DataBind();
        //            */

        //            if ((dt.Rows.Count > gvSearchResults.PageSize) && (gvSearchResults.AllowPaging == true))
        //            {
        //                btnShowAll.Visible = true;
        //            }
        //            else
        //            {
        //                btnShowAll.Visible = false;
        //            }

        //            Users_UserDetail uud = (Users_UserDetail)Session["userDetails"];
        //            Common.CommonTasks.UserContractDet ucd = (Common.CommonTasks.UserContractDet)Session["UserContractDet"];
        //            gvSearchResults.Visible = true;

        //        }
        //        else
        //        {
        //            lblError.Text = "No results exist for selection";
        //            lblError.Visible = true;
        //            gvSearchResults.DataSource = mrhlst;
        //            gvSearchResults.DataBind();

        //            gvSearchResults.DataSource = mrhlst;
        //            gvSearchResults.DataBind();

        //        }
        //    }
        }

        protected void gvSearchResults_Sorting(object sender, GridViewSortEventArgs e)
        {
            //loadGrid(e.SortExpression + " " + GetSortDirection(e.SortExpression));
        }

        private string GetSortDirection(string column)
        {

            // By default, set the sort direction to ascending.
            string sortDirection = "ASC";

            // Retrieve the last column that was sorted.
            string sortExpression = ViewState["SearchResultSortExpression"] as string;

            if (sortExpression != null)
            {
                // Check if the same column is being sorted.
                // Otherwise, the default value can be returned.
                if (sortExpression == column)
                {
                    string lastDirection = ViewState["SearchResultSortDirection"] as string;
                    if ((lastDirection != null) && (lastDirection == "ASC"))
                    {
                        sortDirection = "DESC";
                    }
                }
            }

            // Save new values in ViewState.
            ViewState["SearchResultSortDirection"] = sortDirection;
            ViewState["SearchResultSortExpression"] = column;

            return sortDirection;
        }
        protected void gvSearchResults_PageIndexChanging(object sender, GridViewPageEventArgs e)
        {

            gvSearchResults.CurrentPageIndex = e.NewPageIndex;

            string sort = ViewState["SearchResultSortExpression"].ToString() + ' ' + ViewState["SearchResultSortDirection"].ToString();

            loadGrid(sort);
        }
        #endregion

        #region "Export to Excel"
        protected void btExportExcel_Click(object sender, EventArgs e)
        {
            //Export the GridView to Excel
            Common.ICommonDBHandler cdb = new Common.CommonDBHandler();

            //GridView whichgrid = new GridView();
            RadGrid whichgrid = new RadGrid();

            whichgrid.AllowPaging = false;
            string sort = ViewState["SearchResultSortExpression"].ToString() + ' ' + ViewState["SearchResultSortDirection"].ToString();

            gvSearchResults.Columns[13].Visible = true;
            loadGrid(ViewState["SearchResultSortExpression"].ToString() + " " + ViewState["SearchResultSortDirection"].ToString());

            whichgrid = gvSearchResults;

            Common.ExportToExcel.PrepareGridViewForExport(whichgrid);

            whichgrid.Columns[0].Visible = false;
            whichgrid.Columns[13].Visible = true;
            whichgrid.Columns[14].Visible = false;
            whichgrid.Columns[20].Visible = false;
            whichgrid.Columns[21].Visible = false;
            whichgrid.Columns[22].Visible = false;
            whichgrid.Columns[23].Visible = false;
            whichgrid.Columns[24].Visible = false;

            //ExportGridView(whichgrid);
            whichgrid.MasterTableView.ExportToExcel();

        }

        private void ExportGridView(RadGrid whichgrid)
        {

            string attachment = "attachment; filename=Routes.xls";

            Response.ClearContent();

            Response.AddHeader("content-disposition", attachment);

            Response.ContentType = "application/ms-excel";

            StringWriter sw = new StringWriter();

            HtmlTextWriter htw = new HtmlTextWriter(sw);



            // Create a form to contain the grid

            HtmlForm frm = new HtmlForm();

            whichgrid.Parent.Controls.Add(frm);

            frm.Attributes["runat"] = "server";

            frm.Controls.Add(whichgrid);
            frm.RenderControl(htw);

            Response.Write(sw.ToString());
            Response.End();
        }
        
        #endregion

        protected void gvSearchResults_NeedDataSource(object source, Telerik.Web.UI.GridNeedDataSourceEventArgs e)
        {
            DataTable dt = new DataTable();
            Classes.IDBHandler db = new Classes.DBHandler();

            dt = db.GetJobCardConsoleGrid(ucd.ContractID);

            gvSearchResults.DataSource = dt;
        }

        protected void btnCreateManual_Click(object sender, EventArgs e)
        {
            //take them to the search and create screen
            Response.Redirect("ViewWorkOrders.aspx?new=y");
        }

        protected void btnImportFile_Click(object sender, EventArgs e)
        {
            //import a file using normal import procedure, just import into job card system
            Response.Redirect("SystemDataTransfer/BulkImportJobCard.aspx");
        }

        protected void btnSendToRoute_Click(object sender, EventArgs e)
        {
            int fullcounter = 0;
            //move the job card routes into the meter reading routes tables and then redirect to Management console
            //first we need to check if all the instructions were filled in
            foreach (GridDataItem row in gvSearchResults.Items)
            {
                CheckBox chk = (CheckBox)row["MarkCHK"].Controls[0];
                //CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
                Classes.IDBHandler db = new Classes.DBHandler();
                Common.ReadingsDetailDBHandler rddb = new Common.ReadingsDetailDBHandler();

                if (chk.Checked)
                {
                    //string statusdescr = gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[3].ToString();
                    int jobHeaderID = Convert.ToInt32(row.GetDataKeyValue("JobCardHeaderID").ToString());

                    //check instructions
                    int counter = 0;
                    counter = rddb.CheckInstructions(jobHeaderID);
                    if (counter == 0)
                    {
                        //all instructions have been inserted. move the routes.
                        Boolean correct = rddb.MoveJobCardsToRoutes(jobHeaderID);

                        //change contractID
                        int ContractID = rddb.GetWorkOrderContract();
                        Users_UserDetail uud = (Users_UserDetail)Session["userDetails"];
                        Common.ICommonDBHandler cdb = new Common.CommonDBHandler();
                        UserContract uclst = cdb.GetUserContractList(uud).Where(x => x.EnableContract == true && x.ClientContract.ContractActive == true && x.ContractID == ContractID).FirstOrDefault();
                        Common.CommonTasks.UserContractDet ucd = cdb.LoadUserContractDetByUserContractID(uclst.UserContractID);
                        Session["UserContractDet"] = ucd;

                        //Redirect to Management Console
                        Response.Redirect("RouteManagementConsole.aspx");
                    }
                    else
                    {
                        //there are missing instructions - dont allow.
                        lblError.Text = "Cannot transfer routes, please ensure you have added instructions to each meter.";
                        lblError.Visible = true;
                    }
                    fullcounter++;
                }
            }

            if (fullcounter > 0)
            {
                gvSearchResults.Rebind();
            }
            else
            {
                lblError.Text = "Please select at least one item to send.";
                lblError.ForeColor = System.Drawing.Color.Red;
                lblError.Visible = true;
            }

            //Response.Redirect("RouteManagementConsole.aspx");
        }

        protected void btnAddSameInstruction_Click(object sender, EventArgs e)
        {
            string listIDs = "";
            int counter = 0;

            foreach (GridDataItem row in gvSearchResults.Items)
            {
                CheckBox chk = (CheckBox)row["MarkCHK"].Controls[0];
                //CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
                Classes.IDBHandler db = new Classes.DBHandler();
                Common.ReadingsDetailDBHandler rddb = new Common.ReadingsDetailDBHandler();

                if (chk.Checked)
                {
                    //string statusdescr = gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[3].ToString();
                    int jobHeaderID = Convert.ToInt32(row.GetDataKeyValue("JobCardHeaderID").ToString());

                    if (counter == 0)
                    {
                        listIDs = jobHeaderID.ToString();
                    }
                    else
                    {
                        listIDs = listIDs + "," + jobHeaderID.ToString();
                    }
                    counter++;
                }
            }
            if (Session["jobIDs"] == null)
            {
                Session.Add("jobIDs", listIDs);
            }
            else
            {
                if (Session["jobIDs"].ToString() != listIDs)
                {
                    Session["jobIDs"] = listIDs;
                    Session["openPopUp"] = "n";
                }
                else
                {
                    Session["jobIDs"] = listIDs;
                    Session["openPopUp"] = "y";
                }
            }

            if (counter > 0)//Session["openPopUp"] = "n";
            {
                if ((Session["openPopUp"] == "n") || (Session["openPopUp"] == null))
                {
                    ClientScript.RegisterStartupScript(this.GetType(), "setInstruction", "<script>window.open('SetComment.aspx?all=y&JobCardHeaderID=" + listIDs + "', 'setInstruction', 'toolbar=0,location=0,status=1,menubar=0,scrollbars=1,top=50,left=50,width=550,height=270,resizable=1');</script>");
                }
            }
            else
            {
                lblError.Visible = true;
                lblError.Text = "Please select at least one route to edit the instructions of.";
            }
        }

        protected void btnDeleteRoutes_Click(object sender, EventArgs e)
        {
            int fullcounter = 0;
            //move the job card routes into the meter reading routes tables and then redirect to Management console
            //first we need to check if all the instructions were filled in
            foreach (GridDataItem row in gvSearchResults.Items)
            {
                CheckBox chk = (CheckBox)row["MarkCHK"].Controls[0];
                //CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
                Classes.IDBHandler db = new Classes.DBHandler();
                Common.ReadingsDetailDBHandler rddb = new Common.ReadingsDetailDBHandler();

                if (chk.Checked)
                {
                    //string statusdescr = gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[3].ToString();
                    int jobHeaderID = Convert.ToInt32(row.GetDataKeyValue("JobCardHeaderID").ToString());

                    if (rddb.DeleteJobCards(jobHeaderID))
                    {
                        lblError.Text = "Route(s) successfully deleted.";
                        lblError.ForeColor = System.Drawing.Color.Black;
                        lblError.Visible = true;
                    }
                    else
                    {
                        lblError.Text = "A problem has occured.  Please try again.";
                        lblError.ForeColor = System.Drawing.Color.Red;
                        lblError.Visible = true;
                    }
                    fullcounter++;
                }
            }

            if (fullcounter > 0)
            {
                gvSearchResults.Rebind();
            }
            else
            {
                lblError.Text = "Please select at least one item to delete.";
                lblError.ForeColor = System.Drawing.Color.Red;
                lblError.Visible = true;
            }
        }


        //
        //protected void btDisplay_Click(object sender, EventArgs e)
        //{

        //    lblError.Visible = false;
        //    loadGrid("RouteName ASC");
        //    gvSearchResults.Columns[13].Visible = false;
        //    if (uud.ShowPaging)
        //    {
        //        gvSearchResults.AllowPaging = true;
        //        btnShowPages.Visible = true;
        //    }
        //    else
        //    {
        //        gvSearchResults.AllowPaging = false;
        //        btnShowPages.Visible = false;
        //    }
        //    //Set the current sort field and order
        //    /*ViewState["SearchResultSortDirection"] = "ASC";
        //    ViewState["SearchResultSortExpression"] = "RouteName";*/

        //}

        //protected void btnShowAll_Click(object sender, System.EventArgs e)
        //{
        //    string sort = ViewState["SearchResultSortExpression"].ToString() + ' ' + ViewState["SearchResultSortDirection"].ToString();
        //    gvSearchResults.AllowPaging = false;

        //    loadGrid(sort);
        //    btnShowPages.Visible = true;
        //    btnShowAll.Visible = false;
        //}

        //protected void btnShowPages_Click(object sender, System.EventArgs e)
        //{
        //    string sort = ViewState["SearchResultSortExpression"].ToString() + ' ' + ViewState["SearchResultSortDirection"].ToString();

        //    gvSearchResults.AllowPaging = true;
        //    loadGrid(sort);
        //    btnShowPages.Visible = false;
        //    btnShowAll.Visible = true;
        //}

        //protected void ddlReadingStatus_SelectedIndexChanged(object sender, EventArgs e)
        //{
        //    Classes.IDBHandler db = new Classes.DBHandler();
        //    int RouteStatusID = int.Parse(ddlReadingStatus.SelectedValue.ToString());

        //    //Session["SearchCriteria"] = ddlReadingStatus.SelectedItem.Text;

        //    List<WebNM_GetUniqueRouteByContractID_proc_Result> routelst = db.GetUniqueRoutesByContractID(ucd, false).ToList();
        //    Common.CommonTasks.Binddropdownlist<WebNM_GetUniqueRouteByContractID_proc_Result>(ddlRoute, routelst, "RouteName", "RouteName", "--Select--");


        //}

        //#region "Delete/Archive Routes in RED status"
        //protected void btDelete_Click(object sender, EventArgs e)
        //{
        //    bool success = true;
        //    string msgdeleted = "The following routes have been successfully deleted: </br>";
        //    string message = "Error deleting following routes: </br>";
        //    string routesSkipped = "The following routes cannot be deleted as readings have already started: </br>";
        //    foreach (GridDataItem row in gvSearchResults.Items)
        //    {
        //        CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
        //        Classes.IDBHandler db = new Classes.DBHandler();
        //        //if (gvSearchResults.DataKeys[row.RowIndex].Values[2].ToString() == "0")
        //        //if(gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[2].ToString() == "0")
        //        if (row.GetDataKeyValue("PercentageRead").ToString() == "0")
        //        {
        //            if (tempbox.Checked)
        //            {
        //                //do delete validation and delete route
        //                //int MeterReadingHeaderID = int.Parse(gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[1].ToString());
        //                int MeterReadingHeaderID = int.Parse(row.GetDataKeyValue("MeterReadingsHeaderID").ToString());
        //                // Users_UserDetail uud = (Users_UserDetail)Session["userDetails"];
        //                if (!db.WebNM_DeleteMeterReadingHeader(MeterReadingHeaderID, int.Parse(uud.UserID.ToString()), 6))
        //                {
        //                    //message += gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[0].ToString() + "</br>";
        //                    message += row.GetDataKeyValue("RouteName").ToString() + "</br>";
        //                    success = false;
        //                }
        //                else
        //                {
        //                    //msgdeleted += gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[0].ToString() + "</br>";
        //                    msgdeleted += row.GetDataKeyValue("RouteName").ToString() + "</br>";
        //                }
        //            }
        //        }
        //        else
        //        {
        //            if (tempbox.Checked)
        //            {
        //                //routesSkipped += gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[0].ToString() + "</br>";
        //                routesSkipped += row.GetDataKeyValue("RouteName").ToString() + "</br>";
        //            }
        //        }

        //    }
        //    if (success == false)
        //    {
        //        lblError.Text = msgdeleted + message + routesSkipped;
        //        lblError.Visible = true;
        //    }
        //    else
        //    {
        //        lblError.Text = msgdeleted + routesSkipped;
        //        lblError.Visible = true;
        //    }
        //    loadGrid("RouteName ASC");
        //    //Set the current sort field and order
        //    ViewState["SearchResultSortDirection"] = "ASC";
        //    ViewState["SearchResultSortExpression"] = "RouteName";
        //}

        //#endregion

        //#region "Archive Completed Routes"
        //protected void btArchiveComplete_Click(object sender, EventArgs e)
        //{
        //    lblError.Text = "";
        //    lblError.Visible = false;
        //    string invalidRoutes = "";
        //    // get list of routes to export
        //    string meterReadingsHeaderLst = "";
        //    foreach (GridDataItem row in gvSearchResults.Items)
        //    {
        //        CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
        //        Classes.IDBHandler db = new Classes.DBHandler();

        //        if (tempbox.Checked)
        //        {
        //            //string statusdescr = gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[3].ToString();
        //            string statusdescr = row.GetDataKeyValue("StatusDescription").ToString();
        //            if (statusdescr.ToUpper() == "GREEN" || statusdescr.ToUpper() == "PURPLEGREEN")
        //            {
        //                //add meterreaderheaderID to route list
        //                //meterReadingsHeaderLst += gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[1].ToString() + "|";
        //                meterReadingsHeaderLst += row.GetDataKeyValue("MeterReadingsHeaderID").ToString() + "|";
        //            }
        //            else
        //            {//invalid routes.  ie routes not complete cannot be archived.
        //                //invalidRoutes += gvSearchResults.SelectedItems[row.RowIndex].OwnerTableView.DataKeyValues[0].ToString() + ". ";
        //                invalidRoutes += row.GetDataKeyValue("RouteName").ToString() + ". ";
        //            }
        //        }
        //    }
        //    if (invalidRoutes == "") //check if any invalid routes selected
        //    {
        //        if (meterReadingsHeaderLst != "")  //check if any valid routes selected
        //        {//now go confirmand delete all valid routes selected
        //            Response.Redirect("ExportMultipleRoutes.aspx?meterReadingsHeaderLst=" + meterReadingsHeaderLst + "&userID=" + uud.UserID
        //                + "&ArchiveRoute=ArchiveRoute");
        //        }
        //        else
        //        {//inform user that no routes have been selected
        //            lblError.Text = "No routes selected for archiving completed routes.";
        //            lblError.Visible = true;
        //        }
        //    }//invalid routes exist, so user will need to untick invalid routes
        //    else
        //    {
        //        lblError.Text = "Only completed routes can be archived."
        //            + "</br>The following routes cannot be archived as they are not complete:</br>" + invalidRoutes
        //                + "</br>Please deselect these incomplete routes.";
        //        lblError.CssClass = "RedDisplay";
        //        lblError.Visible = true;
        //    }
        //}
        //#endregion

        //#region "Export Multiple Routes"
        //protected void btExportMultiRoutes_Click(object sender, EventArgs e)
        //{
        //    lblError.Text = "";
        //    lblError.Visible = false;

        //    // get list of routes to export
        //    string meterReadingsHeaderLst = "";
        //    //foreach (GridViewRow row in gvSearchResults.Rows)
        //    foreach (GridDataItem row in gvSearchResults.Items)
        //    {
        //        CheckBox tempbox = (CheckBox)row.FindControl("CheckBox1");
        //        Classes.IDBHandler db = new Classes.DBHandler();

        //        if (tempbox.Checked)
        //        {
        //            //add meterreaderheaderID to route list
        //            //meterReadingsHeaderLst += gvSearchResults.DataKeys[row.RowIndex].Values[1].ToString() + "|";
        //            //meterReadingsHeaderLst += row.FindControl("MeterReadingsHeaderID").ToString() + "|";
        //            meterReadingsHeaderLst += row["MeterReadingsHeaderID"].Text + "|";
        //        }
        //    }
        //    if (meterReadingsHeaderLst != "")
        //    {
        //        Response.Redirect("ExportMultipleRoutes.aspx?meterReadingsHeaderLst=" + meterReadingsHeaderLst + "&userID=" + uud.UserID);
        //    }
        //    else
        //    {
        //        lblError.Text = "No routes selected for multiple routes export.";
        //        lblError.Visible = true;
        //    }
        //}

        //#endregion
        
    }
}