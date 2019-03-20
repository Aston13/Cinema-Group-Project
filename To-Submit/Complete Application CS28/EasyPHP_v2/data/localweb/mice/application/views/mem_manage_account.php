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
		<div class="animation start-account"></div>	
	</nav>

	<div class = "welcome">
		<b>Welcome, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<a href="logout" class="logout-btn">Logout</a>
	</div>

	<h2 class = "mem-account">Account Management</h2>
	<hr class= "main">
	
	<div class ="div-centre">
		<form action="" method="post">
			<h3>Cancel your membership</h3>
			<p class ="warning">WARNING!: If you confirm your cancellation, your membership status will be revoked
			and you will be redirected to the login page.</p>
			<label>Enter your password to confirm your cancellation:</label>
			<input name ="cancelMembership" type="password" placeholder="**********">
			<input name="submit_cancel_mem" type="submit" value="Cancel Membership">
		</form>
	</div>
	<p class = "error"> <?php echo($error) ?> </p>
	<p class = "success"> <?php echo($success) ?> </p>

</body>
</html>