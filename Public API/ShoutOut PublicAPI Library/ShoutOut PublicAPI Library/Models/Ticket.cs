using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Ticket
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private string _Type = "";
        public string Type { get { return _Type; } }

        private string _Title = "";
        public string Title { get { return _Title; } }

        private string _Description = "";
        public string Description { get { return _Description; } }

        private string _Status = "";
        public string Status { get { return _Status; } }


        #endregion

        #region Initialiser

        public Ticket()
        {

        }

        internal Ticket(int id, string type, string title, string description, string status)
        {
            _ID = id;
            _Type = type;
            _Title = title;
            _Description = description;
            _Status = status;
        }

        #endregion

    }
}
