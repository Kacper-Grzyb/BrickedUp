using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.Tokens;
using static System.Console;
using scraper;

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

    public static async Task Main(string[] args)
    {
        if (args.Length == 0)
        {
            HelpMessage();
            return;
        }

        string command = args[0].ToLower();

        switch (command)
        {
            case "--prices":
                await ScrapePrices();
                break;

            case "--images":
                await ScrapeImages();
                break;

            default:
                WriteLine($"Unknown command: {command}");
                HelpMessage();
                break;
        }

    }

    public static async Task ScrapePrices()
    {
        DataProvider dataProvider = new DataProvider();

        var setNumbers = await dataProvider.GetAllSetNumbers();

        foreach (var set in setNumbers)
        {
            WriteLine(set);
            List<string?> pricesForSet;

            try
            {
                pricesForSet = await Scraper.ScrapeItem(set);
            }
            catch (Exception e)
            {
                WriteLine(e);
                continue;
            }

            DataWizard dataWizard = new(pricesForSet);

            await dataProvider.Send(setNumber: set, price: dataWizard.PriceOrMedian);

            await Task.Delay(1000);
        }
    }

    public static async Task ScrapeImages()
    {
        DataProvider dataProvider = new DataProvider();

        var a = await dataProvider.GetAllSetNumbersAndNames();


        foreach (var set in a)
        {
            byte[] image;

            string setInfo = string.Concat(set.Item1, "+", set.Item2);

            try
            {
                image = await Scraper.ScrapeImages(setInfo);
                await Task.Delay(500);
            }
            catch (Exception e)
            {
                WriteLine(e);
                continue;
            }

            WriteLine();

            string fileName = "downloaded_image.jpg";
            await File.WriteAllBytesAsync(fileName, image);


            await dataProvider.Send(set.Item1, image);
        }

        ReadLine();
    }

    private static void HelpMessage()
    {
        WriteLine("Program to scrape lego prices and images");
        WriteLine();
        WriteLine("Valid options: ");
        WriteLine("--prices\t\t\t Starts scraping the price for all sets in the db");
        WriteLine("--images\t\t\t Scrapes images for all sets in the db CANNOT RUN HEADLESSLY");
    }
}
