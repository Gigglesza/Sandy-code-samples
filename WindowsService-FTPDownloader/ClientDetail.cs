//------------------------------------------------------------------------------
// <auto-generated>
//    This code was generated from a template.
//
//    Manual changes to this file may cause unexpected behavior in your application.
//    Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace WindowsService1
{
    using System;
    using System.Collections.Generic;
    
    public partial class ClientDetail
    {
        public ClientDetail()
        {
            this.ConcentratorDetails = new HashSet<ConcentratorDetail>();
            this.MeterDetails = new HashSet<MeterDetail>();
        }
    
        public int ID { get; set; }
        public string Name { get; set; }
    
        public virtual ICollection<ConcentratorDetail> ConcentratorDetails { get; set; }
        public virtual ICollection<MeterDetail> MeterDetails { get; set; }
    }
}