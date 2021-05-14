# -*- coding: utf-8 -*-
import csv
import json

csv_file = 'test.csv'

num_lines = len(open(csv_file).readlines())
print(num_lines)

f = open(csv_file, 'r')
reader = csv.reader(f)
header = next(reader)

ids = 0
str = '{"questions": ['

for row in reader:
    ids += 1
    str = str + '{'
    str = str + '"id":{0},'.format(ids)
    str = str + '"q":"{0}",'.format(row[0])
    str = str + '"answers":[{"choices":['
    str = str + '"{0}","{1}","{2}"],"ans":3'.format(row[1], row[2], row[3])
    str = str + '}]}'

    if ids < num_lines - 1:
        str = str + ','
    else:
        str = str + ']}'

print(str)

json_str = json.loads(str)
format_json = json.dumps(json_str, ensure_ascii=False, indent=2, separators=(',', ': '))
print(format_json)
jsonfile = open('test.json', 'w', encoding="utf-8")
jsonfile.write(format_json)
# jsonfile.write(json_str)

f.close()


