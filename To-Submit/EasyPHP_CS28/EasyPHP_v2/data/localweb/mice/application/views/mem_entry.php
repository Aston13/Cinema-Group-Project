<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){ 
		header('Location:http://localhost:8080/mice/index.php'); // Redirecting To Home Page 
	}

	include('bookings.php');
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
	<b id="welcome">Welcome, <i><?php echo $login_session; ?></i> | </b>
	<b id="welcome"><i><?php echo $user_check; ?></i></b>
	<br>
	<b id="logout"><a href="logout">Log Out</a></b>

	<h1>Entry Access</h1>
	
	<div>
		<form action="" method="post">
			<h2>Check entry to a performance you have booked</h2>
			<label>Enter your booking reference number to check if you are permissed:</label>
			<input name ="checkBooking" placeholder="Booking Number" type="text">
			<input name="submit_check" type="submit" value="Check">
		</form>
	</div>

</body>
</html>