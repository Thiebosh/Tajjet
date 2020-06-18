# -*- coding: utf-8 -*-
# module news

# pip install newsapi-python

import requests
import sys
from pprint import pprint
import random


#On récupère les articles par code pays
country = sys.argv[1] #il faut mettre l'argument dans router.php ligne 28
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 
res = requests.get(api_adress)
data = res.json()

#boucle permettant d'afficher les descriptions et liens des 10 premiers articles donnés via l'API
for i in range(10):
    Summary = data['articles'][i]['description'] + "<br>\n"
    url = data['articles'][i]['url'] + "<br>\n"
    print(Summary, url)
    
readingTime = random.randint(0,15)
import mysql.connector
 
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="everydaySunshine"
)

mycursor = mydb.cursor(buffered=True)




if(mycursor.rowcount == 0):
    sql = "INSERT INTO article (id_news) VALUES (%s)"
    adr = (id_news, )
    mycursor.execute(sql, adr)
    mydb.commit()

    sql = "SELECT id_news FROM news WHERE id_news=%s"
    adr = (id_news, )
    mycursor.execute(sql, adr)

myresult = mycursor.fetchall()
id_news = myresult[0][0]

    
sql = "INSERT INTO news (Summary) VALUES (%s)"
val = (Summary)
mycursor.execute(sql, val)

sql = "INSERT INTO article (url, readingTime) VALUES (%s, %s, %s)"
val = (url, readingTime)
mycursor.execute(sql, val)

mydb.commit()

#pprint(data) # affiche toutes les news

