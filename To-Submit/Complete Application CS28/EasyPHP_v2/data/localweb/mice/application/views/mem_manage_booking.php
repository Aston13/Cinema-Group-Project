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
		<?php include ("style1.css"); ?>					
    </style>


</head>
<body>
	<nav>
		<a href='<?php echo site_url('main/member_view')?>'>Home</a>
		<a href='<?php echo site_url('main/mem_film')?>'>Films</a>
		<a href='<?php echo site_url('main/mem_search_book')?>'>Search and Book</a>
		<a href='<?php echo site_url('main/mem_entry')?>'>Entry</a>
		<a href='<?php echo site_url('main/mem_manage_booking')?>'>Bookings</a>
		<a href='<?php echo site_url('main/mem_manage_account')?>'>Account</a>
		<a href='<?php echo site_url('main/mem_help')?>'>Help</a>
		<div class="animation start-booking"></div>	
	</nav>

	<div class = "welcome">
		<b>Welcome, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<a href="logout" class="logout-btn">Logout</a>
	</div>

	<h2 class = "mem-booking">Bookings Management</h2>
	<hr class= "main">
	
	<div class ="div-centre">
		<form action="" method="post">
			<h3>Cancel a booking</h3>
			<label>Enter your member ID number and booking number to cancel</label>
			<input name ="cancelBooking" value=<?php echo $user_check; ?> type="text">
			<input name ="bookingNo" placeholder="Booking Number" type="text">
			<input name="submit_cancel" type="submit" value="Cancel Booking">
			<br>
			<p class = "error"> <?php echo($error) ?> </p>
			<p class = "success"> <?php echo($success) ?> </p>		
		</form>
</div>
<hr class ="main">
<div class ="div-centre">
			<h3>Amend a booking</h3>
			<p>If you need to amend a booking, you must cancel your booking first and then make a new booking through <a href="mem_search_book" class="link-btn">search and book</a>.</p>
</div>
</body>
</html>