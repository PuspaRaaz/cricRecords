#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'

#create the dababase from scratch
mysql -u $USERNAME -p$PASSWORD -e \
"DROP DATABASE IF EXISTS $DATABASE;
CREATE DATABASE $DATABASE;
USE $DATABASE;


-- #FORMAT - holds information about different match-formats

CREATE TABLE Format (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    format enum('Test','ODI','T20I','First-Class','List A','T20',
        'Other-Matches', 'Limited-Overs','Other-T20'),
    overs int(3) DEFAULT '0',
    innings int(1) DEFAULT '2',
    days int(1) DEFAULT '1'
);


-- #Association - holds information about cricketing associations

CREATE TABLE Association (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    country varchar(20) NOT NULL
);


-- #Venue - holds information about stadiums

CREATE TABLE Venue (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    city varchar(50) NOT NULL,
    country varchar(15) NOT NULL,
    association int(3),
    capacity int(6) DEFAULT '0',
    FOREIGN KEY (association) REFERENCES Association(ID)
);


-- #Team - holds information about every teams

CREATE TABLE Team (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL,
    association int(3),
    FOREIGN KEY (association) REFERENCES Association(ID)
);


-- #Player - holds basic and career information about every player

CREATE TABLE Player (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    sname varchar(20) NOT NULL,
    dob date NULL,
    city varchar(50),
    country varchar(20),
    batting enum('rhb','lhb'),
    bowling varchar(20)
);


-- #Series - holds information about every single series/tournaments

CREATE TABLE Series (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    format int(2) NOT NULL,
    season varchar(7) NOT NULL,
    type enum('bilateral','tri-series','domestic','international'),
    MoS int(4),
    FOREIGN KEY (format) REFERENCES Format(ID),
    FOREIGN KEY (MoS) REFERENCES Player(ID),
    UNIQUE(name, format, season)
);


-- #Match - holds information about each and every match

CREATE TABLE Matches (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    team_1 int(4) NOT NULL,
    team_2 int(4) NOT NULL,
    series int(3) NOT NULL,
    number int(2) NOT NULL,
    date timestamp NULL,
    venue int(3) NOT NULL,
    level varchar(15),
    toss int(4),
    winner int(3),
    MoM int(4),
    result text,
    FOREIGN KEY (team_1) REFERENCES Team(ID),
    FOREIGN KEY (team_2) REFERENCES Team(ID),
    FOREIGN KEY (venue) REFERENCES Venue(ID),
    FOREIGN KEY (series) REFERENCES Series(ID),
    FOREIGN KEY (toss) REFERENCES Team(ID),
    FOREIGN KEY (winner) REFERENCES Team(ID),
    FOREIGN KEY (MoM) REFERENCES Player(ID),
    UNIQUE(series, number)
);


-- #Inning - holds information about single innings

CREATE TABLE Innings (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    matchID int(4) NOT NULL,
    number enum('1','2','3','4'),
    batting int(4) NOT NULL,
    bowling int(4) NOT NULL,
    FOREIGN KEY (matchID) REFERENCES Matches(ID),
    FOREIGN KEY (batting) REFERENCES Team(ID),
    FOREIGN KEY (bowling) REFERENCES Team(ID),
    UNIQUE(number, matchID)
);


-- #Over - holds information about an over

CREATE TABLE Over (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    innings int(4) NOT NULL,
    number int(3) NOT NULL,
    day enum('1','2','3','4','5'),
    session enum('1','2','3'),
    powerplay enum('mandatory','bowling','batting'),
    FOREIGN KEY (innings) REFERENCES Innings(ID),
    UNIQUE(innings, number)
);


-- #Wicket - stores information about every wickets fallen

CREATE TABLE Wicket (
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    innings int(5) NOT NULL,
    batsman int(5) NOT NULL,
    bowler int(5),
    fielder int(4),
    falltype enum('b','ct','hitWicket','lbw','st',
        'timedOut','runout','obstruction','handledTheBall',
        'hitBallTwice','retiredOut'),
    fowruns int(3) NOT NULL,
    fowwicket int(2) NOT NULL,
    FOREIGN KEY (innings) REFERENCES Innings(ID),
    FOREIGN KEY (batsman) REFERENCES Player(ID),
    FOREIGN KEY (bowler) REFERENCES Player(ID),
    FOREIGN KEY (fielder) REFERENCES Player(ID)
);


-- #BallByBall - the basic information from each ball

CREATE TABLE Ball(
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    over int(3) NOT NULL,
    ball enum('1', '2', '3', '4', '5', '6'),
    bowler int(4) NOT NULL,
    batsman int(4) NOT NULL,
    extratype enum('wd','nb','b','lb','nb&b','nb&lb','pen'),
    extra int(2) DEFAULT '0',
    runs int(2) DEFAULT '0' NOT NULL,
    isBoundary boolean DEFAULT '0' NOT NULL,
    wicket int(6),
    comment text,
    FOREIGN KEY (over) REFERENCES Over(ID),
    FOREIGN KEY (bowler) REFERENCES Player(ID),
    FOREIGN KEY (batsman) REFERENCES Player(ID),
    FOREIGN KEY (wicket) REFERENCES Wicket(ID),
    UNIQUE(wicket)
);


-- #PlayerXMatch - player & match (many-to-many) relationship


CREATE TABLE PlayerXMatch (
    player int(4) NOT NULL,
    matchID int(4) NOT NULL,
    team int(4) NOT NULL,
    isCaptain boolean DEFAULT '0',
    isWicketkeeper boolean DEFAULT '0',
    isSubs boolean DEFAULT '0',
    isDebut boolean DEFAULT '0',
    FOREIGN KEY (player) REFERENCES Player(ID),
    FOREIGN KEY (matchID) REFERENCES Matches(ID),
    FOREIGN KEY (team) REFERENCES Team(ID),
    UNIQUE(player, matchID)
);


-- #PlayerXTeam - player & team (many-to-many) relationship

CREATE TABLE PlayerXTeam (
    player int(4) NOT NULL,
    team int(4) NOT NULL,
    joindate timestamp NULL,
    leftdate timestamp NULL,
    FOREIGN KEY (team) REFERENCES Team(ID),
    FOREIGN KEY (player) REFERENCES Player(ID),
    UNIQUE (player, team, joindate)
);


-- #SeriesXTeam - series & team (many-to-many) relationship

CREATE TABLE SeriesXTeam (
    series int(4) NOT NULL,
    team int(4) NOT NULL,
    rank int(2),
    FOREIGN KEY (series) REFERENCES Series(ID),
    FOREIGN KEY (team) REFERENCES Team(ID),
    UNIQUE(series, team)
);


-- #SeriesXVenue - series & venue (many-to-many) relationship

CREATE TABLE SeriesXVenue (
    series int(4) NOT NULL,
    venue int(4) NOT NULL,
    FOREIGN KEY (series) REFERENCES Series(ID),
    FOREIGN KEY (venue) REFERENCES Venue(ID),
    UNIQUE(series, venue)
);

CREATE TABLE BallUpdateAudit (
    ID int AUTO_INCREMENT PRIMARY KEY,
    ballID int,
    over int(3) NOT NULL,
    ball enum('1', '2', '3', '4', '5', '6'),
    bowler int(4) NOT NULL,
    batsman int(4) NOT NULL,
    extratype enum('wd','nb','b','lb','nb&b','nb&lb','pen'),
    extra int(2) DEFAULT '0',
    runs int(2) DEFAULT '0' NOT NULL,
    isBoundary boolean DEFAULT '0' NOT NULL,
    wicket int(6),
    comment text,
    changedon datetime DEFAULT NULL,
    action varchar(20)
);

DROP TRIGGER IF EXISTS before_ball_update;
DELIMITER $$
CREATE TRIGGER before_ball_update
BEFORE UPDATE ON Ball
FOR EACH ROW
BEGIN
    INSERT INTO BallUpdateAudit
    SET ballID = OLD.ID,
    over = OLD.over,
    ball = OLD.ball,
    bowler = OLD.bowler,
    batsman = OLD.batsman,
    extratype = OLD.extratype,
    extra = OLD.extra,
    runs = OLD.runs,
    isBoundary = OLD.isBoundary,
    wicket = OLD.wicket,
    comment = OLD.comment,
    changedon = NOW(),
    action = 'update';
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS before_ball_delete;
DELIMITER $$
CREATE TRIGGER before_ball_delete
BEFORE DELETE ON Ball
FOR EACH ROW
BEGIN
    INSERT INTO BallUpdateAudit
    SET ballID = OLD.ID,
    over = OLD.over,
    ball = OLD.ball,
    bowler = OLD.bowler,
    batsman = OLD.batsman,
    extratype = OLD.extratype,
    extra = OLD.extra,
    runs = OLD.runs,
    isBoundary = OLD.isBoundary,
    wicket = OLD.wicket,
    comment = OLD.comment,
    changedon = NOW(),
    action = 'update';
END$$
DELIMITER ;
"

# Create functions
./functions_a.sh

# Build the views
./views_b.sh
