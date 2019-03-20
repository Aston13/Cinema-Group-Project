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
	<title>Member | Film</title>

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
		<div class="animation start-film"></div>	
	</nav>

	<div class = "welcome">
		<b>Welcome, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<a href="logout" class="logout-btn">Logout</a>
	</div>

	<h2 class = "mem-film">Film List</h2>
	<div id="query">
    	    <form action="" method="post">
				
				<input name ="filmTitle" placeholder="Film Title" type="text">
				<input name ="director" placeholder="Director's Name" type="text">
				<input name="yearOfRelease" type="year" placeholder="Release Year">
				
				<input name="search" type="submit" value="Search">
            </form>
   		</div>

		<div class = "container"> 
			<?php include('mem_film_query.php'); ?>
			<p class = "error"> <?php echo($error) ?> </p>
		</div>
		
</body>
</html>