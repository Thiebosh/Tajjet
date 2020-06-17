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

Forecast = data['list'][0]['weather'][0]['main']
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
 
mycursor = mydb.cursor()
 
sql = "INSERT INTO weather (Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure) VALUES (%s, %s, %s, %s, %s, %s)"
val = (Forecast, MinTemp, MaxTemp, FeltTemp, Humidity, Pressure)
mycursor.execute(sql, val)
 
mydb.commit()


