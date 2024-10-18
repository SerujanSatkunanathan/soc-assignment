import requests
import pandas as pd

api_key = "432b061314msh5280ebc6c4ad3f1p1f866ejsnde7f3d13e2e7"

url = "https://wft-geo-db.p.rapidapi.com/v1/geo/countries/NZ/places"

headers = {
    "X-RapidAPI-Key": api_key,
    "X-RapidAPI-Host": "wft-geo-db.p.rapidapi.com"
}

response = requests.get(url, headers=headers)

if response.status_code == 200:
   
    data = response.json()['data']
  
    places_info = []
    for place in data:
        places_info.append({
            'Place ID': place.get('id'),
            'Place Name': place.get('name'),
            'Place Type': place.get('type'),
            'Region Code': place.get('regionCode')
        })
    
    df = pd.DataFrame(places_info)
    print(df)
else:
    print(f"Failed to retrieve data: {response.status_code}, {response.text}")
