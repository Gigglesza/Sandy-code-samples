<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="QuickMeterHistory.aspx.cs" Inherits="MetermanWeb.MobileManagement.QuickMeterHistory" %>

<%@ Register TagPrefix="telerik" Namespace="Telerik.Web.UI" Assembly="Telerik.Web.UI" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>Meterman Website</title>
    <%----%>
    <link href="../Styles/meterMan.css" rel="stylesheet" type="text/css" />
    <link href="../Styles/meterMan.css" rel="stylesheet" type="text/css" />
    <script src="../Scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
</head>
<body>
    <script type="text/javascript">
        function closeAdd() {
            opener.document.getElementById('btDisplay').click();
            window.top.close();
        }

        function Refresh() {
            window.onunload = refreshParent;
            function refreshParent() {
                window.opener.location.reload();
            }
        }
    </script>
    <form id="form1" runat="server">
        <%--<div id="container">--%>
            <div id="Div1">
        <div id="PageTitle">
                    <h4>Meter History for Meter Number:
                    <asp:Label ID="lblMeterNo" runat="server" Text=""></asp:Label></h4>
                </div>
                <telerik:RadScriptManager ID="RadScriptManager1" runat="server">
        </telerik:RadScriptManager>
                <telerik:RadAjaxManager ID="RadAjaxManager1" runat="server">
            </telerik:RadAjaxManager>
    <div id="content" style="min-height: 400px;">
                   <%--<asp:EntityDataSource ID="dsRoute" runat="server" ConnectionString="name=MetermanEntities"
                DefaultContainerName="MetermanEntities" 
                EnableFlattening="False" EntitySetName="WebNM_Rep_RouteName_vw"
                Select="it.[RouteName]" OrderBy="it.[RouteName]" 
                Where="it.[ContractID] = @ContractID"
                ContextTypeName="MetermanWeb.Dbase.MetermanEntities" >             
            </asp:EntityDataSource>--%>
        <telerik:RadGrid ID="grdMeterReadingDetails" runat="server" PageSize="10" 
                    GridLines="None" AllowPaging="true"
                Width="95%" AutoGenerateColumns="false" 
                AllowFilteringByColumn="false" CssClass="mGrid" AllowSorting="true" 
                    onneeddatasource="grdMeterReadingDetails_NeedDataSource"  >
                <GroupingSettings CaseSensitive="false" />
                <MasterTableView CommandItemDisplay="Top" NoMasterRecordsText="No records found">
                    <PagerStyle Mode="NextPrevNumericAndAdvanced"   />
                    <CommandItemSettings ShowExportToWordButton="false" ShowExportToExcelButton="false"
                        ShowExportToCsvButton="false" ShowAddNewRecordButton="false" ShowRefreshButton="false" />
                    <Columns>
                        <telerik:GridBoundColumn HeaderText="Route" DataField="RouteName" UniqueName="RouteName" SortExpression="RouteName" >
                            <%--<FilterTemplate>
                                <telerik:RadComboBox runat="server" ID="FilterCombo" DataSourceID="dsRoute" DataValueField="RouteName"
                                    DataTextField="RouteName" AppendDataBoundItems="true" SelectedValue='<%# ((GridItem)Container).OwnerTableView.GetColumn("RouteName").CurrentFilterValue %>'
                                    OnClientSelectedIndexChanged="RouteIndexChanged" Width="70px">
                                    <Items>
                                        <telerik:RadComboBoxItem Text="All" />
                                    </Items>
                                </telerik:RadComboBox>
                                <telerik:RadScriptBlock ID="RadScriptBlock1" runat="server">
                                    <script type="text/javascript">
                                        function RouteIndexChanged(sender, args) {
                                            var tableView = $find("<%# ((GridItem)Container).OwnerTableView.ClientID %>");
                                            tableView.filter("RouteName", args.get_item().get_value(), "EqualTo");
                                        }
                                    </script>
                                </telerik:RadScriptBlock>
                            </FilterTemplate>--%>
                        </telerik:GridBoundColumn>
                        <telerik:GridBoundColumn HeaderText="Reading Point" DataField="ReadingPoint" UniqueName="ReadingPoint" SortExpression="ReadingPoint" />
                        <telerik:GridBoundColumn HeaderText="Meter No." DataField="ClientMeterNo" UniqueName="ClientMeterNo" SortExpression="ClientMeterNo" />
                        <telerik:GridBoundColumn HeaderText="Meter Type" DataField="MeterType" UniqueName="MeterType" SortExpression="MeterType" />
                        <telerik:GridBoundColumn HeaderText="Previous Reading" DataField="PreviousReading" UniqueName="PreviousReading" SortExpression="PreviousReading"  />
                        <telerik:GridBoundColumn HeaderText="Current Reading" DataField="MeterReading" UniqueName="MeterReading" SortExpression="MeterReading"  />
                        <telerik:GridBoundColumn HeaderText="Read Date" DataField="MeterReadingDate" UniqueName="MeterReadingDate" SortExpression="MeterReadingDate"
                            DataFormatString="{0:dd/MM/yyyy HH:mm}" HeaderStyle-Width="350px">
                        </telerik:GridBoundColumn>
                        <telerik:GridBoundColumn HeaderText="GPS Latitude" DataField="GPSLatitude" UniqueName="GPSLatitude" SortExpression="GPSLatitude" /> 
                        <telerik:GridBoundColumn HeaderText="GPS Longitude" DataField="GPSLongitude" UniqueName="GPSLongitude" SortExpression="GPSLongitude" /> 
                        <telerik:GridBoundColumn HeaderText="Error Code" DataField="ErrorCode1" UniqueName="ErrorCode1" SortExpression="ErrorCode1" />
                        <telerik:GridBoundColumn HeaderText="Location" DataField="Location1" UniqueName="Location1" SortExpression="Location1" />
                        </Columns>
                    </MasterTableView>
                </telerik:RadGrid>

        <asp:Label ID="lblErrormsg" Visible="false" runat="server"></asp:Label>
    </div>
                </div>
            <%--</div>--%>
    </form>
</body>
</html>
