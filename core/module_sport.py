#module sport
#pip install pandas

import pandas as pd
import csv, sys
import random
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
mycursor = mydb.cursor(buffered=True)


sql = "DELETE FROM work"
mycursor.execute(sql)
mydb.commit()

sql = "DELETE FROM sport"
mycursor.execute(sql)
mydb.commit()

sql = "DELETE FROM muscle"
mycursor.execute(sql)
mydb.commit()
    
adressname = 'core\sport.csv'
df = pd.read_csv(adressname)
df = df.drop(["Equipment","Exercise Type","Notes", "Modifications"], axis=1)


def insertMuscle(muscle):
    sql = "SELECT id_muscle FROM muscle WHERE label=%s"
    adr = (muscle, )
    mycursor.execute(sql, adr)
    
    if(mycursor.rowcount == 0):
        sql = "INSERT INTO muscle (label) VALUES (%s)"
        adr = (muscle, )
        mycursor.execute(sql, adr)
        mydb.commit()

        sql = "SELECT id_muscle FROM muscle WHERE label=%s"
        adr = (muscle, )
        mycursor.execute(sql, adr)

    myresult = mycursor.fetchall()
    id_muscle = myresult[0][0]

    sql = "INSERT INTO work (id_muscle, id_sport) VALUES (%s, %s)"
    adr = (id_muscle, id_sport)
    mycursor.execute(sql, adr)
    mydb.commit()

for row in df.iterrows():
    exercice = row[1][0]
    picture = row[1][3].split("(")[1][:-1]
    calories = random.randrange(250, 450, 1)

    sql = "INSERT INTO sport (label, picture, calories) VALUES (%s, %s, %s)"
    adr = (exercice, picture, calories)
    mycursor.execute(sql, adr)
    mydb.commit()

    sql = "SELECT id_sport FROM sport WHERE label=%s"
    adr = (exercice, )
    mycursor.execute(sql, adr)
    myresult = mycursor.fetchall()
    id_sport = myresult[0][0]

    for i in range(1, 3):
        if(row[1][i] == row[1][i]):
            if row[1][i].find(",") != -1:
                splitMuscle = row[1][i].split(",")
                for j in range(len(splitMuscle)):
                    muscle = splitMuscle[j]
                    insertMuscle(muscle)
            else:
                muscle = row[1][i]
                insertMuscle(muscle)

print("0")
