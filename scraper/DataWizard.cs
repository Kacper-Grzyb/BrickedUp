using System;
using System.Globalization;
using System.Runtime.CompilerServices;
using System.Text.RegularExpressions;

namespace scraper;

public class DataWizard
{
    public float PriceOrMedian
    {
        get => CalculateMedian();
    }

    //Currently these properties are not really intended to be used, but want to keep them here without wasting cpu cycles
    public float TrimmedMean
    {
        get => CalculateTrimmedMean();
    }

    public float MeanOrAverage
    {
        get => CalculateMean();
    }

    private List<float> CleanPriceValues;

    public DataWizard(List<string?> priceValues)
    {
        if (priceValues is null or { Count: 0 })
        {
            throw new ArgumentException("List cannot be null or empty", nameof(priceValues));
        }

        CleanPriceValues = CleanUp(priceValues);
    }

    private List<float> CleanUp(List<string?> rawValues)
    {
        List<float> floatPriceValues = new();

        foreach (var price in rawValues)
        {
            if (price!.Contains("to"))
            {
                continue;
            }


            string clean = Regex.Replace(price!, "[^.0-9]", "");

            float converted = float.Parse(clean, CultureInfo.InvariantCulture.NumberFormat);

            //We have a magic numver 20.00 here, which might cause issues in the future
            //Right now it stays here because ebay randomly returns two items with the value of 20.00 in every listing
            if (converted != 0 && converted != 20.00)
            {
                floatPriceValues.Add(converted);
            }
            else
                continue;
        }
        floatPriceValues.Sort();

        return floatPriceValues;
    }

    private float CalculateMean()
    {
        return CleanPriceValues.Average();
    }

    /// <summary>
    /// We use the Median as a more correct price indicator than the Average (mean)
    /// </summary>
    /// <returns>What we assume to be the price</returns>
    private float CalculateMedian()
    {
        int length = CleanPriceValues.Count;

        if (length == 0)
        {
            return -1;
        }
        if (length == 2)
        {
            return (CleanPriceValues[0] + CleanPriceValues[1]) / 2;
        }
        if (length == 1)
        {
            return CleanPriceValues[0];
        }
        if (length % 2 != 0)
        {
            return CleanPriceValues[length / 2];
        }
        else
        {
            int middle = length / 2;

            float middleValue1 = CleanPriceValues[middle];
            float middleValue2 = CleanPriceValues[middle + 1];

            return (middleValue1 + middleValue2) / 2;
        }
    }

    /// <summary>
    /// Removes the top 10% and bottom 10% of values 
    /// as we assume them to be outliers and not important 
    /// for the determination of the price
    /// </summary>
    private float CalculateTrimmedMean()
    {
        var workingList = new List<float>(CleanPriceValues);

        //maybe 10 is a bit low, should use 20
        int length = CleanPriceValues.Count;
        int tenPercent = length * 10 / 100;

        workingList.RemoveRange(length - tenPercent, tenPercent);
        workingList.RemoveRange(0, tenPercent);

        return workingList.Average();
    }

    //THIS IS OLD CODE FROM BEFORE THE FIRST REFACTOR 
    //LEFT HERE FOR DOCUMENTATION PURPOSES, MIGHT GET NUKED

    /// <summary>
    /// Gets the data for the state of the object, checks that the list is not null or empty in a very stupid way
    /// </summary>
    /// <param name="priceValues"></param>
    /// <returns>0 if the operation didn't complete, 1 if the operation completed successfully</returns>
    // public int SetData(List<string?> priceValues)
    // {
    //     if (priceValues.Count == 0)
    //     {
    //         return 0;
    //     }

    //     List<string> priceValuesS = new();

    //     foreach (string? price in priceValues)
    //     {
    //         if (!string.IsNullOrEmpty(price) && !string.IsNullOrWhiteSpace(price))
    //         {
    //             priceValuesS.Add(price);
    //         }
    //         else
    //             continue;
    //     }

    //     if (priceValuesS.Count == 0)
    //     {
    //         return 0;
    //     }

    //     RawPriceValues = priceValuesS;
    //     priceValuesS.ForEach(Console.WriteLine);

    //     return 1;
    // }

    /// <summary>
    /// Gets a List<string> and converts it into a List<float>, and sorts it, hopefully
    /// </summary>
    // private void CleanUp()
    // {
    //     List<float> floatPriceValues = new();

    //     foreach (var price in RawPriceValues)
    //     {
    //         string clean = Regex.Replace(price, "[^.0-9]", "");

    //         float converted = float.Parse(clean, CultureInfo.InvariantCulture.NumberFormat);

    //         //We have a magic numver 20.00 here, which might cause issues in the future
    //         //Right now it stays here because spotoify randomly returns two items with the value of 20.00 in every listing
    //         if (converted != 0 && converted != 20.00)
    //         {
    //             floatPriceValues.Add(converted);
    //         }
    //         else
    //             continue;
    //     }
    //     floatPriceValues.Sort();
    //     CleanPriceValues = floatPriceValues;
    // }
}
