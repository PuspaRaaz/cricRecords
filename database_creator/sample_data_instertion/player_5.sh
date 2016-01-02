#!/bin/bash

USERNAME='root'
PASSWORD='****'
DATABASE='cricRecords'
TABLE='Player'

# data for player table
# gives basic information about player

mysql -u $USERNAME -p$PASSWORD $DATABASE -e \
"
INSERT INTO $TABLE
    (ID, name, sname, dob, city, country, batting, bowling)
VALUES
    (NULL, 'Paras Khadka', 'P Khadka', '1987-10-24', 'Kathmandu',
        'Nepal', 'rhb', 'right-arm medium fast'),
    (NULL, 'Pradeep Airee', 'P Airee', '1992-09-01', '',
        'Nepal', 'rhb', 'right-arm medium'),
    (NULL, 'Prithu Baskota', 'P Baskota', '1992-07-05', '',
        'Nepal', 'rhb', 'right-arm offbreak'),
    (NULL, 'Mahesh Chhetri', 'M Chhetri', '1988-01-26', '',
        'Nepal', 'rhb', 'wicketkeeper'),
    (NULL, 'Shakti Gauchan', 'S Gauchan', '1984-04-22', 'Rupandehi',
        'Nepal', 'rhb', 'slow left-arm orthodox'),
    (NULL, 'Karan KC', 'Karan KC', '1981-10-10', 'Sigana, Baglung',
        'Nepal', 'rhb', 'right-arm fast'),
    (NULL, 'Avinash Karn', 'A Karn', '1995-02-04', '',
        'Nepal', 'rhb', 'left-arm medium'),
    (NULL, 'Siddhant Lohani', 'S Lohani', '1995-03-02', 'Biratnagar, Morang',
        'Nepal', 'rhb', 'right-arm offbreak'),
    (NULL, 'Rajesh Pulami', 'R Pulami', '1992-08-27', '',
        'Nepal', 'rhb', 'legbreak googly'),
    (NULL, 'Gyanendra Malla', 'G Malla', '1990-09-16', 'Kathmandu, Bagmati',
        'Nepal', 'rhb', ''),
    (NULL, 'Anil Mandal', 'A Mandal', '1991-02-05', 'Janakpur, Dhanusha',
        'Nepal', 'rhb', ''),
    (NULL, 'Basanta Regmi', 'B Regmi', '1986-04-06', 'Bhairahawa',
        'Nepal', 'lhb', 'slow left-arm orthodox'),
    (NULL, 'Sompal Kami', 'S Kami', '1996-02-02', 'Gulmi',
        'Nepal', 'rhb', 'right-arm fast-medium'),
    (NULL, 'Sharad Vesawkar', 'S Vesawkar', '1988-10-06', '',
        'United Arab Emirates', 'rhb', 'right-arm offbreak'),
    (NULL, 'Preston Luke Mommsen', 'PL Mommsen', '1987-10-14', 'Durban, Natal',
        'Scotland', 'rhb', 'right-arm offbreak'),
    (NULL, 'Richie Douglas Berrington', 'RD Berrington', '1987-04-03',
        'Pretoria', 'South Africa', 'rhb', 'right-arm medium-fast'),
    (NULL, 'Kyle James Coetzer', 'KJ Coetzer', '1984-04-14', 'Aberdeen',
        'Scotland', 'rhb', 'right-arm medium-fast'),
    (NULL, 'Matthew Henry Cross', 'MH Cross', '1992-10-15', 'Aberdeen',
        'Scotland', 'rhb', 'wicketkeeper'),
    (NULL, 'Con de Wet de Lange', 'CW de Lange', '1981-02-11',
        'Bellville, Cape Province', 'Scotland', 'rhb', 'slow left-arm orthodox'),
    (NULL, 'Alasdair Campbell Evans', 'AC Evans', '1989-01-12', 'Pembruy, Kent',
        'Scotland', 'rhb', 'right-arm medium-fast'),
    (NULL, 'Hamish John William Gardiner', 'HJW Gardiner', '1991-01-04',
        'Brisbane, Queensland', 'Australia', 'rhb', ''),
    (NULL, 'Michael Alexander Leask', 'MA Leask', '1990-10-29', 'Aberdeen',
        'Scotland', 'rhb', 'right-arm offbreak'),
    (NULL, 'Gavin Thomas Main', 'GT Main', '1995-02-08', 'Lanark',
        'Scotland', 'rhb', 'right-arm fast'),
    (NULL, 'Henry George Munsey', 'HG Munsey', '1993-02-21', 'Oxford',
        'England', 'rhb', 'right-arm medium-fast'),
    (NULL, 'Safyaan Mohammed Sharif', 'SM Sharif', '1991-05-24',
        'Hudderfield, Yorkshire', 'Scotland', 'rhb', 'right-arm medium-fast'),
    (NULL, 'Craig Donald Wallace', 'CD Wallace', '1990-06-27', 'Dundee, Angus',
        'Scotland', 'rhb', 'wicketkeeper'),
    (NULL, 'Mark Robert James Watt', 'MRJ Watt', '1996-07-29', '',
        'Scotland', 'lhb', 'slow left-arm orthodox'),
    (NULL, 'Mahendra Singh Dhoni', 'MS Dhoni', '1981-08-08',
        'Ranchi, Bihar (now Jharkhanda)', 'India', 'rhb', 'rab');
"
