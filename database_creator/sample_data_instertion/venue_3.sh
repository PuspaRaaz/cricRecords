#!/bin/bash

DATABASE='cricRecords'
USERNAME='root'
PASSWORD='****'
TABLE='Venue'

# data for venue table
# gives information about cricket stadiums

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (ID, name, city, country, association, capacity)
VALUES
    (NULL, 'Tribhuvan University International Cricket Ground',
        'Kritipur, Kathmandu', 'Nepal', 1, 16000), 
    (NULL , 'Engineering Campus Ground', 'Pulchowk, Lalitpur', 'Nepal',
        1, 10000 ), 
    (NULL , 'Birendra Sainik Maha Vidyalaya Ground', 'Sallaghari, Bhaktapur',
        'Nepal', 1, 5000 ), 
    (NULL , 'MA Chidambaram Stadium', 'Chepauk, Chennai', 'India',
        12, 38000 ), 
    (NULL , 'Wankhede Stadium', 'Mumbai', 'India',
        17, 32000 ), 
    (NULL , 'Sher-i-Kashmir Stadium', 'Srinagar', 'India',
        18, 15000 ), 
    (NULL , 'M.Chinnaswamy Stadium', 'Bengaluru', 'India',
        19, 40000 ), 
    (NULL , 'JSCA International Stadium Complex', 'Ranchi, Jharkhand', 'India',
        13, 25000 ), 
    (NULL , 'Jawaharlal Nehru Stadium', 'New Delhi', 'India',
        20, 32000 ), 
    (NULL , 'Himanchal Pradesh Cricket Association Stadium', 'Dharmasala',
        'India', 21, 22000 ), 
    (NULL , 'Feroz Shah Kotla', 'Delhi', 'India',
        22, 35000 ), 
    (NULL , 'Eden Gardens', 'Kolkata', 'India',
        23, 66000 ),
    (NULL , 'Kingsmead', 'Durban', 'South Africa',
        3, 25000), 
    (NULL, 'Rawalpindi Cricket Stadium', 'Rawalpindi', 'Pakistan',
        24, 15000),
    (NULL, 'Sinhalese Sports Club','Colombo', 'Sri Lanka', 
        25, 10000), 
    (NULL, 'R.Premadasa Stadium','Khettarama, Colombo', 'Sri Lanka',
        25, 35000 ), 
    (NULL, 'Pallekele International Cricket Stadium','Pallekele, Kandy',
        'Sri Lanka', 5, 35000), 
    (NULL, 'Mahinda Rajapaksa International Cricket Stadium','Hambantota',
        'Sri Lanka', 5, 35000),
    (NULL, 'Old Trafford','Stertford, Manchester', 'England', 
        7, 19000), 
    (NULL, 'Lords Cricket Ground','St. Johns Wood Road, London', 'England',
        26, 30000), 
    (NULL, 'Trent Bridge', 'Nottingham', 'England',
        27, 15350), 
    (NULL, 'Headingley Cricket Ground', 'Leeds', 'England',
        28, 17000), 
    (NULL, 'St Georges Park', 'Port Elizabeth', 'South Africa',
        3, 19000), 
    (NULL , 'SuperSports Park', 'Centurion', 'South Africa',
        3, 20000), 
    (NULL, 'Ellis Park', 'Johannesburg', 'South Africa',
        3, 100000), 
    (NULL, 'Westpac Stadium', 'Wellington', 'New Zealand',
        4, 33500), 
    (NULL, 'Seddon Park', 'Hamilton', 'New Zealand',
        4, 10000), 
    (NULL, 'Eden Park', 'Auckland', 'New Zealand',
        4, 41000), 
    (NULL, 'Hagley Oval', 'Christchurch', 'New Zealand',
        4, 18000), 
    (NULL , 'W.A.C.A. Ground', 'East Perth, Western Australia', 'Australia',
        29, 18000 ), 
    (NULL , 'Sydney Cricket Ground', 'Moore Park, Sydney, New South Wales',
        'Australia', 30, 44002), 
    (NULL , 'Melbourne Cricket Ground', 'Jolimont, Melbourne, Victoria',
        'Australia', 31, 90000 ), 
    (NULL , 'Brisbane Cricket Ground', 'Woolloongabba, Brisbane, Queensland',
        'Australia', 32, 37000);
"
