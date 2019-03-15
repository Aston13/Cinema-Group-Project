<?php
	$error = ''; // Variable To Store Error Message 
	
	if (isset($_POST['search'])) {  
			// Define $variables
			$filmTitle = $_POST['filmTitle'];
			$director = $_POST['director'];
			$yearOfRelease = $_POST['yearOfRelease'];

			// mysqli_connect() function opens a new connection to the MySQL server. 
			$conn = mysqli_connect("localhost", "root", "", "mice"); 

			$tmpl = array ('table_open' => '<table class="mytable">');
			$this->table->set_template($tmpl); 
	
			$this->db->query('drop table if exists temp');
			
			$this->db->query("
			CREATE TEMPORARY TABLE temp AS 
			(
			SELECT
				`releaseYear` AS `Release Year`,
				`filmTitle` AS `Film`,
				`director` AS `Director`
			FROM
				`film` AS F
			WHERE 
				filmTitle LIKE '%$filmTitle%'
				AND releaseYear LIKE '%$yearOfRelease%'
				AND director LIKE '%$director%'
			ORDER BY
				filmTitle, director
			)");
			$returnedResults = mysql_result(mysql_query("SELECT COUNT(*) FROM temp"),0);
			
			if($returnedResults > 0){
				$query = $this->db->query('SELECT Film, Director, `Release Year` FROM temp;');
				echo $this->table->generate($query);
			} else {
				echo("Sorry, no results matched your criteria.");
			}

	}
	mysqli_close($conn); // Closing Connection 	
?>