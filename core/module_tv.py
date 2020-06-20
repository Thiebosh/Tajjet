# -*- coding: utf-8 -*-

import feedparser
from datetime import date
import mysql.connector
import json

with open('config.json') as json_file:
    data = json.load(json_file)
  
mydb = mysql.connector.connect(
    host="localhost",
    user=data['DB']['connexion']['username'],
    password=data['DB']['connexion']['password'],
    database=data['DB']['setup']['DBname']
)

today = date.today()

if today.day < 10:
    day = "0" + str(today.day)
else:
    day = today.day

if today.month < 10:
    month = "0" + str(today.month)
else:
    month = today.month


tv_feed = feedparser.parse('https://webnext.fr/templates/webnext_exclusive/views/includes/epg_cache/programme-tv-rss_{}-{}-2020.xml'.format(day, month))

if (len(tv_feed.entries) == 0) :
    print(1)
else :
    mycursor = mydb.cursor(buffered=True)

    sql = "DELETE FROM tvprogram"
    mycursor.execute(sql)
    mydb.commit()

    for item in tv_feed.entries:
        title_split = item.title.split("|")        
        
        sql = "SELECT id_channel FROM channel WHERE label=%s"
        adr = (title_split[0], )
        mycursor.execute(sql, adr)

        if(mycursor.rowcount == 0):
            sql = "INSERT INTO channel (label) VALUES (%s)"
            adr = (title_split[0], )
            mycursor.execute(sql, adr)
            mydb.commit()

            sql = "SELECT id_channel FROM channel WHERE label=%s"
            adr = (title_split[0], )
            mycursor.execute(sql, adr)

        myresult = mycursor.fetchall()
        id_channel = myresult[0][0]
        

        sql = "INSERT INTO tvprogram (Title, Synopsis, Begin, Genre, id_channel) VALUES (%s, %s, %s, %s, %s)"
        val = (title_split[2], item.summary, title_split[1], item.tags[0].term, id_channel)
        mycursor.execute(sql, val)

        mydb.commit()
    
    print('0')

print('0')