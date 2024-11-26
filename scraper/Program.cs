using Microsoft.Extensions.Configuration;

public class Program
{
    public static readonly string SUPABASE_URL;
    public static readonly string SUPABASE_API_KEY;

    static Program()
    {
        IConfigurationRoot config = new ConfigurationBuilder()
           .AddUserSecrets<Program>()
           .Build();

        SUPABASE_API_KEY = config["SUPABASE_API_KEY"]!;
        SUPABASE_URL = config["SUPABASE_URL"]!;
    }
}
