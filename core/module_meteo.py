#module météo
#-----------------------------------------------------------------------------------------------------------------------------------------
#pip3 install requests
#pip3 install pprint

import requests
import sys
from pprint import pprint

import mysql.connector
 
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="everydaySunshine"
)
 
print(sys.argv)
city = sys.argv[1]

api_adress = 'http://api.openweathermap.org/data/2.5/forecast?q={}&appid=8fa6ea3b512c5310e229b0a2aba21bc6&units=metric'.format(city)
res = requests.get(api_adress)
data = res.json()         

#pprint(data) #affichage de toutes les données sur chaque cycle

for i in range(0, len(data['list'])):  

      Forecast = data['list'][i]['dt_txt']
      year = ""
      for i in range(0,4):
        year += Forecast[i]

      month = ""
      for i in range(5, 7):
        month += Forecast[i]

      day = ""
      for i in range(8, 10):
        day += Forecast[i]

      hour = ""
      for i in range(11, 16):
            hour += Forecast[i]

      Forecast = day +"-"+month+"-"+year+ " "+ hour

      label = data['list'][i]['weather'][0]['main']
      MinTemp = data['list'][i]['main']['temp_min']
      MaxTemp = data['list'][i]['main']['temp_max']
      FeltTemp = data['list'][i]['main']['feels_like']
      Humidity = data['list'][i]['main']['humidity']
      Pressure = data['list'][i]['main']['pressure']

      print(Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure)
            
            


      mycursor = mydb.cursor(buffered=True)
      
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
      print(myresult[0][0])

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
      print(myresult[0][0])



      sql = "INSERT INTO weather (Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure, id_sky, id_town) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
      val = (Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure, id_sky, id_town)
      mycursor.execute(sql, val)

      mydb.commit()




