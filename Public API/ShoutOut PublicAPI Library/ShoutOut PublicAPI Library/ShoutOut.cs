using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ShoutOut_PublicAPI_Library.Models;
using Newtonsoft.Json.Linq;

namespace ShoutOut_PublicAPI_Library
{
    public class ShoutOut
    {

        #region Members

        private string _server = "http://spreadout.cloudapp.net/api/v1/search/";

        #endregion

        #region Initialiser

        public ShoutOut()
        {

        }

        #endregion

        #region Private Methods

        private async Task<string> executeCall(string url)
        {
            HttpClient client = new HttpClient();
            string ret = await client.GetStringAsync(url);
            return Uri.UnescapeDataString(ret).Replace('+', ' ');
        }

        #endregion

        #region API Calls

        public async Task<List<County>> getCountiesAsync()
        {
            string url = _server + "county";
            JArray a = JArray.Parse(await executeCall(url));

            List<County> ls = new List<County>();
            foreach (JObject o in a)
            {
                ls.Add(new County((int)o["id"], (string)o["name"]));
            }

            return ls;
        }

        public async Task<List<City>> getCitiesAsync(int countyId = -1)
        {
            string url = _server + "city";

            if (countyId >= 0) url += "?couty=" + countyId.ToString();

            JArray a = JArray.Parse(await executeCall(url));

            List<City> ls = new List<City>();
            foreach (JObject o in a)
            {
                ls.Add(new City((int)o["id"], (int)o["county_id"], (string)o["name"]));
            }

            return ls;
        }

        public async Task<List<Company>> getInstitutionsAsync(int cityId)
        {
            string url = _server + "company?city=" + cityId.ToString();

            JArray a = JArray.Parse(await executeCall(url));

            List<Company> ls = new List<Company>();
            foreach (JObject o in a)
            {
                if ((int)o["cui"] == 0)
                    ls.Add(new Company((int)o["id"], (string)o["cui"], (string)o["name"]));
            }

            return ls;
        }

        public async Task<Company> getCompanyByCUIAsync(string cui)
        {
            string url = _server + "company?cui=" + cui;

            JArray a = JArray.Parse(await executeCall(url));
            if (a.Count == 0)
                return new Company();
            else
                return new Company((int)a[0]["id"], cui, (string)a[0]["name"]);
        }

        public async Task<List<Company>> getCompanyByNameAsync(string query)
        {
            string url = _server + "company?name=" + query;
            JArray a = JArray.Parse(await executeCall(url));

            List<Company> ls = new List<Company>();
            foreach (JObject o in a)
            {
                if ((int)o["cui"] == 0)
                    ls.Add(new Company((int)o["id"], (string)o["cui"], (string)o["name"]));
            }

            return ls;
        }

        public async Task<List<Branch>> getCompanyBranchesAsync(int companyId)
        {
            string url = _server + "branch?company_id=" + companyId.ToString();

            JArray a = JArray.Parse(await executeCall(url));
            
            List<Branch> ls = new List<Branch>();
            foreach (JObject o in a)
            {
                ls.Add(new Branch((int)o["id"], companyId));
            }
            return ls;
        }

        public async Task<List<Ticket>> getTicketsAsync(int branch)
        {
            string url = _server + "ticket?branch=" + branch.ToString();
            JArray a = JArray.Parse(await executeCall(url));

            List<Ticket> ls = new List<Ticket>();
            foreach (JObject o in a)
            {
                ls.Add(new Ticket((int)o["id"],(string)o["type"], (string)o["title"], (string)o["description"], (string)o["status"]));
            }
            return ls;
        }

        public async Task<Ticket> getTicketAsync(int ticketId)
        {
            string url = _server + "ticket?id=" + ticketId.ToString();
            JArray a = JArray.Parse(await executeCall(url));
            if (a.Count == 0)
                return new Ticket();
            else
                return new Ticket((int)a[0]["id"], (string)a[0]["type"], (string)a[0]["title"], (string)a[0]["description"], (string)a[0]["status"]);
        }

        #endregion

    }
}
