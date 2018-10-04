<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/bootstrap/js/popper.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/daterangepicker/moment.min.js"></script>
		<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="../vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="../js/main.js"></script>
	<!--===============================================================================================-->
		 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<script>
			$(document).ready(function(){
			 if(document.getElementById("adminlogin").value >0){
				
			window.location = "dashboard.php";
            
				 
			 }
		});
		
	
	</script>

	</head>
	<body>
	</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","","as_benchmark");

$res = mysqli_query($conn,"select * from as_admin where username = '".$_POST["username"]."' AND password = '".$_POST["pass"]."'");

$result = mysqli_num_rows($res);

while($row = mysqli_fetch_array($res)){
	$_SESSION["username"] = $row["username"];
	echo $_SESSION["username"];
}
header('Location: dashboard.php');
?>