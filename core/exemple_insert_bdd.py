import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="appname"
)

mycursor = mydb.cursor()

sql = "INSERT INTO tvprogram (Title, Synopsis, Begin, End) VALUES (%s, %s, %s, %s)"
val = ("John", "Highway 21", "21h", "22h")
mycursor.execute(sql, val)

mydb.commit()
