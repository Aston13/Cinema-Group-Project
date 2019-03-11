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

	<h1>Bookings</h1>
	
	<div id="bookings">
    	<form action="" method="post">
			<h2>Make a booking</h2>
			<h3><label>Enter booking details:</label></h3>
			<br>
			<form action="" method="post">
                <label>Cinema:</label>
				<select name ="cinema">
					<option value ="%3">Rialto</option>
					<option value ="%1">Intu</option>
					<option value ="%2">Phoenix</option>
					<option value ="%4">Intimate</option>
				</select>
				<br>
				<label>Screen:</label>
				<!-- Required tags? -->
				<select name ="screen">
					<option value ="%1">1</option>
					<option value ="%2">2</option>
					<option value ="%3">3</option>
				</select>
				<br>
				<label>Film Name:</label>
				<input name ="filmName" placeholder="Film Name" type="text">
				<br>
				<label>Date:</label>
				<input type="date" name="exactDate" min=
					<?php echo date('Y-m-d'); ?>
				>
				<br>
				<label>Start Time:</label>
				<input type="time" name="startTime" min="00:00" max="24:00">
				<br>
				<label>Seats Required:</label>
				<select name ="seatsRequired">
					<option value ="%1">1</option>
					<option value ="%2">2</option>
					<option value ="%3">3</option>
					<option value ="%4">4</option>
					<option value ="%5">5</option>
					<option value ="%6">6</option>
					<option value ="%7">7</option>
					<option value ="%8">8</option>
					<option value ="%9">9</option>
					<option value ="%10">10</option>
				</select>
				<br>
				<input name="submit_avail" type="submit" value="Check Availability">
                
            </form>
			<br>

			<h2>Cancel a booking</h2>
			<label>Enter your member ID number and booking number to cancel</label>
			<input name ="cancelBooking" value=<?php echo $user_check; ?> type="text">
			<input name ="bookingNo" placeholder="Booking Number" type="text">
			<input name="submit_cancel" type="submit" value="Cancel Booking">
			<br>

			<h2>Check a booking number</h2>
			<label>Enter your booking reference number to check your bookings:</label>
			<input name ="checkBooking" placeholder="Booking Number" type="text">
			<input name="submit_check" type="submit" value="Go">

		</form>
	</div>

</body>
</html>