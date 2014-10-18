using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ShoutOut_PublicAPI_Library.Models
{
    public class Branch
    {

        #region Members

        private int _ID = 0;
        public int ID { get { return _ID; } }

        private int _CompanyID = 0;
        public int CompanyID { get { return _CompanyID; } }

        #endregion

        #region Initialiser

        public Branch()
        { 
        
        }

        internal Branch(int id, int companyid)
        {
            _ID = id;
            _CompanyID = companyid;
        }

        #endregion

    }
}
