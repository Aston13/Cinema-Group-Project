<?php
	session_start(); // Starting Session 
	$error = ''; // Variable To Store Error Message 

	if (isset($_POST['submit'])) { 
		if (empty($_POST['username']) || empty($_POST['password'])) { 
			$error = "Username or Password is invalid"; 
		} else { 
			// Define $username and $password 
			$username = $_POST['username']; 
			$password = $_POST['password']; 
			// mysqli_connect() function opens a new connection to the MySQL server. 
			$conn = mysqli_connect("localhost", "root", "", "mice"); 
			// SQL query to fetch information of registerd users and finds user match. 
			$query = "SELECT memberNo, password from member where memberNo=? AND password=? LIMIT 1"; 
			// To protect MySQL injection for Security purpose 
			$stmt = $conn->prepare($query); 
			echo($username);
			echo($password);
			$stmt->bind_param("ss", $username, $password); 
			$stmt->execute(); 
			$stmt->bind_result($username, $password); 
			$stmt->store_result(); 
			if($stmt->fetch()){ //fetching the contents of the row
				$_SESSION['login_user'] = $username; // Initializing Session 
				if($username >= 9501){
					header("location: ./index.php/main/staff_view"); // Redirecting To Staff Portal  
				}
				else {
					header("location: ./index.php/main/member_view"); // Redirecting To Member Portal
				}
			} else { 
				$error = "Username or Password is invalid"; 
			} 
			mysqli_close($conn); // Closing Connection 
		} 
	}
?>