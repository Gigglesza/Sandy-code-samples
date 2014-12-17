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
    public partial class ViewWorkOrders : Page
    {
        public string isWebAdmin = "";
        public string isClientAdmin = "";
        public string isOperator = "";
        public string isMetermanClient = "";
        public Common.CommonTasks.UserContractDet ucd;
        public Users_UserDetail uud;

        protected void Page_Load(object sender, EventArgs e)
        {
            uud = (Users_UserDetail)Session["userDetails"];
            ucd = (Common.CommonTasks.UserContractDet)Session["UserContractDet"];
            isWebAdmin = uud.IsWebAdmin == true ? "Y" : "";
            isClientAdmin = uud.IsClientAdmin == true ? "Y" : "";
            isOperator = uud.IsOperator == true ? "Y" : "";
            isMetermanClient = ucd.isMetermanClient == true ? "Y" : "";
            lblContractName.Text = "<br/>Client: " + ucd.ClientName + " | Contract: " + ucd.ContractName;

            if (!IsPostBack)
            {
                Classes.IDBHandler db = new Classes.DBHandler();

                gvSearchResults.AllowPaging = uud.ShowPaging;

                //Set the current sort field and order
                ViewState["SearchResultSortDirection"] = "ASC";
                ViewState["SearchResultSortExpression"] = "RouteName";
                if (Request.QueryString["new"] == null)
                {
                    string routeName = db.getJobCardRouteName(Convert.ToInt32(Request.QueryString["JobCardHeaderID"]), uud.UserID);
                    if (routeName.Substring(0, 3) == "MAN")
                    {
                        //we can add more items
                    }
                    else
                    {
                        //it came from validations, can't add more items.
                        btnAddOther.Visible = false;
                        btnDelete.Visible = false;
                    }
                }
                else
                {
                    if (Request.QueryString["JobCardHeaderID"] == null)
                    {
                        btnSame.Visible = false;
                    }
                    else
                    {
                        string RouteName = db.getJobCardRouteName(Convert.ToInt32(Request.QueryString["JobCardHeaderID"]), uud.UserID).ToString();
                        btnSame.Visible = true;
                        if (Request.QueryString["create"] == null)
                        {
                            lblError.Text = "Route " + RouteName + " was updated successfully.";
                        }
                        else
                        {
                            lblError.Text = "Route " + RouteName + " was created successfully.";
                        }
                        lblError.ForeColor = System.Drawing.Color.Black;
                        lblError.Visible = true;
                    }
                }

                if (Session["alreadyRun"] == null)
                {
                    Session.Add("alreadyRun", "n");
                }
                else
                {
                    Session["alreadyRun"] = "n";
                }
            }

            if ((Session["alreadyRun"] == "y"))
            {
                //gvSearchResults.DataSource = null; 
                Session["alreadyRun"] = "n";
                //gvSearchResults.Rebind();
                Response.Redirect(Request.Url.ToString());
            }
        }

        #region "Grid Functions"

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

        protected void gvAddingItems_NeedDataSource(object source, GridNeedDataSourceEventArgs e)
        {
            if (!String.IsNullOrWhiteSpace(txtAccountSearch.Text) || !String.IsNullOrWhiteSpace(txtAddressSearch.Text)
                || !String.IsNullOrWhiteSpace(txtConsumerSearch.Text) || !String.IsNullOrWhiteSpace(txtStandNo.Text))
            {
                DataTable dt = new DataTable();
                Classes.IDBHandler db = new Classes.DBHandler();

                dt = db.SearchForJobCard(txtAccountSearch.Text, txtConsumerSearch.Text, txtAddressSearch.Text, txtStandNo.Text);

                gvAddingItems.DataSource = dt;
                gvAddingItems.Visible = true;

                if (dt.Rows.Count == 0)
                {
                    lblError.Text = "There are no records for your search criteria";
                    lblError.Visible = true;
                }
            }
        }

        protected void gvSearchResults_NeedDataSource(object source, GridNeedDataSourceEventArgs e)
        {
            if (Request.QueryString["JobCardHeaderID"] != null)
            {

                DataTable dt = new DataTable();
                Classes.IDBHandler db = new Classes.DBHandler();
                int headerID = int.Parse(Request.QueryString["JobCardHeaderID"]);
                hidJobCardID.Value = headerID.ToString();

                dt = db.GetJobCardDetails(headerID);

                gvSearchResults.DataSource = dt;

            }
            else
            {
                if (hidJobCardID.Value != "")
                {
                    DataTable dt = new DataTable();
                    Classes.IDBHandler db = new Classes.DBHandler();
                    int headerID = int.Parse(hidJobCardID.Value);

                    dt = db.GetJobCardDetails(headerID);

                    gvSearchResults.DataSource = dt;
                }
                else
                {
                    DataTable dt = new DataTable();
                    gvSearchResults.DataSource = dt;
                }
            }
        }

        protected void btnBack_Click(object sender, EventArgs e)
        {
            Response.Redirect("ReplacementGenerator.aspx");
        }
        
        protected void btnSearch_Click(object sender, EventArgs e)
        {
            //Search using entered fields, at least one item needs to be entered
            if ((txtAccountSearch.Text == "") & (txtAddressSearch.Text == "") & (txtConsumerSearch.Text == "") & (txtStandNo.Text == ""))
            {
                //no terms entered, cant search because database is too huge
                lblError.Text = "Please enter at least one search term";
                lblError.Visible = true;
            }
            else
            {
                //do the search and display in grid for selection
                DataTable dt = new DataTable();
                Classes.IDBHandler db = new Classes.DBHandler();
                //int headerID = int.Parse(Request.QueryString["JobCardHeaderID"]);

                dt = db.SearchForJobCard(txtAccountSearch.Text, txtConsumerSearch.Text, txtAddressSearch.Text, txtStandNo.Text);

                gvAddingItems.DataSource = dt;
                gvAddingItems.DataBind();
                gvAddingItems.Visible = true;

                if (dt.Rows.Count == 0)
                {
                    lblError.Text = "There are no records for your search criteria";
                    lblError.Visible = true;
                }
            }
            btnAddItems.Visible = true;

            AddItem.Attributes["style"] = "display: block";
        }

        protected void btnAddItems_Click(object sender, EventArgs e)
        {
            Common.ReadingsDetailDBHandler rddb = new Common.ReadingsDetailDBHandler();
            int counter = 0;
            int jobCardHeaderID = 0;
            string additionalParms = "";

            //check if hidden field has value, if not you need to first create the header record
            if (hidJobCardID.Value == "")
            {
                jobCardHeaderID = rddb.InsertJobCardHeader(0);
                hidJobCardID.Value = jobCardHeaderID.ToString();
                additionalParms = "&create=y";
            }
            else
            {
                jobCardHeaderID = Convert.ToInt32(hidJobCardID.Value);
            }
            //loop through gridview to find all marked for repairs
            foreach (GridDataItem row in gvAddingItems.Items)
            {
                if (row.ItemType == GridItemType.Item)
                {
                    CheckBox chkRow = (row.Cells[1].FindControl("chkMarkRepairs") as CheckBox);
                    if (chkRow.Checked)
                    {
                        //update mrd table with repairs
                        int mrdID = Convert.ToInt32(row.Cells[0].Text);

                        bool updated = rddb.UpdateMarkRepairs(mrdID, jobCardHeaderID);

                        //insert job card route
                        counter = counter + 1;
                    }
                }
            }
            gvSearchResults.Rebind();
            AddItem.Attributes["style"] = "display: none";
            Response.Redirect("ViewWorkOrders.aspx?new=y&JobCardHeaderID=" + jobCardHeaderID.ToString() + additionalParms);
        }

        protected void btnDelete_Click(object sender, EventArgs e)
        {
            int counter = 0;
            foreach (GridDataItem row in gvSearchResults.Items)
            {
                CheckBox chk = (CheckBox)row["MarkCHK"].Controls[0];

                Classes.IDBHandler db = new Classes.DBHandler();
                if (chk.Checked)
                {
                    //int JobCardHeaderID = int.Parse(row.GetDataKeyValue("JobCardHeaderID").ToString());
                    int JobCardDetailsID = Convert.ToInt32(row["JobCardDetailsID"].Text);

                    if (db.deleteJobCardDetails(JobCardDetailsID, uud.UserID))
                    {
                        lblError.Text = "Item successfully deleted.";
                        lblError.ForeColor = System.Drawing.Color.Black;
                        lblError.Visible = true;
                    }
                    else
                    {
                        lblError.Text = "An error occured while trying to remove the item.  Please try again.";
                        lblError.ForeColor = System.Drawing.Color.Red;
                        lblError.Visible = true;
                    }
                    counter++;
                }
            }

            if (counter > 0)
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
    }
}