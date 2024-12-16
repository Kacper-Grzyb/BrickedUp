using System;

namespace scraper;

public interface IDataProvider
{
    public Task<List<string>> GetAllSetNumbers();

    public Task Send(string setNumber, float price);

    public Task Send(string setNumber, byte[] image);

    public Task<List<(string, string)>> GetAllSetNumbersAndNames();

}
