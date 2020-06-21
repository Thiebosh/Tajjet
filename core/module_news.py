# -*- coding: utf-8 -*-
# module news

# pip install newsapi-python

import requests
import sys
import mysql.connector
import json
import math

with open('config.json') as json_file:
    data = json.load(json_file)
  
mydb = mysql.connector.connect(
    host="localhost",
    user=data['DB']['connexion']['username'],
    password=data['DB']['connexion']['password'],
    database=data['DB']['setup']['DBname']
)


#On récupère les articles par code pays
country = sys.argv[1] #il faut mettre l'argument dans router.php ligne 28
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 
res = requests.get(api_adress)
data = res.json()
mycursor = mydb.cursor(buffered=True)

sql = "DELETE FROM article WHERE Pays = %s"
val = (country, )
mycursor.execute(sql, val)
mydb.commit()

if(len(data['articles']) >= 20):
    #boucle permettant d'afficher les descriptions et liens des 10 premiers articles donnés via l'API
    for i in range(20):
        if (data['articles'][i]['description'] is not None) :
            if(len(data['articles'][i]['description']) > 0) :
                summary = data['articles'][i]['description']
                title = data['articles'][i]['title']
                url = data['articles'][i]['url']
                content = data['articles'][i]['content']
                totalChars = ""
            
                error = False
            
                try:
                    print(data['articles'][i]['content'])
                except UnicodeEncodeError:
                    error = True

                if(not error):
                    if (data['articles'][i]['content'] is not None) :
                        for j in range(data['articles'][i]['content'].find("[+") + 2, data['articles'][i]['content'].find(' chars]')):
                            totalChars += data['articles'][i]['content'][j]
                    else:
                        totalChars = "0"

                    if(len(totalChars) == 1):
                        readingTime = 0.0
                    else:
                        readingTime = int(totalChars)/1750

                    print(readingTime)

                    splitReadingTime = str(readingTime).split('.')
                    minute = splitReadingTime[0]

                    if(splitReadingTime[1][0] != "0"):
                        seconde = 60/(10/int(splitReadingTime[1][0]))
                    else:
                        seconde = "00"
                    
                    minute = int(minute)
                    seconde = int(seconde)

                    if(len(str(math.floor(int(minute)))) < 2):
                        minute = "0" + str(minute)
                    
                    if(len(str(math.floor(int(seconde)))) < 2):
                        seconde = "0" + str(seconde)


                    readingTime = "00:" + str(minute) + ":" + str(seconde)
                
                    sql = "INSERT INTO article (Summary, Titre, url, Pays, readingTime) VALUES (%s, %s, %s, %s, %s)"
                    val = (summary, title, url, country, readingTime)
                    mycursor.execute(sql, val)

                    mydb.commit()
print('0')

#pprint(data) # affiche toutes les news

