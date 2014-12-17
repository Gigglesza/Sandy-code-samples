using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Net;
using System.ServiceProcess;
using System.Text;
using System.Threading.Tasks;
using System.Timers;
using CsvHelper;
using System.Configuration;
using CsvHelper.Configuration;

namespace FTPFileDownload
{
    public partial class Service1 : ServiceBase
    {
        Timer timer1 = new Timer();
        Timer timer2 = new Timer();
        string targetDirectory = "C:\\Data\\";

        public Service1()
        {
            InitializeComponent();
        }

        protected override void OnStart(string[] args)
        {
            // Log a service start message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport in OnStart.");

            timer1.Elapsed += new ElapsedEventHandler(timer1_Elapsed);
            timer1.Interval = 60000;// 300000;
            timer1.Enabled = true;
            timer1.Start();

            //timer2.Elapsed += new ElapsedEventHandler(timer2_Elapsed);
            //timer2.Interval = 3600000;
            //timer2.Enabled = true;
            //timer2.Start();
        }

        private void timer1_Elapsed(object sender, EventArgs e)
        {
            //Run outbox stuff
            // Log a service stop message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport hit first timer.");

            // Process the list of files found in the directory. 
            string[] fileEntries = Directory.GetFiles(targetDirectory + "\\Outbox\\");
            foreach (string fileName in fileEntries)
                UploadFile(fileName);
        }

        private void timer2_Elapsed(object sender, EventArgs e)
        {
            // Log a service stop message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport hit second timer.");
            //download files from ftp
            downloadFTP();
            //process files
            ProcessFiles();

        }

        protected override void OnStop()
        {
            timer1.Enabled = false;

            // Log a service stop message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport in OnStop.");
        }

        public void UploadFile(string source)
        {
            // Log a service stop message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport hit UploadFile.");

            string ftpAddress = "ftp://aURL.co.za";
            string folderDir = "/Allocations/outbox/";
            string username = "username";
            string password = "password";
            string filename = Path.GetFileName(source);

            try
            {
                FtpWebRequest request = (FtpWebRequest)WebRequest.Create(ftpAddress + folderDir + filename);

                request.Method = WebRequestMethods.Ftp.UploadFile;

                request.Credentials = new NetworkCredential(username, password);

                StreamReader sourceStream = new StreamReader(source);

                byte[] fileContents = Encoding.UTF8.GetBytes(sourceStream.ReadToEnd());

                request.ContentLength = fileContents.Length;

                Stream requestStream = request.GetRequestStream();
                // Log a service stop message to the Application log. 
                this.eventLog1.WriteEntry("ImportExport before write.");

                requestStream.Write(fileContents, 0, fileContents.Length);
                this.eventLog1.WriteEntry("ImportExport before upload.");

                //FtpWebResponse response = (FtpWebResponse)request.GetResponse();

                //response.Close();

                requestStream.Close();

                sourceStream.Close();
                this.eventLog1.WriteEntry("ImportExport before move.");

                File.Move(source, Path.Combine(targetDirectory + "\\Outbox\\Processed\\", Path.GetFileNameWithoutExtension(filename) + DateTime.Now.ToString().Replace("/", "_").Replace(":", "") + ".csv"));
                this.eventLog1.WriteEntry("ImportExport after move.");
            }
            catch (Exception ex)
            {
                this.eventLog1.WriteEntry("File not uploaded: " + source.ToString());
                this.eventLog1.WriteEntry("Error: " + ex.ToString());
                File.Move(source, Path.Combine(targetDirectory + "\\Outbox\\Errors\\", Path.GetFileNameWithoutExtension(filename) + DateTime.Now.ToString().Replace("/", "_").Replace(":", "") + ".csv"));
            }

        }

        public void downloadFTP()
        {
            // Log a service message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport hit downloadFTP.");
            try
            {
                try
                {

                    string ftpAddress = "ftp://aUrl.co.za";
                    string folderDir = "/Readings/inbox/";
                    string username = "username";
                    string password = "password";

                    FtpWebRequest request = (FtpWebRequest)WebRequest.Create(ftpAddress + folderDir);
                    request.Method = WebRequestMethods.Ftp.ListDirectory;
                    request.Credentials = new NetworkCredential(username, password);
                    FtpWebResponse response = (FtpWebResponse)request.GetResponse();
                    Stream responseStream = response.GetResponseStream();
                    StreamReader reader = new StreamReader(responseStream);
                    List<string> result = new List<string>();
                    while (!reader.EndOfStream)
                    {
                        result.Add(reader.ReadLine());
                    }

                    reader.Close();
                    response.Close();

                    this.eventLog1.WriteEntry("ImportExport has directory listing.");

                    foreach (string file in result)
                    {
                        FtpWebRequest requestD = (FtpWebRequest)WebRequest.Create(ftpAddress + folderDir + file);

                        this.eventLog1.WriteEntry(ftpAddress + folderDir + file);

                        requestD.Method = WebRequestMethods.Ftp.DownloadFile;
                        requestD.Credentials = new NetworkCredential(username, password);
                        FtpWebResponse responseD = (FtpWebResponse)requestD.GetResponse();
                        Stream responseStreamD = responseD.GetResponseStream();
                        StreamReader readerD = new StreamReader(responseStreamD);
                        StreamWriter writerD = new StreamWriter(Path.Combine(targetDirectory + "\\Inbox\\", Path.GetFileName(file)));
                        writerD.Write(readerD.ReadToEnd());
                        writerD.Close();
                        readerD.Close();
                        responseD.Close();
                    }
                }
                catch (Exception ex)
                {
                    this.eventLog1.WriteEntry("File not downloaded");
                    this.eventLog1.WriteEntry("Error: " + ex.ToString());
                }
                try
                {

                    string ftpAddress = "ftp://aURL.co.za";
                    string folderDir = "/Readings/inbox/";
                    string username = "username";
                    string password = "password";

                    FtpWebRequest request = (FtpWebRequest)WebRequest.Create(ftpAddress + folderDir);
                    request.Method = WebRequestMethods.Ftp.ListDirectory;
                    request.Credentials = new NetworkCredential(username, password);
                    FtpWebResponse response = (FtpWebResponse)request.GetResponse();
                    Stream responseStream = response.GetResponseStream();
                    StreamReader reader = new StreamReader(responseStream);
                    List<string> result = new List<string>();
                    while (!reader.EndOfStream)
                    {
                        result.Add(reader.ReadLine());
                    }

                    reader.Close();
                    response.Close();

                    this.eventLog1.WriteEntry("ImportExport has directory listing.");

                    foreach (string file in result)
                    {
                        FtpWebRequest requestD = (FtpWebRequest)WebRequest.Create(ftpAddress + folderDir + file);

                        this.eventLog1.WriteEntry(ftpAddress + folderDir + file);

                        requestD.Method = WebRequestMethods.Ftp.DownloadFile;
                        requestD.Credentials = new NetworkCredential(username, password);
                        FtpWebResponse responseD = (FtpWebResponse)requestD.GetResponse();
                        Stream responseStreamD = responseD.GetResponseStream();
                        StreamReader readerD = new StreamReader(responseStreamD);
                        StreamWriter writerD = new StreamWriter(Path.Combine(targetDirectory + "\\Inbox\\", Path.GetFileName(file)));
                        writerD.Write(readerD.ReadToEnd());
                        writerD.Close();
                        readerD.Close();
                        responseD.Close();
                    }
                }
                catch (Exception ex)
                {
                    this.eventLog1.WriteEntry("File not downloaded");
                    this.eventLog1.WriteEntry("Error: " + ex.ToString());
                }
            }
            catch (Exception ex)
            {
                this.eventLog1.WriteEntry("File not downloaded");
                this.eventLog1.WriteEntry("Error: " + ex.ToString());
            }
        }

        public void ProcessFiles()
        {
            // Log a service stop message to the Application log. 
            this.eventLog1.WriteEntry("ImportExport hit ProcessFiles.");

            // Process the list of files found in the directory. 
            string[] fileEntries = Directory.GetFiles(targetDirectory + "\\Inbox");
            foreach (string fileName in fileEntries)
            {
                string source = Path.Combine(targetDirectory + "\\Inbox\\", Path.GetFileName(fileName));
                try
                {
                    //importfile(source);
                    ImportFile2(source);
                    ////Stream reader will read file in current folder
                    //StreamReader sr = new StreamReader(source);
                    ////Csv reader reads the stream
                    //CsvReader csvread = new CsvReader(sr);

                    ////csvread will fetch all record in one go to the IEnumerable object record
                    //IEnumerable<MeterRead> record = csvread.GetRecords<TestRecord>();

                    //foreach (var rec in record) // Each record will be fetched and printed on the screen
                    //{
                    //    Response.Write(string.Format("Name : {0}, Sex : {1}, Occupation : {2} <br/>", rec.name, rec.sex, rec.occupation));
                    //}
                    //sr.Close();

                    File.Move(source, Path.Combine(targetDirectory + "\\Inbox\\Processed\\", Path.GetFileNameWithoutExtension(fileName) + DateTime.Now.ToString().Replace("/", "_").Replace(":", "") + ".csv"));
                }
                catch (Exception ex)
                {
                    this.eventLog1.WriteEntry("Error: " + ex.ToString());
                    this.eventLog1.WriteEntry("Error: " + Path.Combine(targetDirectory + "\\Inbox\\Processed\\", Path.GetFileNameWithoutExtension(fileName) + DateTime.Now.ToString().Replace("/", "_").Replace(":", "") + ".csv"));
                    this.eventLog1.WriteEntry("File not uploaded: " + source.ToString());
                    File.Move(source, Path.Combine(targetDirectory + "\\Inbox\\Errors\\", Path.GetFileNameWithoutExtension(fileName) + DateTime.Now.ToString().Replace("/", "_").Replace(":", "") + ".csv"));
                }
            }
        }

        public void importfile(string source)
        {
            SqlConnection con = new SqlConnection(ConfigurationManager.ConnectionStrings["AMRConnection"].ConnectionString);//System.Configuration.ConfigurationSettings.ConnectionStrings["SebataAMREntities"]);
            string filepath = source;
            StreamReader sr = new StreamReader(filepath);
            string line = sr.ReadLine();
            string[] value = line.Split(',');
            DataTable dt = new DataTable();
            DataRow row;
            foreach (string dc in value)
            {
                dt.Columns.Add(new DataColumn(dc));
            }

            while (!sr.EndOfStream)
            {
                value = sr.ReadLine().Split(',');
                if (value.Length == dt.Columns.Count)
                {
                    row = dt.NewRow();
                    row.ItemArray = value;
                    dt.Rows.Add(row);
                }
            }
            SqlBulkCopy bc = new SqlBulkCopy(con.ConnectionString, SqlBulkCopyOptions.TableLock);
            bc.DestinationTableName = "MeterReading";
            bc.BatchSize = dt.Rows.Count;
            con.Open();
            bc.WriteToServer(dt);
            bc.Close();
            con.Close();
        }

        public void ImportFile2(string source)
        {
            StreamReader sr = new StreamReader(source);
            //Csv reader reads the stream
            CsvReader csvread = new CsvReader(sr);
            csvread.Configuration.RegisterClassMap<MeterReadingcsvMap>();
            try
            {
                //csvread will fetch all record in one go to the IEnumerable object record
                IEnumerable<MeterReadingcsv> record = csvread.GetRecords<MeterReadingcsv>();

                foreach (MeterReadingcsv rec in record) // Each record will be fetched and printed on the screen
                {
                    System.Data.SqlClient.SqlConnection sqlConnection1 = new System.Data.SqlClient.SqlConnection(ConfigurationManager.ConnectionStrings["SebataAMRConnection"].ConnectionString);

                    System.Data.SqlClient.SqlCommand cmd = new System.Data.SqlClient.SqlCommand();
                    cmd.CommandType = System.Data.CommandType.Text;
                    cmd.CommandText = @"INSERT MeterReading (CellID, ProductType, UnitID, AreaCode, EndOfMonth, EndOfMonthDay, MeterTotalToDate, WMDOverrideStatus, WMDTamperStatus, WMDValveState, WMDValveFault, WMDLeakStatus, TSDateTime, TSInsertedDate) 
                                    VALUES (" + rec.CellID + ", " + rec.ProductType + ", " + rec.UnitID + ", " + rec.AreaCode + ", " + rec.EndOfMonth + ", " + rec.EndOfMonthDay + ", " + rec.MeterTotalToDate + ", '" + rec.WMDOverrideStatus + "', '" + rec.WMDTamperStatus + "', '" + rec.WMDValveState + "', '" + rec.WMDValveFault + "', '" + rec.WMDLeakStatus + "', '" + rec.TSDateTime + "', '" + rec.TSInsertedDate + "')";
                    cmd.Connection = sqlConnection1;

                    sqlConnection1.Open();
                    cmd.ExecuteNonQuery();
                    sqlConnection1.Close();
                }
            }
            catch (Exception ex)
            {

            }
            finally
            {
                sr.Close();
            }
        }
    }

    public class MeterReadingcsv
    {
        public string CellID { get; set; }
        public string ProductType { get; set; }
        public string UnitID { get; set; }
        public string AreaCode { get; set; }
        public string EndOfMonth { get; set; }
        public string EndOfMonthDay { get; set; }
        public string MeterTotalToDate { get; set; }
        public string WMDOverrideStatus { get; set; }
        public string WMDTamperStatus { get; set; }
        public string WMDValveState { get; set; }
        public string WMDValveFault { get; set; }
        public string WMDLeakStatus { get; set; }
        public string TSDateTime { get; set; }
        public string TSInsertedDate { get; set; }

        public string VBAT { get; set; }
        public string RSSI { get; set; }
        public string Conf { get; set; }
        public string FW { get; set; }
        public string WACC { get; set; }
    }

    public class MeterReadingcsvMap : CsvClassMap<MeterReadingcsv>
    {
        public override void CreateMap()
        {
            Map(m => m.CellID).Index(0);
            Map(m => m.ProductType).Index(1);
            Map(m => m.UnitID).Index(2);
            Map(m => m.AreaCode).Index(3);
            Map(m => m.EndOfMonth).Index(4);
            Map(m => m.EndOfMonthDay).Index(5);
            Map(m => m.MeterTotalToDate).Index(6);
            Map(m => m.WMDOverrideStatus).Index(7);
            Map(m => m.WMDTamperStatus).Index(8);
            Map(m => m.WMDValveState).Index(9);
            Map(m => m.WMDValveFault).Index(10);
            Map(m => m.WMDLeakStatus).Index(11);
            Map(m => m.TSDateTime).Index(12);
            Map(m => m.TSInsertedDate).Index(13);
        }
    }
}
