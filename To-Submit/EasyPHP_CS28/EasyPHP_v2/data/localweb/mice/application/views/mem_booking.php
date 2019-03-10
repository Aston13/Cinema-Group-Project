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
	<b id="welcome">Welcome, <i><?php echo $login_session; ?></i>!</b>
	<br>
	<b id="logout"><a href="logout">Log Out</a></b>

	<h1>Bookings</h1>
	
	<h2>Make a booking</h2>
	<label>Start by entering your member ID:</label>
		<input name ="newBooking" placeholder="Member ID" type="text">
	<br>

	<h2>Check a booking number</h2>
	<label>Enter your booking reference number:</label>
		<input name ="bookingRef" placeholder="Booking Number" type="text">

</body>
</html>