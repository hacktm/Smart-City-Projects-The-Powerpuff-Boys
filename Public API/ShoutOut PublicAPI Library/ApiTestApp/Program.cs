using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ShoutOut_PublicAPI_Library;
using ShoutOut_PublicAPI_Library.Models;

namespace ApiTestApp
{
    class Program
    {
        static void Main(string[] args)
        {
            Task.Run(async () =>
            {
                ShoutOut s = new ShoutOut();

                var a = await s.getCountiesAsync();
                var b = await s.getCitiesAsync(a[0].ID);
                var c = await s.getInstitutionsAsync(b[0].ID);
                var d = await s.getCompanyByCUIAsync("1");
                var e = await s.getCompanyByNameAsync("a");
                var f = await s.getTicketsAsync(1);
                var g = await s.getTicketAsync(1);

                Console.WriteLine("Done!");
            }).Wait();

            Console.ReadKey();
        }
    }
}
