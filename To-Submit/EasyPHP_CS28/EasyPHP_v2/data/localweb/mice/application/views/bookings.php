<?php
	// Define $variables
	$error = 'cant be left blank'; // Variable To Store Error Message 
	
	// Connect to SQL Database
	$conn = mysqli_connect("localhost", "root", "", "mice");
	
	// Make a new booking
	if (isset($_POST['submit_avail'])) {
		$cinemaNo = $_POST['cinema'];
		$startTime = $_POST['startTime'];
		$filmName = $_POST['filmName'];
		$exactDate = $_POST['exactDate'];
		$seatsRequired = $_POST['seatsRequired'];
		$screenNo = $_POST['screen'];
		
		$tmpl = array ('table_open' => '<table class="mytable">');
		$this->table->set_template($tmpl); 
		$this->db->query('drop table if exists temp');

		// Extract required booking data using a query and set it in a temp table
		// cinemaName as cinema, filmName, seatsRequired
		$this->db->query("
		CREATE TEMPORARY TABLE temp AS 
		(
		SELECT
			P.perfDate, P.startTime, C.cinemaName, F.filmTitle,
			S.price, S.numberOfSeats
		FROM
			performance AS P
		JOIN 
			film AS F 
			ON P.filmNo = F.filmNo
		JOIN
			cinema AS C
			ON P.cinemaNo = C.cinemaNo
		JOIN
			screen AS S
			ON S.screenNo = P.cinemaNo AND S.cinemaNo = P.screenNo
		WHERE
			S.numberOfSeats > '$seatsRequired'
			AND P.perfDate = '$exactDate'
			AND P.startTime = '$startTime'
			AND P.cinemaNo = '$cinemaNo'
			AND P.screenNo LIKE '$screenNo'
			AND F.filmTitle LIKE '%$filmName%'
		)");
		$availablePerformances = mysql_result(mysql_query("SELECT COUNT(perfDate) FROM temp"),0);

		if($availablePerformances > 0){
			$query = $this->db->query('SELECT * FROM temp;');
			echo $this->table->generate($query);
		} else {
			echo("Sorry no performances are available that match your criteria.
			 Please check our performances page to view listings.");
		}

	}

	// Cancel booking
	else if(isset($_POST['submit_cancel'])){
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
				echo("No bookings were found for the booking number <b>$bookingNo</b> under your account $user_check.");
			} else {
				mysql_query("DELETE FROM mice.booking WHERE bookingNo = $bookingNo");
				$dateRef = mysql_result(mysql_query("SELECT perfDate FROM temp"),0);
				$screenRef = mysql_result(mysql_query("SELECT screenNo FROM temp"),0);
				$filmRef = mysql_result(mysql_query("SELECT filmTitle FROM temp"),0);
				echo ("Your booking $bookingNo showing on screen $screenRef on $dateRef to watch $filmRef has been cancelled.");
			}
		} else {
			echo("You do not have permission to cancel bookings for member $enteredID.");
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
			echo("Permission denied. This booking number <b>$checkBooking</b> doesnt exist for your account $user_check.");
		} else{
			$dateRef = mysql_result(mysql_query("SELECT perfDate FROM temp"),0);
			$screenRef = mysql_result(mysql_query("SELECT screenNo FROM temp"),0);
			$filmRef = mysql_result(mysql_query("SELECT filmTitle FROM temp"),0);
			echo ("Your booking number $checkBooking permits you to enter screen $screenRef on $dateRef to watch $filmRef.");
		}
	}

	mysqli_close($conn); // Closing Connection 	

?>