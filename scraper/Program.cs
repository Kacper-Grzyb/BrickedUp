using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.Tokens;
using scraper;
using scraper_webtech;

public class Program
{
    public static readonly string SUPABASE_URL;
    public static readonly string SUPABASE_API_KEY;

    static Program()
    {
        IConfigurationRoot config = new ConfigurationBuilder()
           .AddUserSecrets<Program>()
           .Build();

        if (config["SUPABASE_API_KEY"] is null)
        {
            throw new Exception("No api key set up");
        }
        if (config["SUPABASE_URL"] is null)
        {
            throw new Exception("No supabase url set up");
        }

        SUPABASE_API_KEY = config["SUPABASE_API_KEY"]!;
        SUPABASE_URL = config["SUPABASE_URL"]!;
    }

    public static async Task Main()
    {
        DataProvider dataProvider = new();

        var setNumbers = await dataProvider.GetAllSetNumbers();

        foreach (var set in setNumbers)
        {
            Console.WriteLine(set);
            List<string?> pricesForSet = await Scraper.ScrapeItem(set);

            DataWizard dataWizard = new(pricesForSet);

            await dataProvider.Send(setNumber: set, price: dataWizard.PriceOrMedian);

            await Task.Delay(1000);
        }
    }
}
