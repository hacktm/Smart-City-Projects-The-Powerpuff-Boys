using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Institution
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private string _Name = "";
        public string Name { get { return _Name; } }

        private int _CityID = 0;
        public int CityID { get { return _CityID; } }

        #endregion

        #region Initialiser

        public Institution()
        { 
        
        }

        internal Institution(int id, string name, int cityid)
        {
            _ID = id;
            _Name = name;
            _CityID = cityid;
        }

        #endregion

    }
}
