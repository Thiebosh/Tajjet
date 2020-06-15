# module news
# ReadingTime ; URL
# pip install newsapi-python
# -*- coding: latin1 -*-

import requests
import sys
from pprint import pprint


import requests
from pprint import pprint

country = sys.argv[3]
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 
res = requests.get(api_adress)
data = res.json() 

pprint(data)
url = data['articles'][0]['url']

#print(url)

# MinTemp = data['list'][0]['main']['temp_min']
# MaxTemp = data['list'][0]['main']['temp_max']
# FeltTemp = data['list'][0]['main']['feels_like']
# Humidity = data['list'][0]['main']['humidity']
# Pressure = data['list'][0]['main']['pressure']