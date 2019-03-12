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
				(@row_number:=@row_number + 1) AS Row_Num
			FROM
				(SELECT @row_number:=0) AS t,
				performance AS A
			JOIN 
				film AS B 
				ON A.filmNo = B.filmNo
			JOIN
				cinema AS C
				ON A.cinemaNo = C.cinemaNo
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
			//$rowNumbers = mysql_result(mysql_query("SELECT (Row_Num) FROM temp"),0);
			
			if($returnedResults > 0){
				$query = $this->db->query('SELECT * FROM temp;');
				echo $this->table->generate($query);
				echo("<form class ='resultbuttons' action='' method='post'>");
				echo("<b>Make a booking</b>");
				for ($i = 1; $i <= $returnedResults; $i++){
					echo("<input type='submit' id='submit' name='resultButton_$i' class='resultbutton' value='Book Now'>");
				}
				echo("</form>");
			} else {
				echo("Sorry, no results matched your criteria.");
			}

	}

	else if (isset($_POST['resultButton'])){
		echo("<b>not equal to search</b>");
		 
		//$name = "submit,1";
		//$array = explode(',', $name);
		//print_r($array[1]);
		// Define $variables
		//echo($selectedButtonNo);
		//$selectedButtonNo = $_POST['resultbutton'];
		//$query = $this->db->query("SELECT Cinema, Date, Time, Film, Screen FROM temp WHERE Row_Num = '$selectedButtonNo'");
		//echo $this->table->generate($query);
		
	}
	mysqli_close($conn); // Closing Connection 	
?>