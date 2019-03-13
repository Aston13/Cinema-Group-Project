<?php
	$error = ''; // Variable To Store Error Message 
	

	if (isset($_POST['search'])) {  
			// Define $variables
			$cinemaNo = $_POST['cinema'];
			$screenNo = $_POST['screen'];
			$startTime = $_POST['startTime'];
			$filmName = $_POST['filmName'];
			$exactDate = $_POST['exactDate'];
			$location = $_POST['location'];

			// mysqli_connect() function opens a new connection to the MySQL server. 
			$conn = mysqli_connect("localhost", "root", "", "mice"); 

			$tmpl = array ('table_open' => '<table class="mytable">');
			$this->table->set_template($tmpl); 
	
			$this->db->query('drop table if exists temp');
			
			$this->db->query("
			CREATE TEMPORARY TABLE temp AS 
			(
			SELECT
				DATE_FORMAT(A.perfDate, '%D %M %Y') AS Date, TIME_FORMAT(A.startTime, '%H:%i') AS Time, 
				C.cinemaName AS Cinema, A.screenNo AS Screen,
				B.filmTitle AS Film, C.location AS Location,
				(@row_number:=@row_number + 1) AS Row_Num, A.perfNo AS perfNo,
				C.cinemaNo AS CinemaNo, S.price AS price, A.seatsRemain AS Seats
			FROM
				(SELECT @row_number:=0) AS t,
				performance AS A
			JOIN 
				film AS B 
				ON A.filmNo = B.filmNo
			JOIN
				cinema AS C
				ON A.cinemaNo = C.cinemaNo
			JOIN
				screen AS S
				ON A.screenNo = S.screenNo
				AND A.cinemaNo = S.cinemaNo
			WHERE 
				A.cinemaNo LIKE '$cinemaNo'
				AND A.screenNo LIKE '$screenNo'
				AND B.filmTitle LIKE '%$filmName%'
				AND A.startTime > '$startTime%'
				AND A.perfDate LIKE '%$exactDate%'
				AND C.location LIKE '$location%'
			ORDER BY
				Row_Num, A.perfDate ASC, A.startTime ASC
			)");
			$returnedResults = mysql_result(mysql_query("SELECT COUNT(Row_Num) FROM temp"),0);
			
			if($returnedResults > 0){
				$query = $this->db->query('SELECT Date, Time, Cinema, Screen, Film, Location, Seats, Price FROM temp;');
				echo $this->table->generate($query);
				echo("<form class ='resultbuttons' action='' method='post'>");
				echo("<b>Seats Required: </b>");
				echo("<input type='number' name='seatsRequired'
				min='1' max='66'>");
				for ($i = 1; $i <= $returnedResults; $i++){
					echo("<input type='submit' name ='resultButton' class='resultbutton' value='Book Result $i'>");
				}

				echo("</form>");
			} else {
				echo("Sorry, no results matched your criteria.");
			}

	}

	else if (isset($_POST['resultButton'])) {
		$seatsRequired = ($_POST['seatsRequired']);
		if (($seatsRequired) > 0){
			// retrieve selected row number
			$value = substr(($_POST['resultButton']),12,3);
			$remainingSeats = mysql_result(mysql_query("SELECT Seats FROM temp WHERE Row_Num = $value"),0);
			if ($seatsRequired <= $remainingSeats){
  
				// retrieve selected Date as string
				$selectedBookingDate = mysql_result(mysql_query("SELECT Date FROM temp WHERE Row_Num = $value"),0);
				// retrieve selected performance number
				$selectedBookingPerfNo = mysql_result(mysql_query("SELECT perfNo FROM temp WHERE Row_Num = $value"),0);
				// retrieve seat price for selection
				$seatPrice = mysql_result(mysql_query("SELECT Price FROM temp WHERE Row_Num = $value"),0);
				// converted Date string into time, and then into date format
				$time = strtotime($selectedBookingDate);
				$newformat = date('Y-m-d',$time);
				// Calculate total price of booking (seats)
				$totalPrice = ($seatPrice*$seatsRequired);

				// insert values for selected booking performance
				mysql_query("INSERT INTO `booking` (`memberNo`,`seatsRequired`,`bookingDate`,`perfNo`,`totalPrice`) VALUES ('$user_check','$seatsRequired','$newformat','$selectedBookingPerfNo','$totalPrice')");
				mysql_query("UPDATE `performance` SET `seatsRemain` = ($remainingSeats-$seatsRequired) WHERE `perfNo` = $selectedBookingPerfNo;");
				$bookingNo = mysql_result(mysql_query("SELECT bookingNo FROM booking WHERE perfNo = '$selectedBookingPerfNo' AND memberNo = '$user_check' AND bookingDate = '$newformat'"),0);
				echo("Your booking of $seatsRequired seats to watch a performance on the $selectedBookingDate is complete, your booking reference number is #$bookingNo.
				 Your payment method has been charged $$totalPrice.");
			} else {
				echo("Can't book $seatsRequired seats. Only $remainingSeats seats remain for this performance. Please try again with less.");
			}
		}
	}
	mysqli_close($conn); // Closing Connection 	
?>