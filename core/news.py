# -*- coding: utf-8 -*-
# module news

# pip install newsapi-python

import requests
import sys
from pprint import pprint

#On récupère les articles par code pays
country = sys.argv[1] #il faut mettre l'argument dans router.php ligne 28
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 
res = requests.get(api_adress)
data = res.json()

#boucle permettant d'afficher les descriptions et liens des 10 premiers articles donnés via l'API
for i in range(10):
    description = data['articles'][i]['description'] + "<br>\n"
    link = data['articles'][i]['url'] + "<br>\n"
    print(description, link,)

#pprint(data) # affiche toutes les news

