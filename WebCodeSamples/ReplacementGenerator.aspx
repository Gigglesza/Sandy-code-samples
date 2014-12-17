<%@ Page Language="C#" AutoEventWireup="true" EnableEventValidation="false" CodeBehind="ReplacementGenerator.aspx.cs"
    Inherits="MetermanWeb.MobileManagement.ReplacementGenerator" %>

<%@ Register Src="../Common/Controls/Banner.ascx" TagName="Banner" TagPrefix="uc1" %>
<%@ Register TagPrefix="telerik" Namespace="Telerik.Web.UI" Assembly="Telerik.Web.UI" %>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1" runat="server">
    <title>Meterman Website</title>
    <%----%>
    <link href="../Styles/meterMan.css" rel="stylesheet" type="text/css" />
    <script src="../Scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">

        function CheckItem(itemCheckBox) {
            var masterTableView = gvSearchResults.get_masterTableView();
            if (DataItems == null) {
                DataItems = masterTableView.get_dataItems();
            }
            var row = itemCheckBox.parentNode.parentNode;
            if (row.tagName === "TR" && row.id != "") {
                var item = $find(row.id);
                if (!item.get_selected() && itemCheckBox.checked) {
                    masterTableView.clearSelectedItems();
                    item.set_selected(true);
                }
            }
        }

        function CheckAll(headerCheckBox) {
            var isChecked = headerCheckBox.checked;
            var checkboxes = gvSearchResults.get_masterTableView().get_element().getElementsByTagName("INPUT");
            var index;
            for (index = 0; index < checkboxes.length; index++) {
                if (typeof (checkboxes[index].checked) !== "undefined") {
                    if (isChecked) {
                        checkboxes[index].checked = true;
                    }
                    else {
                        checkboxes[index].checked = false;
                    }
                }
            }
        }
    </script>
    <script type="text/javascript">
        $(
 function () {
     $(".mGrid tr").hover(
   function () {
       $(this).addClass("highlight");
   },
   function () {
       $(this).removeClass("highlight");
   }

  )

 }

)
        //-->
    </script>
    <style>
        .rcbScroll
        {
            overflow-y: auto;
            overflow-x: hidden !important;
        }
    </style>
</head>
<body>


    <script type="text/javascript">
        var isAdmin = "<%= isWebAdmin %>";
        var isClientAdmin = "<%= isClientAdmin %>";
        var isOperator = "<%= isOperator %>";
        var isMetermanClient = "<%= isMetermanClient %>";
    </script>

    <script src="../Scripts/RouteConsoleScripts.js" type="text/javascript"></script>
    <form id="form1" runat="server">
        <telerik:RadScriptManager ID="RadScriptManager1" runat="server" />
        <div id="container">
            <uc1:Banner ID="Banner" runat="server" />
            <div id="content">
                <div id="PageTitle">
                    <h4>Route Management Console for:
                    <asp:Label ID="lblContractName" runat="server" Text=""></asp:Label></h4>
                </div>
                <table id="tblSearchOptions">
                    <tr>
                        <td>
                            <table id="tblfiltebox">
                                <tr>
                                    <td colspan="3">
                                        <asp:Button ID="btnCreateManual" runat="server" CssClass="button" Text="Create Work Order Manually" OnClick="btnCreateManual_Click" />
                                        <asp:Button ID="btnImportFile" runat="server" CssClass="button" Text="Import Work Order File" OnClick="btnImportFile_Click" Visible="false" />
                                        <asp:Button ID="btnSendToRoute" CssClass="button" runat="server" Text="Send Selected Routes to Management Console" OnClick="btnSendToRoute_Click" />
                                        <asp:Button ID="btnAddSameInstruction" CssClass="button" runat="server" Text="Add Same Instruction To Selected Routes" OnClick="btnAddSameInstruction_Click" />
                                        <asp:Button ID="btnDeleteRoutes" CssClass="button" runat="server" Text="Delete Selected Routes" Visible="false" OnClientClick="return confirm('Are you certain you want to delete the selected route(s)?');" OnClick="btnDeleteRoutes_Click" />
                                        <asp:HiddenField ID="hidGridToExport" runat="server" />
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <asp:Label ID="lblError" runat="server" ForeColor="Red"></asp:Label>
                                    </td>
                                    <td valign="top"></td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <telerik:RadGrid CssClass='Grid.Telerik.css' ID="gvSearchResults" runat="server"
                    RegisterWithScriptManager="false" AllowSorting="True" OnNeedDataSource="gvSearchResults_NeedDataSource" AllowMultiRowSelection="True"
                    CellSpacing="0" Width="100%" Height="400px" AllowFilteringByColumn="true">
                    <%--<telerik:RadGrid CssClass='Grid.Telerik.css' ID="gvSearchResults" runat="server" RegisterWithScriptManager="false"
                AllowSorting="True" OnNeedDataSource="gvSearchResults_NeedDataSource" CellSpacing="0" Width="100%" Height="400px">--%>
                    <MasterTableView DataKeyNames="JobCardHeaderID"
                        EditMode="InPlace" AutoGenerateColumns="false" Font-Italic="False" AllowCustomSorting="false"
                        AllowMultiColumnSorting="True" TableLayout="Fixed" BorderStyle="none" Width="2000px"
                        CommandItemDisplay="Top">
                        <CommandItemSettings ShowExportToExcelButton="false" ShowAddNewRecordButton="false"></CommandItemSettings>
                        <Columns>
                            <telerik:GridClientSelectColumn UniqueName="MarkCHK" HeaderText="Select All" ItemStyle-Width="20px" HeaderStyle-Width="20px" HeaderTooltip="Select All">
                            </telerik:GridClientSelectColumn>
                            <%--<telerik:GridTemplateColumn HeaderText="Select" UniqueName="Select" AutoPostBackOnFilter="True"
                                ItemStyle-BorderStyle="NotSet" AllowFiltering="false">
                                <HeaderTemplate>
                                    Select All<br /><input onclick="CheckAll(this);" type="checkbox">
                                </HeaderTemplate>
                                <ItemTemplate>
                                    <asp:CheckBox ID="CheckBox1" runat="server" onclick="CheckItem(this);" />
                                    <asp:HiddenField ID="hdID" runat="server" Value='<%# Eval("JobCardHeaderID") %>' />
                                </ItemTemplate>
                                <HeaderStyle Width="15px" />
                            </telerik:GridTemplateColumn>--%>
                            <telerik:GridHyperLinkColumn HeaderText="Original Route" DataTextField="RouteName" UniqueName="RouteID"
                                DataNavigateUrlFields="JobCardHeaderID,ContractID" SortExpression="RouteName"
                                DataNavigateUrlFormatString="ViewWorkOrders.aspx?JobCardHeaderID={0}" AutoPostBackOnFilter="True"
                                HeaderStyle-Width="20px" FilterControlWidth="50%">
                                <HeaderStyle Width="20px"></HeaderStyle>
                            </telerik:GridHyperLinkColumn>
                            <telerik:GridBoundColumn DataField="RouteName" Visible="false" SortExpression="Route"
                                UniqueName="RouteName" HeaderStyle-Width="1px">
                                <HeaderStyle Width="1px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="JobCardHeaderID" Visible="false" UniqueName="JobCardHeaderID"
                                HeaderStyle-Width="1px">
                                <HeaderStyle Width="1px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="ContractID" Visible="false" UniqueName="ContractID"
                                HeaderStyle-Width="1px">
                                <HeaderStyle Width="1px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="NoOfMeters" HeaderText="No. of Meters" UniqueName="NoOfMeters"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="CreatedDate" HeaderText="Created" UniqueName="CreatedDate"
                                HeaderStyle-Width="35px" AllowFiltering="true">
                                <HeaderStyle Width="35px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <%--<telerik:GridTemplateColumn HeaderText="Status" AutoPostBackOnFilter="true" HeaderStyle-Width="15px"
                                    FilterControlWidth="50%" AllowFiltering="false">
                                    <ItemTemplate>
                                        <a href="#" onclick=" openSetStatuswindow(<%# DataBinder.Eval(Container,"DataItem.MeterReadingsHeaderID") %>,'<%# DataBinder.Eval(Container,"DataItem.StatusDescription") %>')">
                                            <img border="0" alt='<%# DataBinder.Eval(Container,"DataItem.StatusDescription") %>'
                                                src='../images/<%# DataBinder.Eval(Container,"DataItem.StatusDescription") %>.png' /></a>
                                    </ItemTemplate>
                                    <HeaderStyle Width="15px"></HeaderStyle>
                                </telerik:GridTemplateColumn>--%>
                            <telerik:GridTemplateColumn HeaderText="View/Edit Instructions" SortExpression="EditComment"
                                HeaderStyle-Width="20px" AllowFiltering="false">
                                <ItemTemplate>
                                    <a href="#" onclick='openSetCommentWindowJobCard("<%# DataBinder.Eval(Container,"DataItem.JobCardHeaderID") %>", "JobCardHeaderID")'>
                                        <img id="Img7" alt='View Comment' border="0" runat="server" src="../Images/message.png"
                                            visible='<%# Eval("Comment").ToString().Trim() != "" %>' />
                                </ItemTemplate>
                                <HeaderStyle Width="20px"></HeaderStyle>
                            </telerik:GridTemplateColumn>
                            <telerik:GridTemplateColumn HeaderText="Add Instructions" SortExpression="EditComment"
                                HeaderStyle-Width="150px" AllowFiltering="false">
                                <ItemTemplate>
                                    <a href="#" onclick='openSetCommentWindowJobCard("<%# DataBinder.Eval(Container,"DataItem.JobCardHeaderID") %>", "JobCardHeaderID")'>
                                        <img id="Message" alt='View Comment' border="0" runat="server" src="../Images/messageadd.png"
                                            visible='<%# Eval("Comment").ToString().Trim() == "" %>' />
                                </ItemTemplate>
                                <HeaderStyle Width="150px"></HeaderStyle>
                            </telerik:GridTemplateColumn>
                        </Columns>
                        <EditFormSettings ColumnNumber="3" CaptionFormatString="Edit Instructions" CaptionDataField="Comment">
                            <FormTableItemStyle Wrap="False"></FormTableItemStyle>
                            <FormCaptionStyle CssClass="EditFormHeader"></FormCaptionStyle>
                            <FormMainTableStyle GridLines="None" CellSpacing="0" CellPadding="3" Width="100%" />
                            <FormTableStyle GridLines="Horizontal" CellSpacing="0" CellPadding="2" CssClass="module"
                                Height="110px" Width="100%" />
                            <FormTableAlternatingItemStyle Wrap="False"></FormTableAlternatingItemStyle>
                            <FormStyle Width="100%" BackColor="#eef2ea"></FormStyle>
                            <EditColumn UpdateText="Update record" UniqueName="EditCommandColumn1" CancelText="Cancel edit">
                            </EditColumn>
                            <FormTableButtonRowStyle HorizontalAlign="Left" CssClass="EditFormButtonRow"></FormTableButtonRowStyle>
                        </EditFormSettings>
                        <CommandItemSettings ExportToPdfText="Export to PDF"></CommandItemSettings>
                        <RowIndicatorColumn Visible="True" FilterControlAltText="Filter RowIndicator column">
                        </RowIndicatorColumn>
                        <ExpandCollapseColumn ButtonType="ImageButton" Visible="False" UniqueName="ExpandColumn">
                            <HeaderStyle Width="19px"></HeaderStyle>
                        </ExpandCollapseColumn>
                    </MasterTableView>
                    <ExportSettings ExportOnlyData="True" FileName="RoutesDetails" IgnorePaging="True">
                    </ExportSettings>
                    <ClientSettings EnableRowHoverStyle="true">
                        <Selecting AllowRowSelect="True" UseClientSelectColumnOnly="true"></Selecting>
                        <Scrolling AllowScroll="True" UseStaticHeaders="True" SaveScrollPosition="True" />
                    </ClientSettings>
                    <FilterMenu EnableImageSprites="False">
                        <WebServiceSettings>
                            <ODataSettings InitialContainerName="">
                            </ODataSettings>
                        </WebServiceSettings>
                    </FilterMenu>
                    <HeaderContextMenu CssClass="GridContextMenu GridContextMenu_Default">
                        <WebServiceSettings>
                            <ODataSettings InitialContainerName="">
                            </ODataSettings>
                        </WebServiceSettings>
                    </HeaderContextMenu>
                </telerik:RadGrid>
                <!-- content end -->
                <%--<asp:Button ID="btnShowAll" runat="server" Text="Show All" CssClass="button" OnClick="btnShowAll_Click" />
                <asp:Button ID="btnShowPages" runat="server" Text="Show Pages" CssClass="button"
                    OnClick="btnShowPages_Click" Visible="false" />--%>
            </div>
        </div>

    </form>
</body>
</html>
