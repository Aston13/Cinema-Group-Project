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
    </style>

</head>
<body>
	<div class = "welcome">
		<b id="welcome">Welcome, <i><?php echo $login_session; ?></i> | </b>
		<b id="welcome"><i><?php echo $user_check; ?></i></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<b id="logout"><a href="logout">Log Out</a></b>
		<br>
	</div>

	<h1>Film List</h1>
	<p><b>Filter Results:</b></p>
	<div id="query">
    	    <form action="" method="post">

				<label>Film Title:</label>
				<input name ="filmTitle" placeholder="Film Title" type="text">

				<label>Director:</label>
				<input name ="director" placeholder="Director's Name" type="text">

				<label>Year of Release:</label>
				<input name="yearOfRelease" type="year" >
				
				<input name="search" type="submit" value="Search">
            </form>
   		</div>

		<div class = "container"> 
			<?php include('mem_film_query.php'); ?>
		</div>
</body>
</html>