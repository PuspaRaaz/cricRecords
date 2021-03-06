#!/bin/bash

DATABASE='cricRecords'
USERNAME='****'
PASSWORD='toor'
TABLE='SeriesXVenue'

# data for series-venue pivot table
# gives information about series and venues hosting matches of
# the particular series

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (series, venue)
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (2, 19),
    (2, 20),
    (2, 21),
    (2, 22),
    (3, 15),
    (3, 16),
    (3, 17),
    (3, 18),
    (4, 23),
    (4, 24),
    (4, 25),
    (5, 23),
    (5, 24),
    (5, 25),
    (6, 19),
    (6, 20),
    (6, 21),
    (6, 22),
    (7, 19),
    (7, 20),
    (7, 21),
    (7, 22),
    (8, 19),
    (8, 20),
    (8, 21),
    (8, 22);
"
