# This script does not connect to the rest of the application in any way shape or form
# It is purely to be run to re-setup the database if someone nukes it
# python3 db-setup.py and wait for it to finish it's thing

import requests
import time
from bs4 import BeautifulSoup
from selenium import webdriver
import numpy as np
import os
from supabase import create_client, Client

#region Getting the theme and subtheme names from brickeconomy
url = "https://www.brickeconomy.com/sets"
driver = webdriver.Chrome()
driver.get(url)
time.sleep(3) # Allows time for dynamic content to load
html_content = driver.page_source

soup = BeautifulSoup(html_content, "html.parser")
themeContainers = soup.find_all("div", class_="themewrap")
themeArray = []
subthemeArray = []

for themeContainer in themeContainers:
    theme = themeContainer.find("div", class_="theme")
    themeName = theme.find("a").get_text()
    themeArray.append(themeName)

    subthemes = themeContainer.find_all("div", class_="subtheme")
    for subtheme in subthemes:
        subthemeName = subtheme.find("a").get_text()
        subthemeArray.append(subthemeName)

driver.quit()

themeArray = np.unique(themeArray)
subthemeArray = np.unique(subthemeArray)

url = "https://gnqbghqimmqdfmqhhwun.supabase.co"
key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImducWJnaHFpbW1xZGZtcWhod3VuIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzMDExOTcsImV4cCI6MjA0NTg3NzE5N30.WY-YgpqRsNXbUi-wB3gvF5KmGyMHV2Eybh0YFmRNXMs"
supabase: Client = create_client(url, key)

for theme in themeArray:
    # insert theme
    themeResponse = (
        supabase.table("themes")
        .insert({"theme": theme})
        .execute()
    )
    print(f"Theme inserted with response: {themeResponse}")

# insert default null subtheme
print(f"Subtheme default inserted with respone: {supabase.table("subthemes").insert({"subtheme": None}).execute()}")
for subtheme in subthemeArray:
    # insert subthemes
    subthemeResponse = (
        supabase.table("subthemes")
        .insert({"subtheme": subtheme})
        .execute()
    )
    print(f"Subtheme inserted with response: {subthemeResponse}")
#endregion

#region Adding availability categories
availabilityResponse = supabase.table("availability").insert({"availability": "Retail"}).execute()
print(f"Availability inserted with response: {availabilityResponse}")
availabilityResponse = supabase.table("availability").insert({"availability": "Retired"}).execute()
print(f"Availability inserted with response: {availabilityResponse}")
availabilityResponse = supabase.table("availability").insert({"availability": "Exclusive"}).execute()
print(f"Availability inserted with response: {availabilityResponse}")
#endregion

#region Adding chart names
# Add stuff here
#endregion