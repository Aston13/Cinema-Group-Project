<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){ 
		header('Location:http://localhost:8080/mice/index.php'); // Redirecting To Home Page 
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Member Portal</title>

    <style>
        h1 {
            text-align: center;
            font-family: Calibri;
        }
        p.p-centre {
            text-align: center;
            font-family: Arial;
        }
		.container {
			display:flex;
			flex-direction:row;
			justify-content: center;
			width: 100%;
		}		
		.mytable {
			width: 50%;
		}
		.resultbuttons {
			width: 50%;
		}
		.resultbutton {
			width: 100%;
		}				
    </style>

</head>
<body>
	<b id="welcome">Welcome, <i><?php echo $login_session; ?></i>.</b>
	<br>
	<b id="logout"><a href="logout">Log Out</a></b>
	Today's date is <?php echo date("d/m/Y"); ?>
	
	<h1>Search for performances</h1>
			<!-- Display performances searched by: 
		filmName,
		 screenNo(via cinemaName),
		  startDate(== exact),
		   startTime(=>),
		    cinemaNo  
			-->

		<div id="query">
    	    <form action="" method="post">
				<label>Location:</label>
				<input name ="location" placeholder="Location" type="text">

                <label>Select Cinema:</label>
                <!-- <input id="name" name="username" placeholder="username" type="text"> --->
				<select name ="cinema">
					<option value ="%">Any</option>
					<option value ="%3">Rialto</option>
					<option value ="%1">Intu</option>
					<option value ="%2">Phoenix</option>
					<option value ="%4">Intimate</option>
				</select>
				<label>Screen:</label>
				<select name ="screen">
					<option value ="%">Any</option>
					<option value ="%1">1</option>
					<option value ="%2">2</option>
					<option value ="%3">3</option>
				</select>

				<label>Film Name:</label>
				<input name ="filmName" placeholder="Film Name" type="text">

				<label>Starts From:</label>
				<input type="time" name="startTime" min="00:00" max="24:00">

				<label>Date:</label>
				<input type="date" name="exactDate" min=
					<?php echo date('Y-m-d'); ?>
				>
				
				<input name="search" type="submit" value="Search">
                
            </form>
   		</div>
		<div class = "container"> 
			<?php include('query.php'); ?>
		</div>
</body>
</html>