<?php
  session_start(); 
if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		unset($_SESSION["mark"]) ;
		unset($_SESSION["total"]);
		unset($_SESSION["minutes"]);
		header("location:  index.php");
  }
?>