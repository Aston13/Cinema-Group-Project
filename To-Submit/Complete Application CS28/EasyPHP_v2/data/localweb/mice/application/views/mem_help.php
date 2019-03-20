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
		<div class="animation start-help"></div>	
	</nav>
	
	<div class = "welcome">
		<b>Welcome, <?php echo $login_session; ?> | <?php echo $user_check; ?></b>
		<br>
		Today's date is <?php echo date("d/m/Y"); ?>
		<br>
		<a href="logout" class="logout-btn">Logout</a>
	</div>

	<h2 class="mem-help">Help</h2>
	<hr class= "main">

	<ul class = "help">
		<li><b class = "help">Search our list of films</b><br>Click on the 'Films'
		 	tab and click on the search button. If you want to narrow your search results,
			 you can use the filters by their provided description.
		</li>

		<li><b class = "help">Search performances and book</b><br>Click on the 'Search and Book'
			 tab and click on the search button to view all performances available. 
			 If you want to narrow your search results,
			 you can use the filters by their provided description.
			 <br><br>
			 Once you have the desired search results, you can make a booking by entering 
			 the number of seats you require in the text box, and clicking on the corresponding 'Book' button for the 
			 performance you would like to make a booking for.
		</li>

		<li><b class = "help">Check entry</b><br>To check if you have permission to enter a screen, first navigate 
		to the entry page by clicking on the 'Entry' tab. Enter the booking number for the booking you have made and click on 
		the 'check' button. The system will tell you if you are allowed to enter or not.
		</li>

		<li><b class = "help">Manage bookings</b><br>Click on the 'Bookings' tab to enter 
		bookings management. Here you can cancel a booking, enter/check your member ID number and the booking number 
		for the booking you would like to cancel. Then, click cancel booking to confirm your cancellation.
		<br><br>
		If you want to amend a booking, you must cancel your booking first by following the steps above. Then you can create a new booking 
		in 'Search and Book'.
		</li>

		<li><b class = "help">Manage account</b><br>Click on the 'Account' tab to enter 
		account management. To cancel your membership enter your password and click on the 
		'Cancel Membership' button to confirm.
		<br><br>
		If your password is correct and your membership is cancelled, your membership will be instantly revoked 
		and you will be logged out and redirected to the login screen. As a non-member, you will not be able to log back in to the system.
		</li>

		<li><b class = "help">Any problems?</b><br>Contact the cinema by phone if you are having 
		any technical problems using this website.
		</li>
	</ul>
</body>
</html>