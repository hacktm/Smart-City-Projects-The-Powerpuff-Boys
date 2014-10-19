using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Company
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private string _CUI = "";
        public string CUI { get { return _CUI; } }

        private string _Name = "";
        public string Name { get { return _Name; } }

        #endregion

        #region Initialiser

        public Company()
        { 
        
        }

        internal Company(int id, string name, string cui)
        {
            _ID = id;
            _Name = name;
            _CUI = cui;
        }

        #endregion

    }

}
