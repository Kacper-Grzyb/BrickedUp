using System;
using System.ComponentModel;
using Microsoft.Playwright;

namespace scraper_webtech;

/// <summary>
/// Main component of the WebScraper
/// Contains all logic
/// </summary>
public class Scraper
{
    public static async Task notMain()
    {
        Scraper scraper = new();

        var a = await scraper.ScrapeItem("10212");

        a.ForEach(Console.WriteLine);
    }

    public async Task<List<string?>> ScrapeItem(string setNumber)
    {
        List<string?> prices = new();

        using var playwright = await Playwright.CreateAsync();

        await using var browser = await playwright.Chromium.LaunchAsync(new()
        {
            Headless = false,
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

        return prices;
    }
}
