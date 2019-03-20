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
	<title>Director | Help</title>

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
		<div class="animation start-help"></div>	
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

	<h2 class="staff-help">Help</h2>
	<hr class= "main">
<div class = "white">
	<ul class = "help">
		<li><b class = "help">Table Management</b><br>Tables can be directly accessed by clicking on the 
		relevant tab in the navigation bar (e.g. CINEMA tab will display the cinema table).
		<br><br>
		Once a table you want to view or modify is displayed, you can perform a number of functions within this application:
		<br><br>
		◘ To modify a row of data, simply click <b>edit</b> on the right hand side.
		<br>
		◘ To permanently delete a row of data, simply click <b>delete</b> on the right hand side.
		<br>
		◘ To view a single row in greater detail, simply click <b>view</b> on the right hand side.
		<br>
		◘ To add a row of data, simply click <b>Add <></b> on the top left hand side, which will take you to an add wizard.	
		<br>
		◘ To filter out the rows displayed in the table, you can use many of the text boxes at the top right, and along
		the bottom of the table. Filters can be cleared by clicking on <b>Clear filtering</b> at the bottom right corner.
	</li>

		<li><b class = "help">Entry Log</b><br>To view the attempted entries log, navigate 
		to the page by clicking on the 'Entry Log' tab.
			 <br><br>
		The log is in descending order so the most recent attempt is shown at the top of the page. 
		To find the entry log .txt file, open up file explorer on your pc and navigate to this file path: 
		EasyPHP_CS28\EasyPHP_v2\data\localweb\mice\application\entry_logs.txt
		</li>

		<li><b class = "help">Member View</b><br>
		Member view is a button underneath the logout button, in the top right of any page. By clicking this
		 button it will allow you to view the members' system as they do. To get back into the directors portal after 
		 you have used this feature, you must log out via the members portal and log back in as normal.
		</li>
	</ul>
</div>

</body>
</html>