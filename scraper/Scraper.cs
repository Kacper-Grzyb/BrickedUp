using System;
using System.ComponentModel;
using System.Globalization;
using Microsoft.Playwright;

namespace scraper;

/// <summary>
/// Main component of the WebScraper
/// Contains all logic
/// </summary>
public class Scraper
{

    //static int i;

    public static async Task<List<string?>> ScrapeItem(string setNumber)
    {
        List<string?> prices = new();

        using var playwright = await Playwright.CreateAsync();

        await using var browser = await playwright.Chromium.LaunchAsync(new()
        {
            Headless = true,
        });

        string pageLink = $"https://www.ebay.com/sch/i.html?_from=R40&_trksid=p2334524.m570.l1313&_nkw=%22lego+{setNumber}%22&_sacat=0&_odkw=%22lego+40676%22&_osacat=0";

        var page = await browser.NewPageAsync();
        await page.GotoAsync(pageLink);


        string jsScrollScript = @"
            const scrolls = 10
            let scrollCount = 0

            // scroll down and then wait for 0.5s
            const scrollInterval = setInterval(() => {
            window.scrollTo(0, document.body.scrollHeight)
            scrollCount++

            if (scrollCount === numScrolls) {
                clearInterval(scrollInterval)
            }
            }, 500)
            ";

        await page.EvaluateAsync(jsScrollScript);

        var priceHTMLElements = page.Locator("css=.s-item");

        await page.WaitForTimeoutAsync(10000);

        for (var index = 0; index < await priceHTMLElements.CountAsync(); index++)
        {
            var productHTMLElement = priceHTMLElements.Nth(index);

            string? price = (await productHTMLElement.Locator("css=.s-item__price").TextContentAsync())?.Trim();

            prices.Add(price);
        }

        //Console.WriteLine("We just scraped, any key to conintue ");
        prices.ForEach(Console.WriteLine);
        Console.WriteLine();

        return prices;
    }

    /// <summary>
    /// Scrapes lego set images from duckduckgo, MIGHT FAIL PUT IT IN A TRY CATCH
    /// It cannot run headlessly
    /// </summary>
    /// <param name="setInfo">setInfo should follow follwoing example "75389+The+Dark+Falcon"</param>
    /// <returns></returns>
    public static async Task<byte[]> ScrapeImages(string setInfo)
    {
        using var playwright = await Playwright.CreateAsync();

        await using var browser = await playwright.Chromium.LaunchAsync(new()
        {
            Headless = false,
        });

        string pageLink = $"https://duckduckgo.com/?q=lego+{setInfo}&t=ffab&iar=images&iax=images&ia=images";

        var page = await browser.NewPageAsync();
        await page.GotoAsync(pageLink);

        string xPath = "xpath=/html/body/div[2]/div[4]/div[2]/div[1]/div[2]/div[2]/div[1]/div[1]/span/img";

        var imageElement = await page.Locator(xPath).ElementHandleAsync();
        if (imageElement == null)
        {
            Console.WriteLine("Image not found!");
            return [];
        }

        string? imageUrl = await imageElement.GetAttributeAsync("src");
        if (string.IsNullOrEmpty(imageUrl))
        {
            Console.WriteLine("Image URL not found!");
            return [];
        }

        imageUrl = string.Concat("https:", imageUrl);

        Console.WriteLine($"Image URL: {imageUrl}");

        // Download the image
        using var httpClient = new HttpClient();
        var imageBytes = await httpClient.GetByteArrayAsync(imageUrl);

        // Save the image to a file
        // string fileName = $"downloaded_image{i}.jpg";
        // i++;
        // await File.WriteAllBytesAsync(fileName, imageBytes);

        return imageBytes;
    }
}
