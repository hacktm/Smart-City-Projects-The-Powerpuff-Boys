using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ShoutOut_PublicAPI_Library.Models;

namespace ShoutOut_PublicAPI_Library
{
    public class ShoutOut
    {

        #region Members

        private string _server = "/public_api/";

        private bool keyVerified = false;

        private bool keyValid = false;

        private string _API_Key = "";
        public string API_Key { get { return _API_Key; } }

        #endregion

        #region Initialiser

        public ShoutOut(string api_key)
        {
            _API_Key = api_key;
        }

        #endregion

        #region Private Methods

        private string getApiUrl(string method)
        { 
            return _server + method + "/api_key=" + _API_Key;
        }

        private async Task<bool> isKeyValid()
        {
            if (keyVerified)
                return keyValid;
            else
            {
                HttpClient client = new HttpClient();
                string res = await client.GetStringAsync(_server + "isKeyValid?api_key=" + _API_Key);
                keyVerified = true;
                keyValid = true; //!!!!!
                return keyValid;
            }
        }

        private async Task<string> executeCall(string url)
        {
            if (await isKeyValid())
            {
                HttpClient client = new HttpClient();
                return await client.GetStringAsync(url);
            }
            throw new KeyNotFoundException("API Key is not Valid!");
        }

        #endregion

        #region API Calls

        public async Task<List<County>> getCountiesAsync()
        {
            string url = getApiUrl("getCounties");
            string res = await executeCall(url);

            List<County> ls = new List<County>();
            return ls;
        }

        public async Task<List<City>> getCitiesAsync(int countyId = -1)
        {
            string url = getApiUrl("getCities");
            if (countyId >= 0) url += "&couty=" + countyId.ToString();
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("CountyID not found.");

            List<City> ls = new List<City>();
            return ls;
        }

        public async Task<Company> getInstitutionsAsync(string cityId)
        {
            string url = getApiUrl("getInstitutions") + "&city=" + cityId;
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("CityID not found.");

            return new Company("", "");
        }

        public async Task<Company> getCompanyByCUIAsync(string cui)
        {
            string url = getApiUrl("getCompany") + "&cui=" + cui;
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("CUI not found.");

            return new Company("", "");
        }

        public async Task<List<Company>> getCompanyByNameAsync(string query)
        {
            string url = getApiUrl("getCompanyByName") + "&query=" + query;
            string res = await executeCall(url);

            List<Company> ls = new List<Company>();
            return ls;
        }

        public async Task<List<Branch>> getCompanyBranchesAsync(string cui)
        {
            string url = getApiUrl("getCompanyBranches") + "&cui=" + cui;
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("CUI not found.");

            List<Branch> ls = new List<Branch>();
            return ls;
        }

        public async Task<List<Ticket>> getTicketsAsync(int branch)
        {
            string url = getApiUrl("getTickets") + "&branch=" + branch.ToString();
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("BranchID not found.");

            List<Ticket> ls = new List<Ticket>();
            return ls;
        }

        public async Task<Ticket> getTicketAsync(int ticketId)
        {
            string url = getApiUrl("getTicket") + "&ticket=" + ticketId.ToString();
            string res = await executeCall(url);

            if (res == "")
                throw new KeyNotFoundException("TicketID not found.");

            return new Ticket(0, Ticket.TicketType.Undefined, "", "", "", Ticket.TicketStatus.Opened, 0.0, 0.0);
        }

        #endregion

    }
}
