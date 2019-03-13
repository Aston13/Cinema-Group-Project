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

	<h1>Account Management</h1>
	
	<div>
		<form action="" method="post">
			<h2>Cancel your membership</h2>
			<h3>If you confirm your cancellation, your membership status will be revoked
			and you will be redirected to the login page</h3>
			<label>Enter your password to confirm your cancellation:</label>
			<input name ="cancelMembership" type="password" placeholder="**********">
			<input name="submit_cancel_mem" type="submit" value="Cancel Membership">
		</form>
	</div>

</body>
</html>