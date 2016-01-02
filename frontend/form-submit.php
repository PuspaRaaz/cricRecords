<?php
	include "config.php";
	if(isset($_POST['form-type'])){
		$form_type = $_POST['form-type'];
        
        //venue form is handled here
		if ($form_type == "venue"){

			$name = $_POST['name'];
			$association = $_POST['association'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$capacity = $_POST['capacity'];
            echo $name; echo " ";
            echo $association; echo " ";
            echo $city; echo " ";
            echo $country; echo " ";
            echo $capacity; echo " ";

/*			$insert = "INSERT INTO `Venue`
                (name, association, city, country, capacity)
				VALUES
                ('$name', '$association', '$city, $country', '$capacity')";
			mysqli_query($link, $insert);
			header("location:forms.php?venue");
*/
		}

        //team form is handled here
		else if ($form_type == "team"){

			$name = $_POST['name'];
			$association = $_POST['association'];
            echo $name; echo " ";
            echo $association; echo " ";

/*			$insert = "INSERT INTO Team
                (name, association)
				VALUES
                ('$name', '$association')";
			mysqli_query($link, $insert);

			header("location:forms.php?team");
*/
		}

        //series form is handled here
		else if ($form_type == "series"){

			$name = $_POST['name'];
			$format = $_POST['format'];
			$season = $_POST['season'];
            $type = $_POST['type'];
            $team = $_POST['team'];
            $venue = $_POST['venue'];
            echo $name; echo " ";echo "<br>"; echo " ";echo $format; echo " ";
            echo $season; echo " "; echo $type;
            /*
			$insert = "INSERT INTO `Series`
                (name, format, season)
				VALUES
                ('$name', '$format', '$season')";
			mysqli_query($link, $insert);
            $series = lastinsertid();
*/
            if ($team){ foreach ($team as $t){
                    echo $t; echo ", "; 
            /*
			$insert = "INSERT INTO SeriesXTeam
                (series, team)
				VALUES
                ('$series', '$t'";
			mysqli_query($link, $insert);
*/
                    }
            }
            echo "<br>";
            if ($venue){ foreach ($venue as $t){
                    echo $t; echo ", "; 
            /*
			$insert = "INSERT INTO SeriesXVenue
                (series, venue)
				VALUES
                ('$series', '$t'";
			mysqli_query($link, $insert);
*/
                    }
            }
/*
			header("location:forms.php?series");
            */
		}

        //player form is handled here
		else if ($form_type == "player"){

			$name = $_POST['name'];
			$sname = $_POST['sname'];
			$dob = $_POST['dob'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$batting = $_POST['batting'];
			$bowling = $_POST['bowling'];
            $team = $_POST['team'];
            echo $name; echo " ";echo $sname; echo " ";echo $dob; echo " ";echo $city;
            echo " ";echo $country; echo " ";echo $batting; echo " ";echo $bowling;

/*            
			$insert = "INSERT INTO Player`
                (name, sname, dob, city, country, batting, bowling)
				VALUES
                ('$name', '$sname', '$dob', '$city', '$country', '$batting', '$bowling');
			mysqli_query($link, $insert);
            $player = lastinsertid();
*/
            echo "<br>";
            if ($team){ foreach ($team as $t){
                    echo $t; echo ", "; 
            /*
			$insert = "INSERT INTO PlayerXTeam
                (player, team)
				VALUES
                ('$player', '$t'";
			mysqli_query($link, $insert);
*/
                    }
            }
/*
			header("location:forms.php?player");
    */
		}

        //match form is handled here
		else if ($form_type == "match"){

			$hometeam = $_POST['team_1'];
			$awayteam = $_POST['team_2'];
			$series = $_POST['series'];
			$number = $_POST['number'];
			$date = $_POST['date'];
			$venue = $_POST['venue'];
			$level = $_POST['level'];
            echo $hometeam; echo " ";echo $awayteam; echo " ";echo $series; echo " ";echo $number;
            echo " "; echo $date; echo " ";echo $venue; echo " ";echo $level;
/*            
			$insert = "INSERT INTO `Matches`
                (name, association, location,capacity)
				VALUES
                ('$name', '$association', '$location', '$capacity')";
			mysqli_query($link, $insert);

			header("location:forms.php?match");
*/
		}

        //association form is handled here
		else if ($form_type == "association"){

			$name = $_POST['name'];
			$country = $_POST['country'];
            echo $name; echo " ";echo $country; echo " ";
/*            
			$insert = "INSERT INTO `Matches`
                (name, association, location,capacity)
				VALUES
                ('$name', '$association', '$location', '$capacity')";
			mysqli_query($link, $insert);

			header("location:forms.php?match");
*/
		}
		else {
			echo "error!<br>";
            echo "Back to <a href='forms.php'>FORMS</a><br>";
            echo "Back to <a href='index.php'>HOME</a>";
		}
	} else{
		echo "error!<br>";
        echo "Back to <a href='forms.php'>FORMS<br></a>";
        echo "Back to <a href='index.php'>HOME</a>";
	}
?>
