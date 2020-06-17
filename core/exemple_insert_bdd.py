import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="appname"
)

mycursor = mydb.cursor()

sql = "INSERT INTO tvprogram (Title, Synopsis, Begin, End) VALUES (%s, %s, %s, %s)"
val = ("Titre du programme tv", "Synopsis du programme tv", "Heure début", "Heure fin")
mycursor.execute(sql, val)

mydb.commit()
