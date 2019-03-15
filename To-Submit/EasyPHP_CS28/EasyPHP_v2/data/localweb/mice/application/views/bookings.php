<?php
	// Define $variables
	$error = 'cant be left blank'; // Variable To Store Error Message
	$userMsg = '';
	$today = date("M,d,Y h:i:s A"); 
	// Connect to SQL Database
	$conn = mysqli_connect("localhost", "root", "", "mice");
	
	// Cancel booking
	if (isset($_POST['submit_cancel'])){
		$enteredID = $_POST['cancelBooking']; // Entered member number
		$bookingNo = $_POST['bookingNo']; // Entered booking number

		if ($enteredID == $user_check){ // Check that the entered ID matches the logged in user (confirmation purposes)
			$tmpl = array ('table_open' => '<table class="mytable">');
			$this->table->set_template($tmpl); 
			$this->db->query('drop table if exists temp');
	
			$this->db->query("
			CREATE TEMPORARY TABLE temp AS 
			(
			SELECT
				B.bookingNo, B.memberNo, P.perfDate, F.filmTitle, P.screenNo
			FROM
				booking AS B
			JOIN 
				performance AS P 
				ON B.perfNo = P.perfNo
			JOIN
				film AS F
				ON P.filmNo = F.filmNo
			WHERE
				B.memberNo = '$user_check'
				AND B.bookingNo = '$bookingNo'
			)");

			$bookingExist = mysql_result(mysql_query("SELECT COUNT(bookingNo) FROM temp"),0);
			if($bookingExist < 1){
				$userMsg = ("No bookings were found for the booking number <b>$bookingNo</b> under your account $user_check.");
			} else {
				$seatsCancel = mysql_result(mysql_query("SELECT seatsRequired FROM mice.booking WHERE bookingNo = $bookingNo"),0);
				$perfNoCancel = mysql_result(mysql_query("SELECT perfNo FROM mice.booking WHERE bookingNo = $bookingNo"),0);
				$seatsRemainCancel = mysql_result(mysql_query("SELECT seatsRemain FROM mice.performance WHERE perfNo = $perfNoCancel"),0);

				// Add cancelled seats back onto remaining seats for performance
				mysql_query("UPDATE `performance` SET `seatsRemain` = ($seatsRemainCancel+$seatsCancel) WHERE `perfNo` = $perfNoCancel;");
				// Delete booking from database
				mysql_query("DELETE FROM mice.booking WHERE bookingNo = $bookingNo");
				$dateRef = mysql_result(mysql_query("SELECT perfDate FROM temp"),0);
				$screenRef = mysql_result(mysql_query("SELECT screenNo FROM temp"),0);
				$filmRef = mysql_result(mysql_query("SELECT filmTitle FROM temp"),0);
				$userMsg = ("Your booking $bookingNo showing on screen $screenRef on $dateRef to watch $filmRef has been cancelled.");
			}
		} else {
			$userMsg = ("You do not have permission to cancel bookings for member $enteredID.");
		}
	}
	// Check booking details and permission to access screen
	else if(isset($_POST['submit_check'])){
		$checkBooking = $_POST['checkBooking']; // Entered booking number
		$tmpl = array ('table_open' => '<table class="mytable">');
		$this->table->set_template($tmpl); 
		$this->db->query('drop table if exists temp');

		// Extract required booking data using a query and set it in a temp table
		$this->db->query("
		CREATE TEMPORARY TABLE temp AS 
		(
		SELECT
			B.bookingNo, B.memberNo, P.perfDate, F.filmTitle, P.screenNo
		FROM
			booking AS B
		JOIN 
			performance AS P 
			ON B.perfNo = P.perfNo
		JOIN
			film AS F
			ON P.filmNo = F.filmNo
		WHERE
			B.memberNo = '$user_check'
			AND B.bookingNo = '$checkBooking'
		)");
		
		// Check if booking exists, if it does not, then the entered booking number is incorrect
		$bookingExist = mysql_result(mysql_query("SELECT COUNT(bookingNo) FROM temp"),0);
		if($bookingExist < 1){
			//permission denied - error message
			$userMsg = ("Permission denied. This booking number <b>$checkBooking</b> doesnt exist for your account $user_check.");
			
			//write failed attempt to entry_log.txt
			$myfile = fopen("application/entry_logs.txt", "a") or die("Unable to open file!");
			$txt = "'$today': Member '$user_check' failed to gain entry to booking #'$checkBooking'.";
			fwrite($myfile, "\r\n". $txt);
			fclose($myfile);

		} else{
			$dateRef = mysql_result(mysql_query("SELECT perfDate FROM temp"),0);
			$screenRef = mysql_result(mysql_query("SELECT screenNo FROM temp"),0);
			$filmRef = mysql_result(mysql_query("SELECT filmTitle FROM temp"),0);
			//permission granted
			$userMsg = ("Your booking number $checkBooking permits you to enter screen $screenRef on $dateRef to watch $filmRef.");
			
			//write granted attempt to entry_log.txt
			$myfile = fopen("application/entry_logs.txt", "a") or die("Unable to open file!");
			$txt = "'$today': Member '$user_check' was granted entry to booking #'$checkBooking'.";
			fwrite($myfile, "\r\n". $txt);
			fclose($myfile);
		}
	}

	else if(isset($_POST['submit_cancel_mem'])){
		$enteredPass = $_POST['cancelMembership'];
		$checkCredentials = mysql_result(mysql_query("SELECT password FROM member WHERE memberNo = $user_check"),0);
		if (($user_check) > 9500) {
			echo("staff can't cancel their own membership.");
		}
		else if (($checkCredentials) == ($enteredPass)){
			echo("cancelled");
			mysql_query("UPDATE member SET memberStat = 'Cancelled' WHERE memberNo = $user_check");
			session_start(); 
			session_destroy(); // Destroying All Sessions 
			//header('Location:); // Redirecting To Home Page
			header('Location:http://localhost:8080/mice/index.php');

		} else {
			echo("invalid password, please enter the correct password to cancel your membership");
		}
	}

	mysqli_close($conn); // Closing Connection 	
?>