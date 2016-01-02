<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,
        initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title> cricRecords - cricket stat-guru </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements
        and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                cricRecords
                </a>
            </div>
        </div>
    </div>

    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="forms.php"><i class="fa fa-edit"></i> Forms</a></li>
                            <li><a class="menu-top-active" href="players.php"><i class="fa fa-user"></i> Players</a></li>
                            <li><a href="teams.php"><i class="fa fa-flag"></i> Teams</a></li>
                            <li><a href="series.php"><i class="fa fa-trophy"></i> Series</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->

    <?php require_once "config.php";

    $select  = "SELECT * FROM Matches WHERE ID = ".$_GET['id']."";
    $select = mysqli_query($link, $select);
    $num_rows = mysqli_num_rows($select);

    if (isset($_GET['id']) && $num_rows == 1) {
        $row = mysqli_fetch_array($select);
        $match = $_GET['id']; ?>

        <div class"content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                        $select = "SELECT t1.name home, t2.name away FROM Matches m INNER JOIN Team t1 ON t1.ID = m.team_1 INNER JOIN Team t2 ON t2.ID = m.team_2
                            WHERE m.ID = ".$match."";
                        $select = mysqli_query($link, $select);
                        $select = mysqli_fetch_array($select);
                        ?>
                        <h1 class="page-head-line"><?php echo "".$select['home']." vs ".$select['away'].""; ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <?php
                                $select = "SELECT m.series sID, m.venue vID, s.name series, m.number, date(date) date, time(date) time, v.name venue, level,
                                    toss
                                    FROM Matches m INNER JOIN Series s ON s.ID = m.series INNER JOIN Venue v ON v.ID = m.venue
                                    WHERE m.ID = ".$match."";
                                $select = mysqli_query($link, $select);
                                $details = mysqli_fetch_array($select);
                                echo "<div class=\"panel panel-default\">";
                                echo "<div class=\"panel-heading\">Basic Information</div>";
                                echo "<div class=\"panel-body\">";
                                echo "<b>Series:</b> <a href=\"series.php?id=".$details['sID']."\">".$details['series']."</a>"; echo "<br>";
                                echo '<b>#:</b> '.$details['number']; echo "<br>";
                                echo '<b>Date:</b> '.$details['date']; echo "<br>";
                                echo '<b>Time:</b> '.$details['time']; echo "<br>";
                                echo '<b>Venue:</b> '.$details['venue']; echo "<br>";
                                
                                if (isset($details['toss'])) {
                                $result = "SELECT w.name winner, t.name toss, p.sname MoM, result FROM Matches m LEFT JOIN Team w on w.ID = m.winner
                                    LEFT JOIN Team t ON t.ID = m.toss LEFT JOIN Player p ON p.ID = m.MoM WHERE m.ID = ".$match."";
                                $result = mysqli_query($link, $result);
                                $result = mysqli_fetch_array($result);
                                echo "<br>";
                                echo '<b>Toss Winner:</b> '.$result['toss']; echo "<br>";
                                echo '<b>Winner:</b> '.$result['winner']; echo "<br>";
                                echo '<b>Man of the Match:</b> '.$result['MoM']; echo "<br>";
                                echo $result['result']; echo "<br>";
                                }
                                echo "</div></div>";
                                ?>
                            </div>
                            <div class="col-md-8">
                                <?php
                                $innings = "SELECT ID FROM Innings WHERE matchID = ".$match."";
                                $inng = mysqli_query($link, $innings);
                                $num = 1;
                                while ($innings = mysqli_fetch_array($inng)){
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Inning - <?php echo $num; ?></div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Player</th>
                                                    <th>fall</th>
                                                    <th>runs</th>
                                                    <th>ballsfaced</th>
                                                    <th>4s</th>
                                                    <th>6s</th>
                                                    <th>st rate</th>
                                                </thead>
                                                <tbody>
                                        <?php
                                        $select = "SELECT * FROM v_battingstat WHERE innings= ".$innings['ID']."";
                                        $sel = mysqli_query($link, $select);
                                        while ($select = mysqli_fetch_array($sel)) {
                                            echo "<tr>";
                                            echo "<td>".$select['sname']."</td>";
                                            $wicketcheck = "SELECT * FROM Wicket WHERE batsman = ".$select['batsman']." AND innings = ".$innings['ID']."";
                                            $wicketcheck = mysqli_query($link, $wicketcheck);
                                            $wicket = mysqli_fetch_array($wicketcheck);
                                            $isOut = mysqli_num_rows($wicketcheck);
                                            if ($isOut < 1) echo "<td>not out</td>";
                                            else if ($wicket['falltype'] == "ct"){
                                                if ($wicket['fielder'] == $wicket['bowler']){
                                                    $faller = "SELECT * FROM Wicket WHERE batsman = ".$select['batsman']." AND innings = ".$innings['ID']."";
                                                    $faller = mysqli_query($link, $faller);
                                                    $wicket = mysqli_fetch_array($faller);
                                                    echo "<td> c&b ".$wicket['bowler']."</td>";
                                                } else {
                                                    echo "<td> c ".$wicket['fielder']."  b ".$wicket['bowler']."</td>";
                                                }
                                            }
                                            else if ($wicket['falltype'] == "b"){
                                                echo "<td> b  ".$wicket['bowler']."</td>";
                                            }
                                            else if ($wicket['falltype'] == "st"){
                                                echo "<td> st ".$wicket['fielder']."  b ".$wicket['bowler']."</td>";
                                            }
                                            else if ($wicket['falltype'] == "lbw"){
                                                echo "<td> lbw  ".$wicket['bowler']."</td>";
                                            }
                                            else if ($wicket['falltype'] == "runout"){
                                                echo "<td> run out ".$wicket['fielder']."</td>";
                                            }
                                            else if ($wicket['falltype'] == "hitWicket"){
                                                echo "<td>hit wicket".$wicket['bowler']."</td>";
                                            }
                                            else if ($wicket['falltype'] == "timedOut"){
                                                echo "<td>timed out</td>";
                                            }
                                            else if ($wicket['falltype'] == "obstruction"){
                                                echo "<td>obstruction the field</td>";
                                            }
                                            else if ($wicket['falltype'] == "handledTheBall"){
                                                echo "<td>handled the ball</td>";
                                            }
                                            else if ($wicket['falltype'] == "hitBallTwice"){
                                                echo "<td>hit the ball twice</td>";
                                            }
                                            else if ($wicket['falltype'] == "retiredOut"){
                                                echo "<td> retired out </td>";
                                            }
                                            echo "<td>".$select['runs']."</td>";
                                            echo "<td>".$select['ballsfaced']."</td>";
                                            echo "<td>".$select['4s']."</td>";
                                            echo "<td>".$select['6s']."</td>";
                                            echo "<td>".$select['strikerate']."</td>";
                                            echo "</tr>";
                                        } ?>
                                                </tboody>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Player</th>
                                                    <th>balls</th>
                                                    <th>maidens</th>
                                                    <th>runs</th>
                                                    <th>wkts</th>
                                                    <th>4s</th>
                                                    <th>6s</th>
                                                    <th>wd</th>
                                                    <th>nb</th>
                                                    <th>eco</th>
                                                    <th>avg</th>
                                                </thead>
                                                <tbody>
                                        <?php
                                        $select = "SELECT * FROM v_bowlingstat WHERE innings= ".$innings['ID']."";
                                        $sel = mysqli_query($link, $select);
                                        while ($select = mysqli_fetch_array($sel)) {
                                            echo "<tr>";
                                            echo "<td>".$select['sname']."</td>";
                                            echo "<td>".$select['ballsbowled']."</td>";
                                            echo "<td>".$select['maidens']."</td>";
                                            echo "<td>".$select['runs']."</td>";
                                            echo "<td>".$select['wickets']."</td>";
                                            echo "<td>".$select['4s']."</td>";
                                            echo "<td>".$select['6s']."</td>";
                                            echo "<td>".$select['wides']."</td>";
                                            echo "<td>".$select['noballs']."</td>";
                                            echo "<td>".$select['economy']."</td>";
                                            echo "<td>".$select['average']."</td>";
                                            echo "</tr>";
                                        } ?>
                                                </tboody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php $num = $num + 1; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>

    <?php } else { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line text-center">Matches</h4>
                    </div>
                </div>
                <div class="row forms-menu">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <h3> Fixtures </h3>
                                <?php 
                                    $select = "SELECT m.ID, team_1, team_2, date(date) date, time(date) time, v.name venue, s.name series FROM Matches m
                                        INNER JOIN Venue v ON v.ID = m.venue INNER JOIN Series s ON s.ID = m.series
                                        WHERE toss IS NULL AND winner IS NULL ORDER BY date";
                                    $select = mysqli_query($link, $select);
                                    $number_results = mysqli_num_rows($select);
                                    if ($number_results > 0) {
                                        while ($matches = mysqli_fetch_array($select)) {
                                            echo "<a href=\"matches.php?id=".$matches['ID']."\">";
                                            echo "<div class=\"panel panel-default\">";
                                            echo "vs ";
                                            if ($team == $matches['team_1']) {
                                                $opponent = "SELECT name FROM Team WHERE ID = ".$matches['team_2']."";
                                                $opponent = mysqli_query($link, $opponent);
                                                $opponent = mysqli_fetch_array($opponent);
                                                echo "<strong>".$opponent['name']."</strong>"; echo "<br>"; }
                                            else {
                                                $opponent = "SELECT name FROM Team WHERE ID = ".$matches['team_1']."";
                                                $opponent = mysqli_query($link, $opponent);
                                                $opponent = mysqli_fetch_array($opponent);
                                                echo "<strong>".$opponent['name']."</strong>"; echo "<br>"; }
                                            echo $matches['series']; echo "<br>";
                                            echo $matches['venue']; echo "<br>";
                                            echo $matches['date']; echo "<br>";
                                            echo $matches['time'];
                                            echo "</div></a>";
                                        }
                                    } else {
                                        echo "<div clas\"panel panel-default\">";
                                        echo "No fixtures to display";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <h3> Results </h3>
                                <?php 
                                    $select = "SELECT m.ID, team_1, team_2, date(date) date, result, v.name venue, s.name series FROM Matches m
                                        INNER JOIN Venue v ON v.ID = m.venue INNER JOIN Series s ON s.ID = m.series
                                        WHERE toss IS NOT NULL ORDER BY date DESC";
                                    $select = mysqli_query($link, $select);
                                    $number_results = mysqli_num_rows($select);
                                    if ($number_results > 0) {
                                        while ($matches = mysqli_fetch_array($select)) {
                                            echo "<a href=\"matches.php?id=".$matches['ID']."\">";
                                            echo "<div class=\"panel panel-default\">";
                                            echo "vs ";
                                            if ($team == $matches['team_1']) {
                                                $opponent = "SELECT name FROM Team WHERE ID = ".$matches['team_2']."";
                                                $opponent = mysqli_query($link, $opponent);
                                                $opponent = mysqli_fetch_array($opponent);
                                                echo "<strong>".$opponent['name']."</strong>"; echo "<br>"; }
                                            else {
                                                $opponent = "SELECT name FROM Team WHERE ID = ".$matches['team_1']."";
                                                $opponent = mysqli_query($link, $opponent);
                                                $opponent = mysqli_fetch_array($opponent);
                                                echo "<strong>".$opponent['name']."</strong>"; echo "<br>"; }
                                            echo $matches['series']; echo "<br>";
                                            echo $matches['venue']; echo "<br>";
                                            echo $matches['result']; echo "<br>";
                                            echo "</div></a>";
                                        }
                                    } else {
                                        echo "<div clas\"panel panel-default\">";
                                        echo "No results to display";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
                            <div class="col-md-4 text-right">
                                <h3> Series </h3>
                                <?php 
                                    $select = "SELECT s.ID, s.name, f.format format FROM Series s INNER JOIN Format f ON f.ID = s.format ORDER BY s.ID";
                                    $select = mysqli_query($link, $select);
                                    $number_results = mysqli_num_rows($select);
                                    if ($number_results > 0) {
                                        while ($series = mysqli_fetch_array($select)) {
                                            echo "<a href=\"series.php?id=".$series['ID']."\"><h5>".$series['name']." (".$series['format'].")</h5></a>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2015 cricRecords | <a href="http://www.yach.com/" target="_blank">YACh Team</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
