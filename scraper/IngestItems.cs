using Supabase.Postgrest.Attributes;
using Supabase.Postgrest.Models;

namespace scraper_webtech;

public class IngestItems
{
    Supabase.Client supabase;
    private readonly string url = "";
    private readonly string key = "";

    public IngestItems()
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
    public async Task<List<string?>> GetSetNumbers()
    {
        var resultSets = await supabase.From<Sets>().Get();
        var sets = resultSets.Models;

        return sets.Select(set => set.Set_number).ToList();
    }

    public static async Task Main()
    {
        IngestItems ingestItems = new();

        var result = await ingestItems.supabase.From<Sets>().Get();
        var hehe = result.Models;

        foreach (var item in hehe)
        {
            Console.WriteLine(item);
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
