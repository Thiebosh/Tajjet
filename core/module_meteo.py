#module météo
#-----------------------------------------------------------------------------------------------------------------------------------------
#pip3 install requests
#pip3 install pprint

import requests
import sys

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
 
city = ""
for i in range(1, len(sys.argv)):
    city += sys.argv[i] + " "

api_adress = 'http://api.openweathermap.org/data/2.5/forecast?q={}&appid=8fa6ea3b512c5310e229b0a2aba21bc6&units=metric'.format(city)
res = requests.get(api_adress)
data = res.json()         

#pprint(data) #affichage de toutes les données sur chaque cycle
mycursor = mydb.cursor(buffered=True)


sql = "SELECT id_town FROM town WHERE label=%s"
adr = (city, )
mycursor.execute(sql, adr)

if mycursor.rowcount > 0:
    myresult = mycursor.fetchall()
    id_town = myresult[0][0]

    sql = "DELETE FROM weather WHERE id_town = %s"
    adr = (id_town, )
    mycursor.execute(sql, adr)
    
try:
    for j in range(0, len(data['list'])): 
        Forecast = data['list'][j]['dt_txt']      
        label = data['list'][j]['weather'][0]['main']
        Temp = data['list'][j]['main']['temp_max']
        FeltTemp = data['list'][j]['main']['feels_like']
        Humidity = data['list'][j]['main']['humidity']
        Pressure = data['list'][j]['main']['pressure']

        sql = "SELECT id_town FROM town WHERE label=%s"
        adr = (city, )
        mycursor.execute(sql, adr)


        if(mycursor.rowcount == 0):
            sql = "INSERT INTO town (label) VALUES (%s)"
            adr = (city, )
            mycursor.execute(sql, adr)
            mydb.commit()

            sql = "SELECT id_town FROM town WHERE label=%s"
            adr = (city, )
            mycursor.execute(sql, adr)

        myresult = mycursor.fetchall()
        id_town = myresult[0][0]

        #verif sky

        sql = "SELECT id_sky FROM sky WHERE label=%s"
        adr = (label, )
        mycursor.execute(sql, adr)


        if(mycursor.rowcount == 0):
            sql = "INSERT INTO sky (label) VALUES (%s)"
            adr = (label, )
            mycursor.execute(sql, adr)
            mydb.commit()

            sql = "SELECT id_sky FROM sky WHERE label=%s"
            adr = (label, )
            mycursor.execute(sql, adr)

        myresult = mycursor.fetchall()
        id_sky = myresult[0][0]

        sql = "INSERT INTO weather (Forecast, Temp, FeltTemp, Humidity, Pressure, id_sky, id_town) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (Forecast, Temp, FeltTemp, Humidity, Pressure, id_sky, id_town)
        mycursor.execute(sql, val)

        mydb.commit()
    print("0")
except KeyError:
    print("1")