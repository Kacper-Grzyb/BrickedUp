# Installation

1. If not present install powershell [link](https://learn.microsoft.com/en-us/powershell/scripting/install/installing-powershell?view=powershell-7.4)
2. Install required browsers to run playwright

`pwsh bin/Debug/net8.0/playwright.ps1 install`

## Set up api keys

I wanted to experiment with proper secure managment of api keys during development. 
This repository is currently a public repository so it is even of bigger importance.

**Set Up**

- Get your api key and url from supabase
    - If you're lost on how to get them, go to supabase, `cmd/ctrl + k` and search both for "url" and "api key"
- Run `dotnet restore` to get all dependencies

(maybe need to run `dotnet user-secrets init`)

`dotnet user-secrets set "SUPABASE_URL" "<ur supabase url>"`

`dotnet user-secrets set "SUPABASE_API_KEY" "<ur api key>"`

- Now the secrets are safely stored and can be accessed statically on the Program class

# How to run

The program accepts one argument

- `--prices` Which will scrape and calculate the price for all sets in the db
- `--images` Which will scrape one image for every set in the db 

**CAUTION**: Because of scraping limitations, one cannot run the images headlessly, it can only be run if chroium can render on a screen