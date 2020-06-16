#module sport
#label, picture, calories

import csv, sys
adressname = 'C:\wamp64\www\Tajjet\core\sport.csv'
cols_to_remove = [1, 2, 6, 7] # Column indexes to be removed (starts at 0)


with open(adressname) as f:
    
    reader = csv.reader(f)
    
    try:
        for row in reader:
            del row[cols_to_remove]
            print(row)
    except csv.Error as e:
        sys.exit('file {}, line {}: {}'.format(adressname, reader.line_num, e))
        



# cols_to_remove = sorted(cols_to_remove, reverse=True) # Reverse so we remove from the end first
# row_count = 0 # Current amount of rows processed

# with open(input_file, "r") as source:
#     reader = csv.reader(source)
#     with open(output_file, "w", newline='') as result:
#         writer = csv.writer(result)
#         for row in reader:
#             row_count += 1
#             print('\r{0}'.format(row_count), end='') # Print rows processed
#             for col_index in cols_to_remove:
#                 del row[col_index]
#             writer.writerow(row)