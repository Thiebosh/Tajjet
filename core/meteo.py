#module météo
#-----------------------------------------------------------------------------------------------------------------------------------------
#pip3 install requests
#pip3 install pprint

import requests
import sys
from pprint import pprint


print(sys.argv)
city = sys.argv[1]

api_adress = 'http://api.openweathermap.org/data/2.5/forecast?q={}&appid=8fa6ea3b512c5310e229b0a2aba21bc6&units=metric'.format(city)
res = requests.get(api_adress)
data = res.json() 
#pprint(data) #affichage de toutes les données sur chaque cycle

# ANCIENNE VERSION 
# weather = data['list'][0]['main']
# print(weather)

Forecast = data['list'][0]['dt_txt']

print(Forecast)
year = ""
for i in range(0,4):
  year += Forecast[i]
print(year)
month = ""
for i in range(5, 7):
  month += Forecast[i]
print(month)


Sky = data['list'][0]['weather'][0]['main']
MinTemp = data['list'][0]['main']['temp_min']
MaxTemp = data['list'][0]['main']['temp_max']
FeltTemp = data['list'][0]['main']['feels_like']
Humidity = data['list'][0]['main']['humidity']
Pressure = data['list'][0]['main']['pressure']

print(Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure)

#--------------------------------------------------------------------------------------------------------------------------------------------------------------
# Import vers BDD
import mysql.connector
 
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="everydaySunshine"
)
 
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

