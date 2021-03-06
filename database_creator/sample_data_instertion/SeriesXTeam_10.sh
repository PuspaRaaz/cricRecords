#!/bin/bash

DATABASE='cricRecords'
USERNAME='****'
PASSWORD='toor'
TABLE='SeriesXTeam'

# data for series-team pivot table
# gives information about series and teams playing the particular series

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (series, team, rank)
VALUES
    (1, 1, NULL),
    (1, 17, NULL),
    (1, 18, NULL),
    (1, 19, NULL),
    (1, 20, NULL),
    (1, 21, NULL),
    (1, 22, NULL),
    (1, 23, NULL),
    (2, 7, NULL),
    (2, 8, NULL),
    (3, 2, NULL),
    (3, 5, NULL),
    (4, 3, NULL),
    (4, 4, NULL),
    (5, 3, NULL),
    (5, 4, NULL),
    (6, 17, NULL),
    (6, 8, NULL),
    (7, 7, NULL),
    (7, 8, NULL),
    (8, 7, NULL),
    (8, 8, NULL);
"
