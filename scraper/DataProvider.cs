using Supabase.Postgrest.Attributes;
using Supabase.Postgrest.Models;

namespace scraper;

public class DataProvider : IDataProvider
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

        await supabase.From<Set_prices>().Insert(set_price);
    }

    public async Task Send(string setNumber, byte[] image)
    {
        string base64Image = Convert.ToBase64String(image);

        var set_image = new Set_images { Set_number = setNumber, Image_data = base64Image };

        await supabase.From<Set_images>().Insert(set_image);
    }

    /// <summary>
    /// To use when searching sets on the web 
    /// </summary>
    /// <returns>set number and it's name in the following format eg. "75389+The+Dark+Falcon"</returns>
    /// <exception cref="ArgumentException"></exception>
    public async Task<List<(string, string)>> GetAllSetNumbersAndNames()
    {
        var resultSets = await supabase.From<Sets>().Get();
        var sets = resultSets.Models;

        if (sets is null or { Count: 0 })
        {
            throw new ArgumentException("List cannot be null or empty", nameof(sets));
        }

        //Idk if returing tuples is the right way or if I should use a struct for it 
        List<(string, string)> setInfo = sets.Select(item => (item.Set_number, item.Set_name!.Replace(" ", "+")))
            .ToList()!;

        return setInfo;
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

    [Table("set_images")]
    class Set_images : BaseModel
    {
        [Column("set_number")]
        public string? Set_number { get; set; }

        [Column("image_data")]
        public string? Image_data { get; set; }

        public override string ToString()
        {
            return string.Concat(Set_number, "\t");
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
