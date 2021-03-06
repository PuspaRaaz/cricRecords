#!/usr/bin/python
import sys
import random
import config

rand = random.Random()

database = config.Database()
db = database.database()
cursor = db.cursor()

class Matches:
    def __init__(self, matchID):

        self.matchID = matchID

        cursor.execute("SELECT * FROM Matches WHERE ID = %s", matchID)
        db.commit()
        row = cursor.fetchone()

        self.hometeam = row[1]
        self.awayteam = row[2]
        self.seriesID = row[3]
        self.number = row[4]
        self.date = row[5]
        self.venue = row[6]
        self.level = row[7]

        self.toss = 0
        self.winner = 0
        self.MoM = 0
        self.result = ""

        self.homeplayer = []
        self.awayplayer = []
        self.innings = []

        cursor.execute(
            "SELECT f.format FROM Series s \
            INNER JOIN Format f ON s.format = f.ID \
            WHERE s.ID = %s", self.seriesID)
        db.commit()
        row = cursor.fetchone()
        self.matchFormat = row[0]

        cursor.execute(
            "SELECT player FROM PlayerXMatch \
            WHERE matchID = %s AND team = %s", (matchID, self.hometeam))
        db.commit()
        for row in cursor.fetchall():
            for col in row:
                self.homeplayer.append(int(col))

        cursor.execute(
            "SELECT player FROM PlayerXMatch \
            WHERE matchID = %s AND team = %s", (matchID, self.awayteam))
        db.commit()
        for row in cursor.fetchall():
            for col in row:
                self.awayplayer.append(int(col))
 
class Innings:
    def __init__(self):
        self.matchID = 0
        self.number = 0
        self.batting = 0
        self.bowling = 0

class Generator:
    def __init__(self, matchID):
        self.__ball = ['runs','extras','wkts','r&e','e&w','r&w','r&e&w']
        prob = [77/100.0, 10/100.0, 3/100.0, 3/100.0, 3/100.0, 3/100.0, 1/100.0]
        self.__ballprob = [sum(prob[:x]) for x in range(1,len(prob)+1)]

        self.__runs = [0, 1, 2, 3, 4, 5, 6]
        prob = [44/100.0, 43/100.0, 3/100.0, 3/100.0, 9/200.0, 1/200.0, 2/100.0]
        self.__runsprob = [sum(prob[:x]) for x in range(1,len(prob)+1)]
        
        self.__extratype = ['wd','nb','lb','b','pen']
        prob = [6/25.0, 6/25.0, 6/25.0, 6/25.0, 1/25.0]
        self.__extraprob = [sum(prob[:x]) for x in range(1,len(prob)+1)]
        
        self.__extra = [1, 2]
        self.__overs = {'Test':'NULL', 'ODI':'50', 'T20I':'20'}
        self.__inningsCount = {'Test': 4, 'First-Class': 4, 'ODI': 2, 'T20I': 2}
        
        self.__match = Matches(matchID)
        self.inningsCount = self.__inningsCount[self.__match.matchFormat]
        self.oversCount = self.__overs[self.__match.matchFormat]

    def __choose(self, cprobs):
        choice = rand.randint(0, 1000) / 1000.0
        for i in range(len(cprobs)):
            if choice <= cprobs[i]:
                return i
        return len(cprobs) - 1

    def toss(self):
        teams = [self.__match.hometeam, self.__match.awayteam]
        self.__match.toss = rand.choice(teams)

        for x in xrange(self.inningsCount):
            self.__match.innings.append(Innings())
            self.__match.innings[x].number = x + 1
            self.__match.innings[x].matchID = self.__match.matchID

        randomTeam = rand.choice(self.__extra) - 1
        self.__match.innings[0].batting = self.__match.innings[1].bowling = teams[randomTeam]
       
        if(randomTeam): self.__match.innings[1].batting = self.__match.innings[0].bowling = teams[0]
        else: self.__match.innings[1].batting = self.__match.innings[0].bowling = teams[1]

    def play(self):
        runs = [0, 0]
        for x in xrange(self.inningsCount):
            print "Inning: ", x+1, "\tallocated overs: ", self.oversCount,

            over = wkts = declared = 0
            print self.__match.matchID, self.__match.innings[x].number, self.__match.innings[x].batting, self.__match.innings[x].bowling
            cursor.execute(
            "UPDATE Matches SET toss = %s WHERE ID = %s \
            ", (self.__match.toss, self.__match.matchID))
            db.commit()
            cursor.execute(
            "INSERT INTO Innings \
            (matchID, number, batting, bowling) \
            VALUES \
            (%s, %s, %s, %s)", (self.__match.matchID, self.__match.innings[x].number, self.__match.innings[x].batting, self.__match.innings[x].bowling))
            db.commit()

            cursor.execute("SELECT LAST_INSERT_ID()")
            db.commit()
            row = cursor.fetchone()
            inningsID = row[0]
            print "Inning ID = ", inningsID
            
            if (self.__match.hometeam == self.__match.innings[x].batting):
                batsmen = self.__match.homeplayer
                bowlers = self.__match.awayplayer
            else:
                batsmen = self.__match.awayplayer
                bowlers = self.__match.homeplayer

            if (x == 1): print "\ttarget: ", runs[0] + 1, "runs"
            else: print ""

            print "\nbatsmen:", batsmen
            print "bowlers:", bowlers

            striker = batsmen[0]
            nonstriker = batsmen[1]
            outbatsmen = []
            strikebowler = bowlers[-1]
            nonstrikebowler = bowlers[-2]

            while((x == 0 and over < int(self.oversCount) and wkts < 10 and not declared) or (runs[0] > (runs[1]-1) and x == 1 and over < int(self.oversCount) and wkts < 10)):
                print "over: ",over+1
                print "ball\tbowler\tbatsman\textratype\textra\truns\tisBoundary\twicket"

                ball = 0
                over = over + 1
                if (over < 7):
                    cursor.execute(
                    "INSERT INTO Over \
                    (innings, number, powerplay) \
                    VALUES \
                    (%s, %s, %s) \
                    ", (inningsID, over, 'mandatory'))
                else:
                    cursor.execute(
                    "INSERT INTO Over \
                    (innings, number) \
                    VALUES \
                    (%s, %s) \
                    ", (inningsID, over))
                db.commit()

                cursor.execute("SELECT LAST_INSERT_ID()")
                db.commit()
                row = cursor.fetchone()
                overID = row[0]
                print "Over ID = ", overID
            
                while((x == 0 and ball < 6 and wkts < 10) or (x == 1 and ball < 6 and wkts < 10 and  runs[0] > (runs[1]-1))):
                    ball = ball + 1
                    extratype = "-"
                    extra = 0
                    run = 0
                    dot = "."
                    isBoundary = 0
                    wicket = 0

                    ballResult = self.__ball[self.__choose(self.__ballprob)]
                    
                    if (ballResult == 'runs'):
                        run = self.__runs[self.__choose(self.__runsprob)]
                        if (run == 4 or run == 6): isBoundary = 1
                        runs[x] += run
                    
                    elif (ballResult == "extras"):
                        extratype = self.__extratype[self.__choose(
                                self.__extraprob)]
                        if (extratype == 'wd' or extratype == 'nb'):
                            extra = 1
                            runs[x] += 1
                            if (extratype == 'nb'):
                                run = self.__runs[self.__choose(self.__runsprob)]
                                if (run == 4 or run == 6): isBoundary = 1
                                runs[x] += run
                        
                        else:
                            extra = self.__runs[self.__choose(self.__runsprob)]
                            if (extra > 4): extra = 4
                            if (extra < 1): extra = 1
                            runs[x] += extra
                    
                    elif (ballResult == "wkts"):
                        wicket = 1
                        wkts = wkts + 1
#                        falltype = self.__falltype[self.__choose(self.__falltypeprob)]
                        victim = striker
                        takenby = strikebowler
                        fowruns = runs[x]
                        fowwickets = wkts
                        cursor.execute(
                        "INSERT INTO Wicket \
                        (innings, batsman, bowler, fowruns, fowwicket) \
                        VALUES \
                        (%s, %s, %s, %s, %s) \
                        ", (inningsID, victim, takenby, fowruns, fowwickets))
                        db.commit()

                        cursor.execute("SELECT LAST_INSERT_ID()")
                        db.commit()
                        row = cursor.fetchone()
                        wicketID = row[0]
                    
                    print ball, "\t", strikebowler, "\t", striker , "\t", extratype, "\t\t",
                    if(extratype == '-'):
                        print dot, "\t",
                        extratype = ''
                    else: print extra, "\t",
                    if(run): print run, "\t",
                    else: print dot, "\t",
                    if (not isBoundary): print dot, "\t\t",
                    else: print isBoundary, "\t\t",
                    if (ballResult == "wkts"): print wicket
                    else: print dot

                    if (ballResult == 'wkts'):
                        cursor.execute(
                        "INSERT INTO Ball \
                        (over, ball, bowler, batsman, extratype, extra, runs, isBoundary, wicket) \
                        VALUES \
                        (%s, %s, %s, %s, %s, %s, %s, %s, %s) \
                        ", (overID, ball, strikebowler, striker, extratype, extra, run, isBoundary, wicketID))
                        db.commit()
                    else:
                        cursor.execute(
                        "INSERT INTO Ball \
                        (over, ball, bowler, batsman, extratype, extra, runs, isBoundary) \
                        VALUES \
                        (%s, %s, %s, %s, %s, %s, %s, %s) \
                        ", (overID, ball, strikebowler, striker, extratype, extra, run, isBoundary))
                        db.commit()

                    if (run%2 or ((extratype == 'lb' or extratype == 'b') and extra%2)): striker, nonstriker = nonstriker, striker
                    
                    if (extratype == 'wd' or extratype == 'nb'):
                        ball = ball - 1
                    
                    if (ballResult == "wkts"):
                        outbatsmen.append(striker)
                        if (wkts < 10):
                            striker = batsmen[len(outbatsmen)+1]
                
                print"End of over", over,"\truns:",runs[x],"\twkts:",wkts,"\n"
                striker, nonstriker = nonstriker, striker
                nonstrikebowler = strikebowler
                while (strikebowler == nonstrikebowler):
                    strikebowler = rand.choice(bowlers)
            
            print"out batsmen:", outbatsmen
            inningsID += 1
        
        teamname = []
        cursor.execute(" \
        SELECT name FROM Team \
        WHERE ID = %s", self.__match.innings[0].batting)
        db.commit()
        row = cursor.fetchone()
        teamname.append(row[0])
        
        cursor.execute(" \
        SELECT name FROM Team \
        WHERE ID = %s", self.__match.innings[1].batting)
        db.commit()
        row = cursor.fetchone()
        teamname.append(row[0])

        if (runs[0] > runs[1]):
            winnername = teamname[0]
            winner = int(self.__match.innings[0].batting)
            result = winnername, "won the match by", (runs[0] - runs[1]), "runs"
        elif (runs[0] == runs[1]):
            winner = 'NULL'
            result = "match tied"
        else:
            winnername = teamname[1]
            winner = int(self.__match.innings[1].batting)
            result = winnername, "won the match by", (10 - wkts), "wickets with", (int(self.oversCount)*6 - (over-1)*6 - ball), "balls remaining"
        
        print "Result: ",
        outcome = ''
        for x in xrange(len(result)):
            print result[x],
            outcome = outcome + str(result[x]) + ' '
            
        if (runs[0] == runs[1]):
            cursor.execute(
            "UPDATE Matches SET result = %s WHERE ID = %s \
            ", (outcome, self.__match.matchID))
            db.commit()
        
        else:
            cursor.execute(
            "UPDATE Matches SET winner = %s, result = %s WHERE ID = %s \
            ", (winner, outcome, self.__match.matchID))
            db.commit()

    def generate(self):
        self.toss()
        self.display()
        self.play()
        
    def display(self):
        print "\nMatch Info: "
        print "format\thome\taway\ttoss"
        print self.__match.matchFormat,"\t",self.__match.hometeam,"\t",self.__match.awayteam,"\t",self.__match.toss 
        print "\nInnings Info: "
        print "number\tbatting\tbowling"
        for x in xrange(self.inningsCount):
            print self.__match.innings[x].number,"\t",self.__match.innings[x].batting,"\t",self.__match.innings[x].bowling
        print ""

gen = Generator(sys.argv[1])
gen.generate()

cursor.close()
db.close()
