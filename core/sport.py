#module sport
#label, picture, calories

import csv, sys
adressname = 'C:\wamp64\www\Tajjet\Data-recovery\sport.csv'


with open(adressname) as f:
    
    reader = csv.reader(f)

    try:
        for row in reader:
            print(row)
    except csv.Error as e:
        sys.exit('file {}, line {}: {}'.format(adressname, reader.line_num, e))