<?php
session_start(); 
session_destroy(); // Destroying All Sessions 
//header('Location:); // Redirecting To Home Page
header('Location:http://localhost:8080/mice/index.php');
?>