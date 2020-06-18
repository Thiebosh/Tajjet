#module sport
#pip install pandas


import pandas as pd
import csv, sys
adressname = 'core\sport.csv'
import random

df = pd.read_csv(adressname)
df = df.head(87) # affiche le nombre de lignes
df = df.drop(["Equipment","Exercise Type","Notes", "Modifications"], axis=1)

print(df)
for row in df.iterrows():
    label = row[1][0] 
    MajorMuscle = row[1][1]
    MinorMuscle = row[1][2]
    picture = row[1][3]
    print(row[0])
    print(label)
    print(row[1][1])
    print(row[1][2])
    print(row[1][3])
    
    calories = random.randint(100,300)
    
    import mysql.connector
    
    mydb = mysql.connector.connect(
      host="localhost",
      user="root",
      password="",
      database="everydaySunshine"
    )
    mycursor = mydb.cursor(buffered=True)


    sql = "INSERT INTO sport (label, picture, calories) VALUES (%s, %s, %s)"
    val1 = (label, picture, calories)
    mycursor.execute(sql, val1)

    mydb.commit()
    

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