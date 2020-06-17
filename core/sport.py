#module sport
#pip install pandas


import pandas as pd
import csv, sys
adressname = 'core\sport.csv'
import random

df = pd.read_csv(adressname)
df = df.head(30) # affiche le nombre de lignes
df = df.drop(["Equipment","Exercise Type","Notes", "Modifications"], axis=1)

for i in len(df):
    label = df[i].Exercise.tolist()
    MajorMuscle = df[i]["Major Muscle"].unique().tolist()
    MinorMuscle = df[i]["Minor Muscle"].unique().tolist()
    gif = df[i].Example.tolist()
    calories = random.randint(0,300)
    print(label,"\n",MajorMuscle, "\n", MinorMuscle,"\n",gif,"\n")

    import mysql.connector
    
    mydb = mysql.connector.connect(
      host="localhost",
      user="root",
      password="",
      database="everydaySunshine"
    )
    mycursor = mydb.cursor(buffered=True)


    sql = "INSERT INTO sport (label, gif, calories) VALUES (%s, %s, %s)"
    val1 = (label, gif, calories)
    mycursor.execute(sql, val1)

    mydb.commit()

    sql = "INSERT INTO muscle (MinorMuscle, MajorMuscle) VALUES (%s, %s)"
    val = (MinorMuscle, MajorMuscle)
    mycursor.execute(sql, val)



    mydb.commit()