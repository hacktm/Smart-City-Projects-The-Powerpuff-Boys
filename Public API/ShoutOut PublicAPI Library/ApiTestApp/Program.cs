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
            string ApiKey = "";

            Task.Run(async () =>
            {
                ShoutOut s = new ShoutOut(ApiKey);

            }).Wait();

            Console.ReadKey();
        }
    }
}
