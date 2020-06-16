# module news
# ReadingTime ; URL
# pip install newsapi-python
# -*- coding: latin1 -*-

import requests
import sys
from pprint import pprint


import requests
from pprint import pprint

country = sys.argv[1]
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 
res = requests.get(api_adress)
data = res.json()


for i in range(10):
    description = data['articles'][i]['description'] + "<br>\n"
    link = data['articles'][i]['url'] + "<br>\n"
    print(description, link,)

#pprint(data)

