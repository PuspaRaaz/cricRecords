#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'
TABLE='PlayerXMatch'

# data for player-match pivot table
# gives information about player and matches they are playing

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (matchID, player, team)
VALUES
    (7, 1, 1),
    (7, 10, 1),
    (7, 11, 1),
    (7, 15, 19),
    (7, 16, 19),
    (7, 17, 19),
    (7, 18, 19),
    (7, 19, 19),
    (7, 2, 1),
    (7, 20, 19),
    (7, 21, 19),
    (7, 22, 19),
    (7, 23, 19),
    (7, 24, 19),
    (7, 25, 19),
    (7, 3, 1),
    (7, 4, 1),
    (7, 5, 1),
    (7, 6, 1),
    (7, 7, 1),
    (7, 8, 1),
    (7, 9, 1),
    (8, 1, 1),
    (8, 10, 1),
    (8, 11, 1),
    (8, 15, 19),
    (8, 16, 19),
    (8, 17, 19),
    (8, 18, 19),
    (8, 19, 19),
    (8, 2, 1),
    (8, 20, 19),
    (8, 21, 19),
    (8, 22, 19),
    (8, 23, 19),
    (8, 24, 19),
    (8, 25, 19),
    (8, 3, 1),
    (8, 4, 1),
    (8, 5, 1),
    (8, 6, 1),
    (8, 7, 1),
    (8, 8, 1),
    (8, 9, 1);
"
