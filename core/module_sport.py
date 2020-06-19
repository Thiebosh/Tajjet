#module sport
#pip install pandas

import pandas as pd
import csv, sys
import random
import mysql.connector
import json

adressname = 'core\sport.csv'


#config BDD

with open('config.json') as json_file:
    data = json.load(json_file)
    
  
mydb = mysql.connector.connect(
  host="localhost",
  user=data['DB']['connexion']['username'],
  password=data['DB']['connexion']['password'],
  database=data['DB']['setup']['DBname']
)

df = pd.read_csv(adressname)
df = df.head(87) # affiche le nombre de lignes
df = df.drop(["Equipment","Exercise Type","Notes", "Modifications"], axis=1)

#print(df)
for row in df.iterrows():
      #print(row[1])
      print(row[1][0])
      for i in range(len(row[1])):
            
        label = row[1][i] 
        MajorMuscle = row[1][i]
        MinorMuscle = row[1][i]
        picture = row[1][i]
        #print(row[0])
        # print(label)
        # print(MajorMuscle)
        # print(MinorMuscle)
        # print(picture)
        
        calories = random.randint(100,300)
        
        #mycursor = mydb.cursor(buffered=True)

    
        # #VERIF MAJORMUSCLE
        # sql = "SELECT id_muscle FROM muscle WHERE label=%s"
        # adr = (MajorMuscle, )
        # mycursor.execute(sql, adr)

        # if(mycursor.rowcount == 0):
        #     sql = "INSERT INTO muscle (label) VALUES (%s)"
        #     adr = (MajorMuscle, )
        #     mycursor.execute(sql, adr)
        #     mydb.commit()

        #     sql = "SELECT id_mucle FROM muscle WHERE label=%s"
        #     adr = (MajorMuscle, )
        #     mycursor.execute(sql, adr)

        # myresult = mycursor.fetchall()
        # id_muscle = myresult[0][0]
        
        # sql = "INSERT INTO muscle (MajorMuscle, id_muscle) VALUES (%s, %S)"
        # val = (MajorMuscle, id_muscle)
        # mycursor.execute(sql, val)
        # mydb.commit()
        
        #     #VERIF MINORMUSCLE
        # sql = "SELECT id_muscle FROM muscle WHERE label=%s"
        # adr = (MinorMuscle, )
        # mycursor.execute(sql, adr)

        # if(mycursor.rowcount == 0):
        #     sql = "INSERT INTO muscle (label) VALUES (%s)"
        #     adr = (MinorMuscle, )
        #     mycursor.execute(sql, adr)
        #     mydb.commit()

        #     sql = "SELECT id_mucle FROM muscle WHERE label=%s"
        #     adr = (MajorMuscle, )
        #     mycursor.execute(sql, adr)

        # myresult = mycursor.fetchall()
        # id_muscle = myresult[0][0]
        
        # sql = "INSERT INTO muscle (MinorMuscle, id_muscle) VALUES (%s, %S)"
        # val = (MinorMuscle, id_muscle)
        # mycursor.execute(sql, val)
        # mydb.commit()
        
        

        # sql = "INSERT INTO sport (label, picture, calories) VALUES (%s, %s, %s)"
        # val1 = (label, picture, calories)
        # mycursor.execute(sql, val1)
        # mydb.commit()

#ANCIENNE VERSION --------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
# for i in df.iterrows():
#     label = df[i].Exercise.tolist()
#     MajorMuscle = df[i]["Major Muscle"].unique().tolist()
#     MinorMuscle = df[i]["Minor Muscle"].unique().tolist()
#     gif = df[i].Example.tolist()
#     calories = random.randint(0,300)
#     print(label,"\n",MajorMuscle, "\n", MinorMuscle,"\n",gif,"\n")

#     import mysql.connector
    
#     mydb = mysql.connector.connect(
#       host="localhost",
#       user="root",
#       password="",
#       database="everydaySunshine"
#     )
#     mycursor = mydb.cursor(buffered=True)


#     sql = "INSERT INTO sport (label, gif, calories) VALUES (%s, %s, %s)"
#     val1 = (label, gif, calories)
#     mycursor.execute(sql, val1)

#     mydb.commit()

#     sql = "INSERT INTO muscle (MinorMuscle, MajorMuscle) VALUES (%s, %s)"
#     val = (MinorMuscle, MajorMuscle)
#     mycursor.execute(sql, val)



#     mydb.commit()