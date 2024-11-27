using scraper_webtech;
using Supabase.Postgrest.Attributes;
using Supabase.Postgrest.Models;

namespace scraper;

public class DataProvider
{
    Supabase.Client supabase;
    private readonly string url = Program.SUPABASE_URL;
    private readonly string key = Program.SUPABASE_API_KEY;

    public DataProvider()
    {
        var options = new Supabase.SupabaseOptions
        {
            AutoConnectRealtime = true
        };

        supabase = new Supabase.Client(url, key, options);
        supabase.InitializeAsync();
    }

    //Probably should cache it somewhere to not call db every day with all the rows 
    //Is there a way to get only chnaged items or sth 
    //For now this is good enough 
    //I don't think it would matter, because then I'd need to query another table
    public async Task<List<string>> GetAllSetNumbers()
    {
        var resultSets = await supabase.From<Sets>().Get();
        var sets = resultSets.Models;

        if (sets is null or { Count: 0 })
        {
            throw new ArgumentException("List cannot be null or empty", nameof(sets));
        }

        return sets.Select(set => set.Set_number).ToList()!; //Good supression cause I check
    }

    //Idk if it should return if it was successfull or not, for now it will yeet
    public async Task Send(string setNumber, float price)
    {
        DateTime dateTime = DateTime.Now;
        DateOnly today = DateOnly.FromDateTime(dateTime);

        //Console.WriteLine($"We're about to send, {setNumber} with {price}");

        var set_price = new Set_prices
        {
            Set_number = setNumber,
            Record_date = today,
            Price = price
        };

        //Console.WriteLine("IF BELOW HERE sth is off, the object is shit");
        //Console.WriteLine(set_price);

        await supabase.From<Set_prices>().Insert(set_price);
    }

    [Table("set_prices")]
    class Set_prices : BaseModel
    {
        [Column("set_number")]
        public string? Set_number { get; set; }

        [Column("record_date")]
        public DateOnly Record_date { get; set; }

        [Column("price")]
        public float Price { get; set; }

        public override string ToString()
        {
            return string.Concat(Set_number, "\t", Record_date, "\t", Price);
        }
    }

    [Table("sets")]
    class Sets : BaseModel
    {
        [PrimaryKey("set_number")]
        public string? Set_number { get; set; }

        [Column("set_name")]
        public string? Set_name { get; set; }

        [Column("theme_id")]
        public short Theme_id { get; set; }

        [Column("subtheme_id ")]
        public short Subtheme_id { get; set; }

        [Column("release_date ")]
        public DateOnly Release_date { get; set; }

        [Column("retired_date ")]
        public DateOnly? Retired_date { get; set; }

        [Column("availability_id ")]
        public short Availability_id { get; set; }

        [Column("piece_count")]
        public short Piece_count { get; set; }

        [Column("minifigures")]
        public short Minifigures { get; set; }

        [Column("retail_price")]
        public float? Retail_price { get; set; }

        [Column("popularity")]
        public short? Popularity { get; set; }

        public override string ToString()
        {
            return string.Concat(Set_number, "\t", Set_name);
        }
    }
}
