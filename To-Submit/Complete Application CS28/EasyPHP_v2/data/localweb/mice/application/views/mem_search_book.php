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
		<div class="animation start-search"></div>	
	</nav>

	<div class = "welcome">
		<b>Welcome, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<a href="logout" class="logout-btn">Logout</a>
	</div>
	
	
	<h2 class = "mem-search">Search for Performances</h2>
			<!-- Display performances searched by: 
		filmName,
		 screenNo(via cinemaName),
		  startDate(== exact),
		   startTime(=>),
		    cinemaNo  
			-->

		<div id="query">
    	    <form action="" method="post">
				<input name ="location" placeholder="Location" type="text">

        
                <!-- <input id="name" name="username" placeholder="username" type="text"> --->
				<select name ="cinema">
					<option value ="%">Any Cinema</option>
					<option value ="%3">Rialto</option>
					<option value ="%1">Intu</option>
					<option value ="%2">Phoenix</option>
					<option value ="%4">Intimate</option>
				</select>

				<select name ="screen">
					<option value ="%">Any Screen</option>
					<option value ="%1">1</option>
					<option value ="%2">2</option>
					<option value ="%3">3</option>
				</select>


				<input name ="filmName" placeholder="Film Name" type="text">

				<label>Starts From:</label>
				<input type="time" name="startTime" min="00:00" max="24:00">

				<label>Date:</label>
				<input type="date" name="exactDate" min=
					<?php echo date('Y-m-d'); ?>
				>
				
				
				<input name="search" type="submit" value="Search">
                
            </form>
   		</div>
		<div class = "container"> 
			<?php include('query.php'); ?>
		</div>
		<p class = "error"> <?php echo($error) ?> </p>
		<p class = "success"> <?php echo($success) ?> </p>
</body>
</html>