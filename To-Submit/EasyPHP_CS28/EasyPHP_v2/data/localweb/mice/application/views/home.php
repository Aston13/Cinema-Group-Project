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
        h1 {
            text-align: center;
            font-family: Calibri;
        }
        p.p-centre {
            text-align: center;
            font-family: Arial;
        }
        .buttons {
          display: flex;
          justify-content: center;
        }
    </style>
</head>

<body>
    <h1>Old 1940s Film Festival</h1>
    <p class="p-centre"><b>Login Portal</b></p>
    <p class="p-centre">Click below to login.</p>

    <div id="login">
        <h2>Login Form</h2>
            <form action="" method="post">
                <label>UserName :</label>
                <input id="name" name="username" placeholder="username" type="text">
                <label>Password :</label>
                <input id="password" name="password" placeholder="**********" type="password"><br><br>
                <input name="submit" type="submit" value=" Login ">
                <span><?php echo $error; ?></span>
            </form>
    </div>
</body>
</html>