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
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="forms.php">Forms</a></li>
                            <li><a class="menu-top-active" href="generator.php">Generate</a></li>
                            <li><a href="query.php">Query</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->

    <?php { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Generator 
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <button type="submit" class="btn btn-danger pull-right">Generate</button>
                            <input type="text" class="pull-right" name="match" placeholder="Match ID" />
                        </form></h1>
                    </div>
                </div>
                <?php } if (isset($_POST['match']) && !empty($_POST['match'])) { 
                    include "config.php";
                    $ID = mysqli_escape_string($link, $_POST['match']);
                    $result=mysqli_query($link,"SELECT * FROM `Matches` WHERE ID='$ID'");
                    $row=mysqli_fetch_array($result);
                    $format = $row['format'];
                    $team_1 = $row['team_1'];
                    $team_2 = $row['team_2'];
                    $date = $row['date'];
                    $venue = $row['venue'];
                    $series = $row['series'];
                    $level = $row['level'];
                    $number = $row['number'];

                    $home=mysqli_query($link,"SELECT * FROM `Team` WHERE ID='$team_1'");
                    $row=mysqli_fetch_array($home);
                    $home = $row['name'];
                    $away=mysqli_query($link,"SELECT * FROM `Team` WHERE ID='$team_2'");
                    $row=mysqli_fetch_array($away);
                    $away = $row['name'];
                    $stadium=mysqli_query($link,"SELECT * FROM `Venue` WHERE ID='$venue'");
                    $row=mysqli_fetch_array($stadium);
                    $stadium = $row['name'];
                    $location = $row['location'];
                    $comp=mysqli_query($link,"SELECT * FROM `Series` WHERE ID='$series'");
                    $row=mysqli_fetch_array($comp);
                    $comp = $row['name'];
                    $season = $row['season'];
                ?>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-head-line">Details</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="dashboard-div-wrapper bk-clr-one col-md-8">
                            <span class="col-md-7 col-sm-7 text-left">
                                <h2><?php echo "".$home." vs ".$away.""; ?></h2>
                                <h5><?php echo "".$stadium." (".$location.")"; ?></h5>
                            </span>
                            <span class="col-md-5 col-sm-5 text-right">
                                <h5><?php echo "".$comp." - ".$format." (".$season.")"; ?></h5>
                                <h5><?php echo "".$date.""; ?></h5>
                                <h5><?php echo "Match #: ".$number." ".$level.""; ?></h5>
                            </span>
                        </div>
                    </div>
                <?php
                    $ball = ['runs', 'wkts', 'extras', 'r&w', 'r&e', 'w&e', 'r&e&w'];
                    $runs = ['0', '1', '2', '3', '4', '5', '6'];
                    $extras = ['w', 'nb', 'lb', 'b', 'pen'];
                    $sn = 1; $wkts = 0; $wktslimit = 10;
                    $declared = false; $over = 0;
                    if ($format == 'ODI') $overlimit = 50;
                    else if ($format == 'T20I' or $format == 'T20') $overlimit = 20;
                    while($wkts < $wktslimit or $over < $overlimit or $declared){
                        $i = mt_rand()%7;
                        $over = $over + 1/6;
                        $declared = mt_rand()%2;

                        switch ($ball[$i]) {
                            case 'runs':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Runs scored.</h5>";
                                $sn ++;
                                break;
                            
                            case 'wkts':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Wicket fallen.</h5>";
                                $sn ++;
                                $wkts = $wkts + 1;
                                break;
                            
                            case 'extras':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Extras given.</h5>";
                                $sn ++;
                                break;
                            
                            case 'r&w':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Run & a wicket.</h5>";
                                $sn ++;
                                $wkts = $wkts + 1;
                                break;
                            
                            case 'r&e':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Run and extra.</h5>";
                                $sn ++;
                                break;
                            
                            case 'w&e':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Extra and wicket.</h5>";
                                $sn ++;
                                $wkts = $wkts + 1;
                                break;
                            
                            case 'r&e&w':
                                echo "<h5>".$sn." wkts=".$wkts." over=".$over." Run and extra and wicket.</h5>";
                                $sn ++;
                                $wkts = $wkts + 1;
                                break;
                        }
                    }
                    if ($declared) echo "declared";
                    else if ($over < $overlimit) echo "over";
                    else echo "allout";
                }
                ?>
            </div>
        </div>
    <!-- GENERATED DETAIL ENDS-->

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

                  
