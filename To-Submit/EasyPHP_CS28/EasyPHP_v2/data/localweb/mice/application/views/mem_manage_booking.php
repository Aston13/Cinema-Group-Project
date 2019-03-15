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

	<h1>Bookings Management</h1>
	
	<div>
		<form action="" method="post">
			<h2>Cancel a booking</h2>
			<label>Enter your member ID number and booking number to cancel</label>
			<input name ="cancelBooking" value=<?php echo $user_check; ?> type="text">
			<input name ="bookingNo" placeholder="Booking Number" type="text">
			<input name="submit_cancel" type="submit" value="Cancel Booking">
			<br>		
		</form>
			<h2>Amend a booking</h2>
			<p>If you need to amend a booking, you must cancel your booking first and then make a new booking through <a href="mem_search_book">search and book</a>.</p>
	</div>

</body>
</html>