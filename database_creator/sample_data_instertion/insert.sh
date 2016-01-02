#!/bin/bash

# calls insertion queries
# numbers are used to identify the order of table creation
# and data entry to get rid of "FOREIGN KEY constraints error"

# basic insertion
./format_1.sh		# fills format table
./association_2.sh	# fills association table
./venue_3.sh		# fills venue table
./team_4.sh			# fills team table
./player_5.sh		# fills player table
./series_6.sh		# fills series table
./matches_7.sh		# fills matches table

# many-to-many relations
./PlayerXMatch_8.sh
./PlayerXTeam_9.sh
./SeriesXTeam_10.sh
./SeriesXVenue_11.sh