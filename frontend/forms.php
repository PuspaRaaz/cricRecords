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
                            <li><a class="menu-top-active" href="forms.php"><i class="fa fa-edit"></i> Forms</a></li>
                            <li><a href="players.php"><i class="fa fa-user"></i> Players</a></li>
                            <li><a href="teams.php"><i class="fa fa-flag"></i> Teams</a></li>
                            <li><a href="series.php"><i class="fa fa-trophy"></i> Series</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->

    <section class="menu-section sub-menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a <?php if (isset($_GET['association'])) {echo 'class="menu-top-active"'; } ?> href="?association">Board</a></li>
                            <li><a <?php if (isset($_GET['match'])) {echo 'class="menu-top-active"'; } ?> href="?match">Match</a></li>
                            <li><a <?php if (isset($_GET['player'])) {echo 'class="menu-top-active"'; } ?> href="?player">Player</a></li>
                            <li><a <?php if (isset($_GET['series'])) {echo 'class="menu-top-active"'; } ?> href="?series">Series</a></li>
                            <li><a <?php if (isset($_GET['team'])) {echo 'class="menu-top-active"'; } ?> href="?team">Team</a></li>
                            <li><a <?php if (isset($_GET['venue'])) {echo 'class="menu-top-active"'; } ?> href="?venue">Venue</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FORM-MENU SECTION END-->

<?php include "config.php"; ?>

    <!-- VENUE FORM -->
    <?php if (isset($_GET['venue'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Venue </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="venue" />
                                    <div class="form-group">
                                        <label for="inputName">Venue Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAssociation">Association</label>
                                        <select class="form-control" name="association">
                                        <?php
                                            $selectAssociations = "SELECT ID, name FROM Association ORDER BY name";
                                            $selectAssociations = mysqli_query($link, $selectAssociations);
                                            while ($row = mysqli_fetch_array($selectAssociations)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" name="city" placeholder="City" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCountry">Country</label>
                                        <input type="text" class="form-control" name="country" placeholder="Country" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCapacity">Capacity</label>
                                        <input type="number" class="form-control" name="capacity" placeholder="Capacity" />
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- VENUE FORM ENDS-->

    // <!-- TEAM FORM -->
    else if (isset($_GET['team'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Team </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="team" />
                                    <div class="form-group">
                                        <label for="inputName">Team Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAssociation">Association</label>
                                        <select class="form-control" name="association">
                                        <?php
                                            $selectAssociations = "SELECT ID, name FROM Association ORDER BY name";
                                            $selectAssociations = mysqli_query($link, $selectAssociations);
                                            while ($row = mysqli_fetch_array($selectAssociations)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- TEAM FORM ENDS-->

    // <!-- SERIES FORM -->
    else if (isset($_GET['series'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Series </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="series" />
                                    <div class="form-group">
                                        <label for="inputName">Series Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFormat">Format</label>
                                        <select class="form-control" name="format">
                                        <?php
                                            $selectFormat = "SELECT ID, format FROM Format ORDER BY format";
                                            $selectFormat= mysqli_query($link, $selectFormat);
                                            while ($row = mysqli_fetch_array($selectFormat)) {
                                                echo "<option value='".$row["ID"]."'>".$row["format"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSeason">Season</label>
                                        <input type="text" class="form-control" name="season" placeholder="Season" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputType">Type</label>
                                            <select class="form-control" name="type">
                                                <option value="international">International</option>
                                                <option value="bilateral">Bi-lateral</option>
                                                <option value="tri-series">Tri-Series</option>
                                                <option value="domestic">Domestic</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTeam">Team</label>
                                        <select multiple="" class="form-control" name="team[]">
                                        <?php
                                            $selectTeam = "SELECT ID, name FROM Team ORDER BY association";
                                            $selectTeam = mysqli_query($link, $selectTeam);
                                            while ($row = mysqli_fetch_array($selectTeam)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVenue">Venue</label>
                                        <select multiple="" class="form-control" name="venue[]">
                                        <?php
                                            $selectVenue = "SELECT ID, name FROM Venue ORDER BY country";
                                            $selectVenue = mysqli_query($link, $selectVenue);
                                            while ($row = mysqli_fetch_array($selectVenue)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- SERIES FORM ENDS-->

    // <!-- PLAYER FORM -->
    else if (isset($_GET['player'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Player </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="player" />
                                    <div class="form-group">
                                        <label for="inputName">Player Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputShortName">Short Name</label>
                                        <input type="text" class="form-control" name="sname" placeholder="Short Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBirthDate">BirthDate</label>
                                        <input type="date" class="form-control" name="dob" placeholder="BirthDate" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" name="city" placeholder="City (birthplace)" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCountry">Country</label>
                                        <input type="text" class="form-control" name="country" placeholder="Country (birthplace)" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBatting">Batting</label>
                                        <select  class="form-control" name="batting">
                                            <option value="rhb">right-handed batsman</option>
                                            <option value="lhb">left-handed batsman</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBowling">Bowling</label>
                                        <input type="text" class="form-control" name="bowling" placeholder="Bowling" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTeam">Team</label>
                                        <select multiple="" class="form-control" name="team[]">
                                        <?php
                                            $selectTeam = "SELECT ID, name FROM Team ORDER BY association";
                                            $selectTeam = mysqli_query($link, $selectTeam);
                                            while ($row = mysqli_fetch_array($selectTeam)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- PLAYER FORM ENDS-->

    // <!-- MATCH FORM -->
    else if (isset($_GET['match'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Match </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="match" />
                                    <div class="form-group">
                                        <label for="inputTeam">Team 1</label>
                                        <select class="form-control" name="team_1">
                                        <?php
                                            $selectTeam = "SELECT ID, name FROM Team ORDER BY association";
                                            $selectTeam = mysqli_query($link, $selectTeam);
                                            while ($row = mysqli_fetch_array($selectTeam)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTeam">Team 2</label>
                                        <select class="form-control" name="team_2">
                                        <?php
                                            $selectTeam = "SELECT ID, name FROM Team ORDER BY association";
                                            $selectTeam = mysqli_query($link, $selectTeam);
                                            while ($row = mysqli_fetch_array($selectTeam)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSeries">Series</label>
                                        <select class="form-control" name="series">
                                        <?php
                                            $selectVenue = "SELECT ID, name, format FROM Series ORDER BY ID";
                                            $selectVenue = mysqli_query($link, $selectVenue);
                                            while ($row = mysqli_fetch_array($selectVenue)) {
                                            	$format = $row["format"];
                                            	$selectFormat = "SELECT format FROM Format WHERE ID = $format";
                                            	$selectFormat = mysqli_query($link, $selectFormat);
                                            	$selectFormat = mysqli_fetch_array($selectFormat);
                                                echo "<option value='".$row["ID"]."'>".$row["name"]." (".$selectFormat["format"].") </option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNumber">Number</label>
                                        <input type="integer" class="form-control" name="number"  placeholder="Match Number (series)" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDateTime">DateTime</label>
                                        <input type="datetime" class="form-control" name="date"  placeholder="DateTime" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVenue">Venue</label>
                                        <select class="form-control" name="venue">
                                        <?php
                                            $selectVenue = "SELECT ID, name FROM Venue ORDER BY country";
                                            $selectVenue = mysqli_query($link, $selectVenue);
                                            while ($row = mysqli_fetch_array($selectVenue)) {
                                                echo "<option value='".$row["ID"]."'>".$row["name"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLevel">Level</label>
                                        <input type="text" class="form-control" name="level"  placeholder="Level" />
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- MATCH FORM ENDS-->

//    <!-- VENUE FORM -->
    else if (isset($_GET['association'])) { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-head-line">Association </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="form-submit.php" method="post">
                                    <input type="hidden" name="form-type" value="association" />
                                    <div class="form-group">
                                        <label for="inputName">Association Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCountry">Country</label>
                                        <input type="text" class="form-control" name="country" placeholder="Country" />
                                    </div>
                                    <button type="submit" class="btn btn-default col-md-offset-5">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    // <!-- VENUE FORM ENDS-->

    // <!-- MATCH FORM -->
    else { ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Forms</h4>
                    </div>
                </div>
                <div class="row forms-menu">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?association">
                            <div class="dashboard-div-wrapper bk-clr-one">
                            <i class="fa fa-bookmark dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            </div>
                            </div>
                            <h5>Association Form </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?match">
                            <div class="dashboard-div-wrapper bk-clr-two">
                            <i class="fa fa-bell dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                            <h5>Match Form </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?player">
                            <div class="dashboard-div-wrapper bk-clr-three">
                            <i  class="fa fa-user dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                            <h5>Player Form </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?series">
                            <div class="dashboard-div-wrapper bk-clr-four">
                            <i class="fa fa-trophy dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                            <h5>Series Form </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?team">
                            <div class="dashboard-div-wrapper bk-clr-five">
                            <i class="fa fa-flag dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            </div>
                            </div>
                            <h5>Team Form </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <a href="?venue">
                            <div class="dashboard-div-wrapper bk-clr-six">
                            <i class="fa fa-map-marker dashboard-div-icon" ></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                </div>
                            </div>
                            <h5>Venue Form </h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

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
