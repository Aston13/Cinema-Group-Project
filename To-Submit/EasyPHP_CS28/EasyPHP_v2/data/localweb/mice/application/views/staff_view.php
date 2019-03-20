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
	<title>Festival Director's Portal</title>

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
        <b id="welcome">Welcome Director <i><?php echo $login_session; ?></i>.</b>
        <br>
	    Today's date is <?php echo date("d/m/Y"); ?>
        <br>
        <b id="logout"><a href="logout">Log Out</a></b>
    </div>
</body>
</html>