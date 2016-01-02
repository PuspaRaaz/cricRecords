#!/bin/bash

DATABASE='cricRecords'
USERNAME='root'
PASSWORD='****'
TABLE='Matches'

# data for matches table
# gives information about matches (fixtures/results)

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (ID, team_1, team_2, date, venue, series, level, number)
VALUES
    (NULL, 17, 20, '2015-05-15 13:15:00', 1, 1, NULL, 1),
    (NULL, 17, 20, '2015-05-17 13:15:00', 2, 1, NULL, 2),
    (NULL, 21, 22, '2015-06-22 14:45:00', 1, 1, NULL, 3),
    (NULL, 21, 22, '2015-06-24 14:45:00', 2, 1, NULL, 4),
    (NULL, 18, 23, '2015-06-25 15:45:00', 1, 1, NULL, 5),
    (NULL, 18, 23, '2015-06-27 15:45:00', 2, 1, NULL, 6),
    (NULL, 19, 1, '2015-07-29 15:30:00', 1, 1, NULL, 7),
    (NULL, 19, 1, '2015-07-31 15:30:00', 2, 1, NULL, 8),
    (NULL, 21, 19, '2015-09-14 14:45:00', 1, 1, NULL, 9),
    (NULL, 21, 19, '2015-09-16 14:45:00', 2, 1, NULL, 10),
    (NULL, 17, 18, '2015-10-30 13:45:00', 1, 1, NULL, 11),
    (NULL, 17, 18, '2015-11-01 13:45:00', 1, 1, NULL, 12),
    (NULL, 23, 20, '2015-11-16 13:45:00', 1, 1, NULL, 13),
    (NULL, 23, 20, '2015-11-18 13:45:00', 1, 1, NULL, 14),
    (NULL, 1, 22, '2015-11-28 13:45:00', 1, 1, NULL, 15),
    (NULL, 1, 22, '2015-11-30 13:45:00', 1, 1, NULL, 16);
"
