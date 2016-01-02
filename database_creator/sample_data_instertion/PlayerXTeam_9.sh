#!/bin/bash

DATABASE='cricRecords'
USERNAME='****'
PASSWORD='toor'
TABLE='PlayerXTeam'

# data for player-team pivot table
# gives information about the relation between player
# and the team(s) they played/playing

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (player, team, joindate)
VALUES
    (1, 1, NULL),
    (2, 1, NULL),
    (3, 1, NULL),
    (4, 1, NULL),
    (5, 1, NULL),
    (6, 1, NULL),
    (7, 1, NULL),
    (8, 1, NULL),
    (8, 1, NULL),
    (10, 1, NULL),
    (11, 1, NULL),
    (12, 1, NULL),
    (13, 1, NULL),
    (14, 1, NULL),
    (15, 19, NULL),
    (16, 19, NULL),
    (17, 19, NULL),
    (18, 19, NULL),
    (19, 19, NULL),
    (20, 19, NULL),
    (21, 19, NULL),
    (22, 19, NULL),
    (23, 19, NULL),
    (24, 19, NULL),
    (25, 19, NULL),
    (26, 19, NULL),
    (27, 19, NULL),
    (28, 2, NULL),
    (28, 12, NULL);
"
