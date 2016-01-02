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

    $select  = "SELECT * FROM Player WHERE ID = ".$_GET['id']."";
    $select = mysqli_query($link, $select);
    $num_rows = mysqli_num_rows($select);

    if (isset($_GET['id']) && $num_rows == 1) {
        $row = mysqli_fetch_array($select);
        $player = $_GET['id']; ?>

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
                            <div class="col-md-3">
                                <h3> Basic Information </h3>
                                <?php
                                $select = "SELECT sname, date(dob) dob, city, country, batting, bowling FROM Player WHERE ID = ".$player."";
                                $select = mysqli_query($link, $select);
                                $details = mysqli_fetch_array($select);
                                echo "<div class=\"panel panel-default\">";
                                echo "<div class=\"panel-body\">";
                                echo $details['sname']; echo "<br>";
                                echo $details['dob']; echo "<br>";
                                echo "".$details['city'].", ".$details['country'].""; echo "<br>";
                                echo $details['batting']; echo "<br>";
                                echo $details['bowling']; echo "<br>";
                                echo "</div></div>";
                                ?>
                                <h3> Teams </h3>
                                <?php 
                                    $select = "SELECT pt.team, t.name FROM PlayerXTeam pt INNER JOIN Team t ON t.ID = pt.team
                                        WHERE pt.player = ".$_GET['id']."";
                                    $select = mysqli_query($link, $select);
                                    $number_results = mysqli_num_rows($select);
                                    if ($number_results > 0) {
                                        while ($teams = mysqli_fetch_array($select)) {
                                            echo "<a href=\"teams.php?id=".$teams['team']."\"><h4>".$teams['name']."</h4></a>";
                                        }
                                    } else {
                                        echo "<div clas\"panel panel-default\">";
                                        echo "No teams to display";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
                            <div class="col-md-9">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Batting Stats</div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Format</th>
                                                    <th>MP</th>
                                                    <th>Inngs</th>
                                                    <th>NO</th>
                                                    <th>runs</th>
                                                    <th>bf</th>
                                                    <th>best</th>
                                                    <th>4s</th>
                                                    <th>6s</th>
                                                    <th>st</th>
                                                    <th>avg</th>
                                                    <th>50s</th>
                                                    <th>100s</th>
                                                </thead>
                                                <tbody>
                                        <?php
                                        $select = "SELECT * FROM v_career_batsman WHERE ID= ".$player." GROUP BY format";
                                        $select = mysqli_query($link, $select);
                                        while ($select = mysqli_fetch_array($select)) {
                                            echo "<tr>";
                                            echo "<td>".$select['format']."</td>";
                                            echo "<td>".$select['matches']."</td>";
                                            echo "<td>".$select['innings']."</td>";
                                            echo "<td>".$select['NOs']."</td>";
                                            echo "<td>".$select['runs']."</td>";
                                            echo "<td>".$select['ballsfaced']."</td>";
                                            echo "<td>".$select['best']."";
                                            if ($select['isNO']) echo "*</td>";
                                            else echo "</td>";
                                            echo "<td>".$select['4s']."</td>";
                                            echo "<td>".$select['6s']."</td>";
                                            echo "<td>".$select['strikerate']."</td>";
                                            echo "<td>".$select['average']."</td>";
                                            echo "<td>".$select['50s']."</td>";
                                            echo "<td>".$select['100s']."</td>";
                                            echo "</tr>";
                                        } ?>
                                                </tboody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Bowling Stats</div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Ft</th>
                                                    <th>MP</th>
                                                    <th>Ing</th>
                                                    <th>r</th>
                                                    <th>b</th>
                                                    <th>m</th>
                                                    <th>w</th>
                                                    <th>best</th>
                                                    <th>4s</th>
                                                    <th>6s</th>
                                                    <th>wd</th>
                                                    <th>nb</th>
                                                    <th>eco</th>
                                                    <th>avg</th>
                                                    <th>st</th>
                                                    <th>5w</th>
                                                    <th>10w</th>
                                                </thead>
                                                <tbody>
                                        <?php
                                        $select = "SELECT * FROM v_career_bowler WHERE ID= ".$player." GROUP BY format";
                                        $select = mysqli_query($link, $select);
                                        while ($select = mysqli_fetch_array($select)) {
                                            echo "<tr>";
                                            echo "<td>".$select['format']."</td>";
                                            echo "<td>".$select['matches']."</td>";
                                            echo "<td>".$select['innings']."</td>";
                                            echo "<td>".$select['runsconceded']."</td>";
                                            echo "<td>".$select['ballsbowled']."</td>";
                                            echo "<td>".$select['maidens']."</td>";
                                            echo "<td>".$select['wickets']."</td>";
                                            echo "<td>".$select['bestwkts']."/".$select['bestruns']."</td>";
                                            echo "<td>".$select['4s']."</td>";
                                            echo "<td>".$select['6s']."</td>";
                                            echo "<td>".$select['wides']."</td>";
                                            echo "<td>".$select['noballs']."</td>";
                                            echo "<td>".$select['economy']."</td>";
                                            echo "<td>".$select['average']."</td>";
                                            echo "<td>".$select['strikerate']."</td>";
                                            echo "<td>".$select['5w']."</td>";
                                            echo "<td>".$select['10w']."</td>";
                                            echo "</tr>";
                                        } ?>
                                                </tboody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
                        <h4 class="page-head-line text-center">Players</h4>
                    </div>
                </div>
                <div class="row forms-menu">
                    <?php
                    $select = "SELECT ID, name FROM Player";
                    $select = mysqli_query($link, $select);
                    while ($teams = mysqli_fetch_array($select)){
                    echo "<div class=\"panel panel-default col-md-3 col-sm-4 col-xs-6\">";
                                    echo "<a href=\"players.php?id=".$teams['ID']."\">";
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
