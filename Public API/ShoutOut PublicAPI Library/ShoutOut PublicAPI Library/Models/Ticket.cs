using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Ticket
    {

        #region Enum

        public enum TicketType
        {
            Undefined,
            Complaint,
            Proposal
        };

        public enum TicketStatus
        {
            Undefined,
            Opened,
            Pending,
            Assigned,
            Solved,
            Duplicate,
            Refused
        };

        #endregion

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private TicketType _Type = TicketType.Undefined;
        public TicketType Type { get { return _Type; } }

        private string _Title = "";
        public string Title { get { return _Title; } }

        private string _ShortDescription = "";
        public string ShortDescription { get { return _ShortDescription; } }

        private string _Description = "";
        public string Description { get { return _Description; } }

        private TicketStatus _Status = TicketStatus.Undefined;
        public TicketStatus Status { get { return _Status; } }

        private double _Lat = 0.0;
        public double Lat { get { return _Lat; } }

        private double _Lon = 0.0;
        public double Lon { get { return _Lon; } }

        #endregion

        #region Initialiser

        public Ticket()
        {

        }

        internal Ticket(int id, TicketType type, string title, string shortD, string description, TicketStatus status , double lat = 0.0, double lon = 0.0)
        {
            _ID = id;
            _Type = type;
            _Title = title;
            _ShortDescription = shortD;
            _Description = description;
            _Status = status;
            _Lat = lat;
            _Lon = lon;
        }

        #endregion

    }
}
