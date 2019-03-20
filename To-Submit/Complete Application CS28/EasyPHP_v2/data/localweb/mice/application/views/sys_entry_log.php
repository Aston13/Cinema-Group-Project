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
	<title>Director | Entry Log</title>

    <style>
		<?php include ("style_staff.css"); ?>				
    </style>


</head>
<body>
<nav>
		<a href='<?php echo site_url('main/staff_view')?>'>Home</a>
		<a href='<?php echo site_url('main/sys_cinema')?>'>Cinema</a>
		<a href='<?php echo site_url('main/sys_screen')?>'>Screen</a>
		<a href='<?php echo site_url('main/sys_member')?>'>Member</a>
		<a href='<?php echo site_url('main/sys_film')?>'>Film</a>
        <a href='<?php echo site_url('main/sys_booking')?>'>Booking</a>
        <a href='<?php echo site_url('main/sys_performance')?>'>Performance</a>
        <a href='<?php echo site_url('main/sys_entry_log')?>'>Entry Log</a>
		<a href='<?php echo site_url('main/staff_help')?>'>Help</a>
		<div class="animation start-entry_log"></div>	
    </nav>

		<div class = "white">
    <div class = "welcome">
		<b>Welcome Director, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
        <a href="logout" class="logout-btn">Logout</a>
        <a href="member_view" class="logout-btn">View as: Member</a>
	</div>
</div>

	<h2 class = "staff-entry_log">View attempts made by members to enter screens</h2>
	<h3>Descending Order (Time)</h3>
	
	<div class = "white">
		
		<?php
		   	$lines = file("application/entry_logs.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
			$chunked = array_chunk($lines, 1);
			$reverse = array_reverse($chunked,true);
			echo '<pre>'; print_r($reverse); echo '</pre>';
		?>
		
	</div>
	
</body>
</html>