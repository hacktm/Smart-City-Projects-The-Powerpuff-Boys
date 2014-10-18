using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Company
    {

        #region Members

        private string _CUI = "";
        public string CUI { get { return _CUI; } }

        private string _Name = "";
        public string Name { get { return _Name; } }

        #endregion

        #region Initialiser

        public Company()
        { 
        
        }

        internal Company(string name, string cui)
        {
            _Name = name;
            _CUI = cui;
        }

        #endregion

    }
}
