<?php
	$error = ''; // Variable To Store Error Message 

	if (isset($_POST['submit'])) {  
			// Define $variables
			$cinemaNo = $_POST['cinema'];
			$screenNo = $_POST['screen'];
			$startTime = $_POST['startTime'];
			$filmName = $_POST['filmName'];
			$exactDate = $_POST['exactDate'];
		
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
				B.filmTitle AS Film
			FROM
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
			ORDER BY
				A.perfDate ASC, A.startTime ASC
			)");
			$query = $this->db->query('SELECT * FROM temp;');
			echo $this->table->generate($query);

			mysqli_close($conn); // Closing Connection 	
	}
?>