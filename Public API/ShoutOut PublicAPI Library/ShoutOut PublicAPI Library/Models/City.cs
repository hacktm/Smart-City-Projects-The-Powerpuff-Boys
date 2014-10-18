using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class City
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private int _CountyID = 0;
        public int CountyID { get { return _CountyID; } }

        private string _Name = "";
        public string Name { get { return _Name; } }

        #endregion

        #region Initialiser

        public City()
        { 
        
        }

        internal City(int id, int countyid, string name)
        {
            _ID = id;
            _CountyID = countyid;
            _Name = name;
        }

        #endregion

    }
}
