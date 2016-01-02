#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'
TABLE='Format'

# data for association table
# gives information about cricket associations/boards (national or domestic)

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (ID, format, overs, innings, days)
VALUES
    (NULL, 'First-Class', NULL, 4, 5),
    (NULL, 'Limited-Overs', NULL, 2, 1),
    (NULL, 'List A', 50, 2, 1),
    (NULL, 'ODI', 50, 2, 1),
    (NULL, 'Other-Matches', NULL, 4, NULL),
    (NULL, 'Other-T20', 20, 2, 1),
    (NULL, 'T20', 20, 2, 1),
    (NULL, 'T20I', 20, 2, 1),
    (NULL, 'Test', NULL, 4, 5);
"
