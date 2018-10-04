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

</head>
<body>

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
                                <h4 class="title"><u><strong>Package Information:</strong></u></h4>
                            </div>
							<div class="content">
								<form method="post" action="notifications.php" enctype="multipart/form-data">
									<div class="form-group row">
										<div class="col-md-12">
											
										
										<div class=" col-md-offset-3 col-md-5">	
											<?php
											$res = mysqli_query($conn,"select package_name from as_package");
												if (mysqli_num_rows($res) >  0){ 
												?><select class="form-control" name="package-name" id="package-name" onchange="myFunction(this.value)">
												<option value="1">Select Package</option>
												<?php
												while($row = mysqli_fetch_array($res))
												{
												?>
												<option value="<?php  echo  $row["package_name"];?>"  ><?php echo $row["package_name"]; ?></option>
												<?php
												}
												}
												else{
													echo '<h3>Package is not available.First create the package after set the Question<h3>';
												}
											?>
											</select>
											</div>
											<div class="col-md-3">
												<input type="submit"  value = "Search Package Info" class="form-control btn btn-info" name="package_info">
												
											</div>
										</div>
									</div>
									
									
								</form>
							</div>
						</div>
						
						<div class="card">
							<div class="header">
								<?php
									if(isset($_POST["package-name"])){
										
										$_SESSION["packagename-info"] = $_POST["package-name"];
									
									?>
								<h5 class="title"><u><strong>Package: <?php if(isset($_POST["package-name"])){ echo $_SESSION["packagename-info"]; } ;?></strong></u></h5>
							</div>
							<div class="content">
								<div class="form-group row">
									<div class="col-md-12">
										<div class ="col-md-8">
											<?php
												
									
												$res = mysqli_query($conn,"SELECT * FROM as_package WHERE package_name='".$_SESSION["packagename-info"]."'");
												$result = mysqli_fetch_array($res);
												
												?>
												
												<table class="table">
													<tr><td><strong>Package Id: </strong></td><td><?php echo $result["id"]; ?></td></tr>
													<tr><td><strong>Package Name : </strong></td><td><?php echo $result["package_name"];; ?></td></tr>
													<tr><td><strong>Package Amount : </strong></td><td><?php echo $result["amount"];; ?></td></tr>
													<tr><td><strong>Package Description : </strong></td><td><?php echo $result["description"];; ?></td></tr>
												
												<?php
													$sql = mysqli_query($conn,"SELECT * FROM as_subpackage WHERE package='".$_SESSION["packagename-info"]."'");
													$i=1;
														while($fetch = mysqli_fetch_array($sql)){?>
														
														<tr><td><strong>sub-package Name <?php echo $i++;?> : </strong></td><td><?php echo $fetch["subpackage"]; ?></td></tr><br/>
												<?php }
												?>
											</table>
												
										</div>
										<div class="col-md-4">
											<?php echo '<img src = "data:image/jpeg;base64,'.base64_encode($result["image"]).'"width= "200" height ="150" alt="image not set">'; ?>
										</div>
									<?php } ?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

    <script>
        $().ready(function(){
            demo.initGoogleMaps();
        });
    </script>

</html>
