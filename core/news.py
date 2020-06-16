# -*- coding: utf-8 -*-
# module news
# ReadingTime ; URL
# pip install newsapi-python


import requests
import sys
from pprint import pprint
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="your_everyday_sunshine"
)

mycursor = mydb.cursor()

sql = "INSERT INTO news (Summary) VALUES (%s)"



country = sys.argv[1]
api_adress = 'http://newsapi.org/v2/top-headlines?country={}&apiKey=611b5266a5ee4d539ace29be666449ad'.format(country) 

r = requests.get(api_adress)
data = r.json() 
#pprint(data)
url = data['articles']

for article in url:
    print(article['title'])

stringVal = data['articles'][12]['title']
val = (stringVal)
mycursor.execute(sql, (val,))

mydb.commit()