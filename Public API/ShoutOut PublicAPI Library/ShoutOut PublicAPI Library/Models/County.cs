using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class County
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private string _Name = "";
        public string Name { get { return _Name; } }

        #endregion

        #region Initialiser

        public County()
        { 
        
        }

        internal County(int id, string name)
        {
            _ID = id;
            _Name = name;
        }

        #endregion

    }
}
