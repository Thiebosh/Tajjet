# -*- coding: utf-8 -*-
# module news

# installation nécessaire : pip install newsapi-python


import requests
import sys
from pprint import pprint
import random
import mysql.connector
import json


#config BDD

with open('config.json') as json_file:
    data = json.load(json_file)
    
mydb = mysql.connector.connect(
  host="localhost",
  user=data['DB']['connexion']['username'],
  password=data['DB']['connexion']['password'],
  database=data['DB']['setup']['DBname']
)


#On récupère les articles par code pays

country_code = sys.argv[1] #il faut mettre l'argument dans router.php ligne 28
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country_code) 
res = requests.get(api_adress)
data = res.json()

#boucle permettant d'afficher les descriptions et liens des 10 premiers articles donnés via l'API
for i in range(len(data['articles'])):
    Summary = data['articles'][i]['description'] + "<br>"
    url = data['articles'][i]['url'] + "<br>"
    reading = data['articles'][i]['content']
    #print(Summary, url, reading)
    print(reading)

    readingTime = len(reading)/450
    print(readingTime)
    
    if reading != None:
          
# Injection en BDD

        mycursor = mydb.cursor(buffered=True)

        sql = "INSERT INTO article (Summary, url, readingTime) VALUES (%s, %s, %s)"
        val = (Summary, url, readingTime)
        mycursor.execute(sql, val)

        mydb.commit()
        

#pprint(data) # affiche toutes les news

