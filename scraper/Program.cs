using Microsoft.Extensions.Configuration;
using Microsoft.IdentityModel.Tokens;

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
}
