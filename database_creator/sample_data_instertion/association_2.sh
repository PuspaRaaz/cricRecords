#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'
TABLE='Association'

# data for association table
# gives information about cricket associations/boards (national or domestic)

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (ID, name, country)
VALUES
    (NULL, 'Cricket Association of Nepal', 'Nepal'),
    (NULL, 'Board of Control for Cricket in India', 'India'),
    (NULL, 'South Africa Cricket', 'South Africa'),
    (NULL, 'New Zealand Cricket', 'New Zealand'),
    (NULL, 'Sri Lanka Cricket', 'Sri Lanka'),
    (NULL, 'Pakistan Cricket Board', 'Pakistan'),
    (NULL, 'England Cricket Board', 'England'),
    (NULL, 'Cricket Australia', 'Australia'),
    (NULL, 'West Indies Cricket Board', 'West Indies'),
    (NULL, 'Bangladesh Cricket Board', 'Bangladesh'),
    (NULL, 'Zimbwabwe Cricket Association', 'Zimbwabwe'),
    (NULL, 'Tamil Nadu Cricket Association', 'India'),
    (NULL, 'Jharkhand State Cricket Association', 'India'),
    (NULL, 'Nepal Police', 'Nepal'),
    (NULL, 'Nepal Army', 'Nepal'),
    (NULL, 'Armed Police Force', 'Nepal'),
    (NULL, 'Mumbai Cricket Association', 'India'),
    (NULL, 'Jannu and Kashmir Cricket Association', 'India'),
    (NULL, 'Karnataka State Cricket Association', 'India'),
    (NULL, 'Hariyana Cricket Association', 'India'),
    (NULL, 'Himanchal Pradesh Cricket Association', 'India'),
    (NULL, 'Delhi District Cricket Association', 'India'),
    (NULL, 'The Cricket Association of Bengal', 'India'),
    (NULL, 'Rawalpindi Cricket Association', 'Pakistan'),
    (NULL, 'Colombo Cricket Association', 'Sri Lanka'),
    (NULL, 'Merylebone Cricket Club', 'England'),
    (NULL, 'Nottinghamshire County Cricket Club', 'England'),
    (NULL, 'Yorkshire County Cricket Club', 'England'),
    (NULL, 'Western Australia Cricket Association', 'Australia'),
    (NULL, 'New South Wales Cricket Association', 'Australia'),
    (NULL, 'Victoria Cricket Association', 'Australia'),
    (NULL, 'Queensland Cricket Association', 'Australia'),
    (NULL, 'Namibia Cricket', 'Namibia'),
    (NULL, 'Kenya Cricket Board', 'Kenya'),
    (NULL, 'Cricket Scotland', 'Scotland'),
    (NULL, 'Hongkong Cricket Association', 'Hongkong'),
    (NULL, 'Netherlands Cricket', 'Netherlands'),
    (NULL, 'Papua New Guinea Cricket Association', 'Papua New Guinea'),
    (NULL, 'United Arab Emirates Cricket Association', 'United Arab Emirates');
"
