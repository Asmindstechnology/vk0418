<?php 	session_start();
if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.php');
	  }
 ?>
<?php include "as-config.php";?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<style>
		#back{
			float:right;
			font-size:23px;
			right:4px;
		}
	</style>
	<script>
		function minutes(val){
			document.getElementById("test_time").value = val;
		}
		function func(val){
			var  question = document.getElementById("question").value;
			var  minutes = document.getElementById("minutes").value;
			var  result =  parseInt(question * val);
			document.getElementById("total").value = result;
		}
	
	function fun(){
		var question = document.getElementById("question").value;
		var mark = document.getElementById("mark").value;
		var result = parseInt(question * mark);
		document.getElementById("total").value = result;
	}
	</script>
</head>
<body onload="fun()">

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    BenchMark Academy
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profiles</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                         <i class="pe-7s-news-paper"></i>
                        <p>Create Package</p>
                    </a>
                </li>
                <li>
                    <a href="typography.php">
						 <i class="pe-7s-note2"></i>
                        <p>Set Questions</p>
                    </a>
                </li>
                <li>
                    <a href="icons.php">
                        <i class="pe-7s-trash"></i>
                        <p>Delete Questions</p>
                    </a>
                </li>
                <li>
                    <a href="maps.php">
                        <i class="pe-7s-cash"></i>
                        <p>Package Attributes</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.php">
                        <i class="pe-7s-bell"></i>
                        <p>About Package</p>
                    </a>
                </li>
				<li>
                    <a href="logout.php?logout=1">
                        <i class="pe-7s-power"></i>
                        <p>Log out</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>

    <div class="main-panel">

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="header">
								<h3><?php 
									if(isset($_POST["settest_qusetions"])){
										$_SESSION['test_name'] = $_POST["settest_qusetions"];
									}
									echo '<strong>'."Add  Question For The Test ".$_SESSION['test_name'].':'; ?></strong></h3>
							</div>
                            
                            <div class="content table-responsive table-full-width">
								<form action="as-package.php" method="post">
								<div class="row">
									
										<div class="col-md-12">
											<div class="col-md-3">
												<?php
													
														$sql = "SELECT * FROM `as_question` WHERE `subpackage` = '".$_SESSION['test_name']."'";
														$result = mysqli_query($conn,$sql);
														$res = mysqli_num_rows($result);
														?><input type="hidden" name="val" id="val" value=<?php echo $res;?>>
														<p>No.of.Quest:<?php echo $_SESSION['test_name'];?></p>
														<input type="text" class="form-control col-md-2" value="<?php echo $res?>" name="question" id="question"  readonly >
											</div>
											<div class="col-md-3">
												<?php
													$sql = "SELECT * FROM `as_test` WHERE `test_name` = '".$_SESSION['test_name']."'";
													$result = $conn->query($sql);
													if(mysqli_num_rows($result) > 0){
														while($row = $result->fetch_assoc()) {
															$_SESSION["mark"] = $row["test_mark"];
															$_SESSION["total"] = $row["total_mark"];
															$_SESSION["minutes"] = $row["test_time"];
													}}
														else
														{
															$_SESSION["mark"] = '0';
															$_SESSION["total"] = '0';
															$_SESSION["minutes"] = '0';
															
														}
													
														?>	
													
												<p>Each Question Mark:</p>
												<input type="text" class="form-control col-md-2" id="mark" name="mark" onblur="func(this.value)" value="<?php echo $_SESSION["mark"];?>">
											</div>
											<div class="col-md-2">
												<p>Mark:</p>
												<input type="text" class="form-control col-md-2" id="total" name="total" value="<?php echo $_SESSION["total"]; ?>" id="total" readonly >
											</div>
											<div class="col-md-2">
												<p>Time Set in Minutes:</p>
												<input type="text" class="form-control" name="minutes" id="minutes" value="<?php echo $_SESSION["minutes"]; ?>" onblur="minutes(this.value)">
											</div>
											
											<div class="col-md-2">
												<p style="visibility:hidden">Time Set in Minutes:</p>
												<input type="hidden" name="subpackage"value=<?php echo $_SESSION['test_name'];?>>
												<input type="submit" class="btn btn-warning col-md-12" name="time_save" value="SAVE" >
											</div>
										
										
										</div>
										
									
									
								</div>
								
								</form>
									
									
								
							</div>
						</div>
					
					</div>
					<div class="col-md-12">
                        <div class="card">
							
                            
                            <div class="content table-responsive table-full-width">
								<div class="row">
									
									<div class="col-md-12">
										<div class="col-md-9">
											<p><strong>ADD QUESTIONS:</strong></p>
											<form action = "as-package.php" method = "post">
												<?php
												
													include  "as-config.php";
													
													
													$language = explode("-",$_SESSION['test_name']);	
													$package_test_question = "SELECT * FROM `as_question` WHERE `language` = '".$language[0]."' && `subpackage` = ''";
													$result = $conn->query($package_test_question);
														
														while($row = $result->fetch_assoc()) {
												?>
															<input type = "checkbox" name = "test[]" value = <?php echo $row["id"] ;?>>
												<?php 			echo $row['question']."<br>";
														}
												?>
												<input type = "hidden" name ="tese_name" value = <?php echo $_SESSION['test_name']; ?>>
												<br/>
												<input type = "submit" name = "add_question" value = "Add Qusetions" class="btn btn-success col-md-2" >
												<a href="as-test.php"><input type = "button" value = "Back" class="btn btn-primary col-md-2" ></a>
											</form>
										</div>
									</div>
								</div>
								
						
								
								
								
								
									
								
							</div>
						</div>
					
					</div>
					
					
				</div>
				

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>


    </div>
	
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
	
	


</html>

