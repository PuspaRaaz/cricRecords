#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'

# functions are defined here
# used as alternatives for the sub-queries with-in views
# because they are not allowed with-in FROM clauses
# during views creation

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"

-- returns number of boundries hit by-a-batsman or for-a-bowler
-- in an innings as per the arguments supplied
-- ARGUMENTS DESCRIPTION --
-- player: the batsman or bowler of which count are requested
-- role: 1 for batsman and any other integer for bowler
-- over: to identify the innings of which boundries count is requested
-- run: boundary runs whose count is requested

DROP FUNCTION IF EXISTS boundaryCount;
DELIMITER $$
CREATE FUNCTION boundaryCount(player INT, role INT, over INT, run INT)
RETURNS INT
BEGIN
IF (role = 1) THEN
SET @count = (SELECT count(*) FROM Ball b
    WHERE runs=run AND isBoundary=1 AND batsman=player
    AND b.over IN (SELECT ID FROM Over WHERE innings = (
        SELECT innings FROM Over WHERE Over.ID = over))
    GROUP BY batsman);
ELSE
SET @count = (SELECT count(*) FROM Ball b
    WHERE runs=run AND isBoundary=1 AND bowler=player
    AND b.over IN (SELECT ID FROM Over WHERE innings = (
        SELECT innings FROM Over WHERE Over.ID = over))
    GROUP BY bowler);
END IF;

IF (@count IS NULL) THEN
RETURN 0;
ELSE 
RETURN @count;
END IF;
END
$$
DELIMITER ;


-- returns number of balls involved by a player in an innings
-- balls faced for a batsman
-- balls bowled by a bowler
-- ARGUMENTS DESCRIPTION --
-- player: batsman/bowler whose count is requested
-- role: 1 for batsman and any other integer for bowler
-- over: to identify the innings of which boundries count is requested

DROP FUNCTION IF EXISTS ballsinvolved;
DELIMITER $$
CREATE FUNCTION ballsinvolved(player INT, role INT, over INT)
RETURNS INT
BEGIN
IF (role = 1) THEN
RETURN (
    SELECT count(*) FROM Ball b
    WHERE (extratype <> 'wd') AND batsman=player
    AND b.over IN (SELECT ID FROM Over WHERE innings = (
        SELECT innings FROM Over WHERE Over.ID = over))
    GROUP BY batsman);
ELSE
RETURN (
    SELECT count(*) FROM Ball b
    WHERE (extratype <> 'wd' AND extratype <> 'nb')
    AND bowler=player AND b.over IN (
        SELECT ID FROM Over WHERE innings = (
            SELECT innings FROM Over WHERE Over.ID = over))
    GROUP BY bowler);
END IF;
END
$$
DELIMITER ;


-- returns number of maiden overs bowled by a bowler in a innings
-- maiden over => over with zero (0) runs conceded by a bowler
--      => excludes leg-bye (lb) and bye (b) runs
-- ARGUMENTS DESCRIPTION --
-- player: bowler whose count is requested
-- inng: innings ID of which maiden count is requested

DROP FUNCTION IF EXISTS maidenscount;
DELIMITER $$
CREATE FUNCTION maidenscount(player INT, inng INT)
RETURNS INT
BEGIN
RETURN (
    SELECT count(*) FROM (
        SELECT * FROM Ball b
        WHERE (extra = 0 OR extratype = 'b' OR extratype = 'lb')
            AND bowler=player AND b.over IN
            (SELECT ID FROM Over WHERE innings = inng)
        GROUP BY b.over
        HAVING sum(runs) = 0 AND count(*) > 5) AS overruns
    );
END
$$
DELIMITER ;


-- returns number of extras bowled by a bowler in a innings
-- extras for a bowler includes only wide (wd) and no-ball (nb)
-- ARGUMENTS DESCRIPTION --
-- player: bowler whose count is requested
-- inng: innings ID of which extra count is requested
-- type: 0 for wide (wd) deliveries and any other integer value
--      for no-ball (nb)

DROP FUNCTION IF EXISTS extracount;
DELIMITER $$
CREATE FUNCTION extracount(player INT, inng INT, type INT)
RETURNS INT
BEGIN
IF (type = 0) THEN
SET @count = (
    SELECT count(*) FROM Ball b
    WHERE extratype = 'wd' AND extra > 0
    AND bowler=player AND b.over IN (
        SELECT ID FROM Over WHERE innings = inng)
    GROUP BY bowler);
ELSE
SET @count = (
    SELECT count(*) FROM Ball b
    WHERE extratype = 'nb' AND extra > 0
    AND bowler=player AND b.over IN (
        SELECT ID FROM Over WHERE innings = inng)
    GROUP BY bowler);
END IF;

IF (@count IS NULL) THEN
RETURN 0;
ELSE
RETURN @count;
END IF;
END
$$
DELIMITER ;


-- returns number innings in which the batsman was out
-- returns number_of_innings - number_of_notouts
-- ARGUMENTS DESCRIPTION --
-- player: bowler whose count is requested
-- format: match-format of which count is requested

DROP FUNCTION IF EXISTS notcareernotout;
DELIMITER $$
CREATE FUNCTION notcareernotout(batman INT, format INT)
RETURNS INT
BEGIN
SET @totalmatches = (
    (SELECT count(*) FROM PlayerXMatch
        WHERE player = batman AND matchID IN
        (SELECT m.ID FROM Matches m
            INNER JOIN Series s ON m.series = s.ID
            WHERE s.format = format)
    ));
SET @totalnotout = (
    SELECT count(isNO) FROM v_battingstat
        WHERE batsman = batman AND isNO > 0);
IF (@totalnotout = @totalmatches) THEN
RETURN 1;
ELSE
RETURN @totalmatches - @totalnotout;
END IF;
END
$$
DELIMITER ;


-- returns if the batsman is not-out or not in the given innings
-- ARGUMENTS DESCRIPTION --
-- player: bowler whose count is requested
-- inng: innings ID of which not-out status is checked

DROP FUNCTION IF EXISTS notoutcheck;
DELIMITER $$
CREATE FUNCTION notoutcheck(player INT, inng INT)
RETURNS INT
BEGIN
SET @isnotout = (
    SELECT count(*) FROM Wicket
    WHERE batsman = player AND innings = inng);
IF (@isnotout = 1) THEN
RETURN 0;
ELSE
RETURN 1;
END IF;
END 
$$
DELIMITER ;
"
