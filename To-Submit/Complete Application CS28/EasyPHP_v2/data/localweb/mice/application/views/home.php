<?php
    session_start(); 
    session_destroy(); //destroy existing sessions, e.g. log out anyone left logged in

    include('login.php'); // Includes Login Script
    if(isset($_SESSION['login_user'])){
        site_url('./index.php/main/staff_view'); // Redirecting To staff page
    }
?> 

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Cinema System</title>
    <style>
		<?php include ("style1.css"); ?>				
    </style>
</head>

<body>
    <h1 class = "h1-login">Old 1940s Film Festival</h1>


    <ul class="login">
        
        <form action="" method="post">
            
                <h2>Login</h2>
            
            <li> 
                <label>Username:</label>
                <input id="name" name="username" placeholder="Username" type="text">
            </li>
            <li>
                <label>Password:</label>
                <input id="password" name="password" placeholder="**********" type="password">
            </li>
            <li>
                <input name="submit" type="submit" value=" Login ">
            </li>
        </form>
    </ul>
    <p class = "error"> <?php echo($error) ?> </p>
</body>
</html>