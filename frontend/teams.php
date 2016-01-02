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
                            <li><a href="players.php"><i class="fa fa-user"></i> Players</a></li>
                            <li><a class="menu-top-active" href="teams.php"><i class="fa fa-flag"></i> Teams</a></li>
                            <li><a href="series.php"><i class="fa fa-trophy"></i> Series</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->

    <?php require_once "config.php";

    $select  = "SELECT * FROM Team WHERE ID = ".$_GET['id']."";
    $select = mysqli_query($link, $select);
    $num_rows = mysqli_num_rows($select);

    if (isset($_GET['id']) && $num_rows == 1) {
        $row = mysqli_fetch_array($select);
        $team = $_GET['id']; ?>

        <div class"content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line"><?php echo $row['name']; ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <h3> Fixtures </h3>
                                <?php 
                                    $select = "SELECT m.ID, team_1, team_2, date(date) date, time(date) time, v.name venue, s.name series FROM Matches m
                                        INNER JOIN Venue v ON v.ID = m.venue INNER JOIN Series s ON s.ID = m.series
                                        WHERE (team_1 = ".$team." OR team_2 = ".$team.") AND toss IS NULL AND winner IS NULL ORDER BY date";
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
                                        WHERE (team_1 = ".$team." OR team_2 = ".$team.") AND toss IS NOT NULL ORDER BY date DESC";
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
                                <h3> Players </h3>
                                <?php 
                                    $select = "SELECT pt.player, p.name FROM PlayerXTeam pt INNER JOIN Player p ON p.ID = pt.player WHERE pt.team = ".$_GET['id']."";
                                    $select = mysqli_query($link, $select);
                                    $number_results = mysqli_num_rows($select);
                                    if ($number_results > 0) {
                                        while ($players = mysqli_fetch_array($select)) {
                                            echo "<a href=\"players.php?id=".$players['player']."\"><h4>".$players['name']."</h4></a>";
                                        }
                                    } else {
                                        echo "<div clas\"panel panel-default\">";
                                        echo "No players to display";
                                        echo "</div>";
                                    }
                                ?>
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
                        <h4 class="page-head-line text-center">Teams</h4>
                    </div>
                </div>
                <div class="row forms-menu">
                    <?php
                    $select = "SELECT ID, name FROM Team";
                    $select = mysqli_query($link, $select);
                    while ($teams = mysqli_fetch_array($select)){
                    echo "<div class=\"panel panel-default col-md-3 col-sm-4 col-xs-6\">";
                                    echo "<a href=\"teams.php?id=".$teams['ID']."\">";
                                    echo "".$teams['name']."";
                                    echo "</a></div>";
                    } ?>
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
