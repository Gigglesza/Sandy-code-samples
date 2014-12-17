<%@ Page Language="C#" AutoEventWireup="true" EnableEventValidation="false" CodeBehind="ViewWorkOrders.aspx.cs"
    Inherits="MetermanWeb.MobileManagement.ViewWorkOrders" %>

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
<!--


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
    <script>
        function getURLParameter(name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
        }
    </script>
    <style>
        .rcbScroll
        {
            overflow-y: auto;
            overflow-x: hidden !important;
        }

        .hidden
        {
            display: none;
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
    <form id="form1" runat="server" defaultbutton="btnSearch">
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
                                        <input id="btnAddOther" runat="server" type="button" value="Add Meter To Be Repaired/Replaced" /><%-- onclick="setTimeout('location.reload(false);', 50000);" />--%>
                                        <asp:Button ID="btnDelete" runat="server" Text="Delete Selected Meters" OnClick="btnDelete_Click" />
                                        <br />
                                        <asp:Button ID="btnBack" runat="server" CssClass="button" Text="Back To Work Orders" OnClick="btnBack_Click" />
                                        <asp:Button ID="btnSame" runat="server" CssClass="button" Text="Add Same Instruction To All" OnClientClick="openSetCommentWindowJobCardHeader(getURLParameter('JobCardHeaderID'))" />

                                        <asp:HiddenField ID="hidGridToExport" runat="server" />
                                        <asp:HiddenField ID="hidJobCardID" runat="server" />
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <asp:Label ID="lblError" runat="server" Text=""></asp:Label>
                                    </td>
                                    <td valign="top"></td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div id="AddItem" style="display: none" runat="server">
                    <table>
                        <tr>
                            <td>
                                <h4>Search For Item</h4>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Account No:</td>
                            <td>
                                <asp:TextBox ID="txtAccountSearch" runat="server"></asp:TextBox></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Consumer Surname:</td>
                            <td>
                                <asp:TextBox ID="txtConsumerSearch" runat="server"></asp:TextBox></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>
                                <asp:TextBox ID="txtAddressSearch" runat="server"></asp:TextBox></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Stand No:</td>
                            <td>
                                <asp:TextBox ID="txtStandNo" runat="server"></asp:TextBox></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Button ID="btnSearch" runat="server" Text="Search" OnClick="btnSearch_Click" />
                            </td>
                            <td></td>
                            <td style="width: 70%"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <telerik:RadGrid ID="gvAddingItems" runat="server" AutoGenerateColumns="false" GridLines="None"
                                    CssClass="mGrid" AlternatingRowStyle-CssClass="alt" AllowSorting="true"
                                    OnNeedDataSource="gvAddingItems_NeedDataSource" AllowPaging="false" PageSize="20" >
                                    <MasterTableView DataKeyNames="MeterReadingsDetailsID">
                                        <Columns>
                                            <telerik:GridBoundColumn HeaderText="MeterReadingsDetailsID" Visible="true" DataField="MeterReadingsDetailsID" ItemStyle-Width="0px" HeaderStyle-Width="0px" HeaderStyle-CssClass="hidden" ItemStyle-BorderStyle="NotSet" ItemStyle-CssClass="hidden" />
                                            <telerik:GridTemplateColumn HeaderText="Mark for Repairs"
                                                SortExpression="markRepairs" ItemStyle-HorizontalAlign="Center">
                                                <ItemTemplate>
                                                    <asp:CheckBox ID="chkMarkRepairs" runat="server" />
                                                </ItemTemplate>
                                                <ItemStyle HorizontalAlign="Center"></ItemStyle>
                                            </telerik:GridTemplateColumn>
                                            <telerik:GridBoundColumn HeaderText="Account No" DataField="ClientAccountNumber" SortExpression="ClientAccountNumber" />
                                            <telerik:GridBoundColumn HeaderText="Meter Number" Visible="true" DataField="ClientMeterNo" SortExpression="ClientMeterNo" />
                                            <telerik:GridBoundColumn HeaderText="Customer Name" DataField="ClientCustomerName" SortExpression="ClientCustomerName" />
                                            <telerik:GridBoundColumn HeaderText="Address" DataField="ClientCustomerAddress" SortExpression="ClientCustomerAddress" />
                                            <telerik:GridBoundColumn HeaderText="Stand No" DataField="ClientStandNo" SortExpression="ClientStandNo" />
                                            <telerik:GridBoundColumn HeaderText="Dials" DataField="MeterDials" SortExpression="MeterDials" />
                                            <telerik:GridBoundColumn HeaderText="Meter Type" DataField="MeterType" SortExpression="MeterType" />
                                        </Columns>
                                    </MasterTableView>
                                    <PagerStyle CssClass="paging" />
                                </telerik:RadGrid>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <asp:Button ID="btnAddItems" runat="server" Text="Add Selected Items" OnClick="btnAddItems_Click" Visible="false" />
                            </td>
                            <td></td>
                            <td style="width: 70%"></td>
                        </tr>
                    </table>
                </div>
                <telerik:RadGrid CssClass='Grid.Telerik.css' ID="gvSearchResults" runat="server" AllowMultiRowSelection="true"
                    RegisterWithScriptManager="false" AllowSorting="True" OnNeedDataSource="gvSearchResults_NeedDataSource"
                    CellSpacing="0" Width="100%" Height="400px" AllowFilteringByColumn="true">
                    <MasterTableView DataKeyNames="JobCardHeaderID"
                        EditMode="InPlace" AutoGenerateColumns="false" Font-Italic="False" AllowCustomSorting="false"
                        AllowMultiColumnSorting="True" TableLayout="Fixed" BorderStyle="none" Width="2000px"
                        CommandItemDisplay="Top">
                        <CommandItemSettings ShowExportToExcelButton="false" ShowAddNewRecordButton="false"></CommandItemSettings>
                        <Columns>
                            <telerik:GridClientSelectColumn UniqueName="MarkCHK" HeaderText="Select All" ItemStyle-Width="20px" HeaderStyle-Width="20px" HeaderTooltip="Select All">
                            </telerik:GridClientSelectColumn>
                            <telerik:GridBoundColumn HeaderText="Work Order No" DataField="JobCardDetailsID" Visible="true" UniqueName="JobCardDetailsID"
                                HeaderStyle-Width="20px">
                                <HeaderStyle Width="20px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn HeaderText="Meter No" DataField="ClientMeterNo" Visible="true" SortExpression="Route"
                                UniqueName="ClientMeterNo" HeaderStyle-Width="20px">
                                <HeaderStyle Width="20px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="ErrorCode1" HeaderText="Discrepancy" UniqueName="ErrorCode1"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="MeterType" HeaderText="Meter Type" UniqueName="MeterType"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="ClientAccountNumber" HeaderText="Account No" UniqueName="ClientAccountNumber"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="ClientCustomerName" HeaderText="Client Name" UniqueName="ClientCustomerName"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridBoundColumn DataField="ClientCustomerAddress" HeaderText="Address" UniqueName="ClientCustomerAddress"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridBoundColumn>
                            <telerik:GridTemplateColumn HeaderText="View/Edit Instructions" SortExpression="EditComment"
                                HeaderStyle-Width="15px" AllowFiltering="false">
                                <ItemTemplate>
                                    <a href="#" onclick='openSetCommentWindowJobCardDetail("<%# DataBinder.Eval(Container,"DataItem.JobCardDetailsID") %>", "JobCardDetailsID")'>
                                        <img id="Img7" alt='View Instructions' border="0" runat="server" src="../Images/message.png"
                                            visible='<%# Eval("ENote").ToString().Trim() != "" %>' />
                                </ItemTemplate>
                                <HeaderStyle Width="15px"></HeaderStyle>
                            </telerik:GridTemplateColumn>
                            <telerik:GridTemplateColumn HeaderText="Add Instructions" SortExpression="EditComment"
                                HeaderStyle-Width="150px" AllowFiltering="false">
                                <ItemTemplate>
                                    <a href="#" onclick='openSetCommentWindowJobCardDetail("<%# DataBinder.Eval(Container,"DataItem.JobCardDetailsID") %>")'>
                                        <img id="Message" alt='View Instructions' border="0" runat="server" src="../Images/messageadd.png"
                                            visible='<%# Eval("ENote").ToString().Trim() == "" %>' />
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
    <script>
        $(document).ready(function () {
            $('#btnAddOther').click(function () {
                $("#AddItem").toggle();
            });
        });
    </script>
</body>
</html>
