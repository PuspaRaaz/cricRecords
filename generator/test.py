#!/usr/bin/python
import config

database = config.Database()
db = database.database()
cursor = db.cursor()

cursor.execute("SELECT m.ID, t1.name, t2.name, s.format, v.name, v.location, s.name, s.season, date, level, number FROM Matches m LEFT JOIN Team t1 ON t1.ID = team_1 LEFT JOIN Team t2 ON t2.ID = team_2 LEFT JOIN Venue v ON v.ID = venue LEFT JOIN Series s ON s.ID = series")
db.commit()
print "Matches:"
for row in cursor.fetchall():
    for col in row:
        print col, '-->',
    print ''
print "\n"

print "Series:"
cursor.execute("SELECT * FROM Series")
db.commit()
for row in cursor.fetchall():
    for col in row:
        print col, '-->',
    print ''
print "\n"

print "Teams:"
cursor.execute("SELECT ID, name, association FROM Team")
db.commit()
for row in cursor.fetchall():
    for col in row:
        print col, '-->',
    print ''
print "\n"

cursor.close()
db.close()

