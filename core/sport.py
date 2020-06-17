#module sport
#pip install pandas


import pandas as pd
import csv, sys
adressname = 'core\sport.csv'

import pandas as pd
df = pd.read_csv(adressname)
df = df.head(87)
df = df.drop(["Equipment","Exercise Type","Notes", "Modifications"], axis=1)


exercices = df.Exercise.tolist()
MajorMuscle = df["Major Muscle"].unique().tolist()
MinorMuscle = df["Minor Muscle"].unique().tolist()
gif = df.Example.tolist()
print(exercices,"\n",MajorMuscle, "\n", MinorMuscle,"\n",gif,"\n")