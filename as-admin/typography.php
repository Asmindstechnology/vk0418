<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  
?>
<?php
$conn = mysqli_connect("localhost","root","","as_benchmark");
?>
<!DOCTYPE html>
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
		#pan{
		border:1px solid red;
		position:absolute;
		}
		
	</style>
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

    <div class="main-panel ">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>Set Questions:</strong></h4>
                            </div>
							<div class="content">
								<div class="row col-md-offset-3">
									<div class="row col-md-6">
										<strong>SELECT THE PACKAGE:</strong>
										<form name="form1" action="" method="post">
											<?php
											$res = mysqli_query($conn,"select package_name from as_package");
												if (mysqli_num_rows($res) >  0){ 
												?><select class="form-control" id="sel" onchange="myFunction(this.value)">
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
										</form>
									</div>
								</div>
								
								
								<div id="temp" style="display:none">
								<form action ="" method="POST">
								<input  type="hidden" value="" id="ques_type" name="ques_type">
								<div class="row">
									<u><h5><strong>PACKAGE:<span id="span"></span></strong></h5><u>
									<div class="col-md-6">
										<label for="question"><strong>Question:<strong></label>
										<input type="text" id="question" name="question" class="form-control col-md-4"><br/><br/>
											<div class="row col-md-offset-1 col-md-9" id="opt">
											<div id="test" style="display:none"><p>If you choose question-type: TRUE/FALSE</p><ul><li>TRUE => T</li><li>FALSE => F</li></ul></div>
												<div id="option" >
													<label for="option1"><strong>Option 1:</strong></label>
													<input type="text" id="option1" name="option1" class="form-control col-md-3"><br/><br/>
													
													<label for="option2"><strong>Option 2:</strong></label>
													<input type="text" id="option2" name="option2" class="form-control col-md-3"><br/><br/>
												
													<label for="option3"><strong>Option 3:</strong></label>
													<input type="text" id="option3" name="option3" class="form-control col-md-3"><br/><br/>
													
													<label for="option4"><strong>Option 4:</strong></label>
													<input type="text" id="option4" name="option4" class="form-control col-md-3"><br/><br/>
												</div>
												<div>
													<label for="answer"><strong>Correct Option:</strong></label>
													<input type="text" id="answer" name="answer" class="form-control col-md-3" onblur="correctOption(this.value)">
												</div>
												<br/><br/>
											</div>
									</div>
									<div class="col-md-2">
										<div class="col-md-12">
											<div class="form-group">
												<label for="questtype">Question Type:</label>
												<select class="form-control" id="questtype" name="select" onchange ="QuesFunc(this.value)">
													<option value="1">Select</option>
													<option value="radio">Radio Button</option>
													<option value="checkbox">Check Box</option>
													<option value="true">True/False</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4" id="chkbx" style="display:none">
										<div class="col-md-12">
											<p><u>Type the correct answer:</u></p>
											<p>If any one option is correct(radio or checkbox) , you can type the correct option:</p>
											<ul>
												<li>option1 => 1 </li>
												<li>option2 => 2 </li>
												<li>option3 => 3 </li>
												<li>option4 => 4 </li>
											</ul>
											<p><strong>Note:<strong>If multiple answers are correct in checkbox: </p>
											<p>you can type correct Option: 1,2 </p>
											<p>Not type correct option:2,1</p>
										</div>
										
									</div>
									
								</div>	
								
								<div class="row">
									<div class="col-md-6">
										<input id="sat" onclick="func()" type="button" value="SAVE" class="btn  btn-success col-md-offset-1 col-md-3 ">
									</div>
								</div>
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
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script >
		function func(){	
		
				var question = document.getElementById("question").value;
				var option1 = document.getElementById("option1").value;
				var option2 = document.getElementById("option2").value;
				var option3 = document.getElementById("option3").value;
				var option4 = document.getElementById("option4").value;
				var answer = document.getElementById("answer").value;
				var langtype = document.getElementById("ques_type").value;
				var e = document.getElementById("questtype");
				var questype = e.options[e.selectedIndex].value;
		
				// Returns successful data submission message when the entered information is stored in database.
				var request = 'question='+ question + '&option1='+ option1 + '&option2='+ option1 + '&option3='+ option3  + '&option4='+ option4  + '&answer='+ answer  + '&langtype='+ langtype  + '&questype='+ questype;
				if(question==''|| answer==''|| questype == '1' )
				{
				swal({
						  title: "Oops!",
						  text: "Please Fill All Fields!",
						  icon: "error",
						});
				}
				else
				{
				// AJAX Code To Submit Form.
				$.ajax({
				type: "POST",
				url: "ques_save.php",
				data: request,
				cache: false,
				success: function(result){
				if(result == 1){
					swal({
						   position: "top-end",
						  title: "Done!",
						  text: "Question with answers are saved successfully!",
						  icon: "success",
						  button: "success!",
						  
						});
						
						
						document.getElementById("question").value ='';
						document.getElementById("option1").value ='';
						document.getElementById("option2").value ='';
						document.getElementById("option3").value = '';
						document.getElementById("option4").value = '';
						document.getElementById("answer").value ='';
						//document.getElementById("ques_type").value = '';
								
						
				}
				}
				});
				}
			}
			function myFunction(val){
				 document.getElementById("temp").style.display = "block";
				 document.getElementById("ques_type").value = val;
				 document.getElementById("span").innerHTML = val.toUpperCase();;
				 if(val == 1){ 
				 document.getElementById("temp").style.display = "none";
				 }
			}
			function QuesFunc(val){
				if(val == "true"){
				//swal('You can type correct option: if TRUE->T OR FALSE->F');
				document.getElementById("option").style.display = "none";				
				document.getElementById("test").style.display = "block";							
				document.getElementById("chkbx").style.display = "none";							
				}
				else if(val == '1'){
					document.getElementById("test").style.display = "none";
					document.getElementById("chkbx").style.display = "none";
				}
				else{
					//swal('If any one option is correct, you can type the correct option: option1 => 1, option => 2, option3 => 3, option4 => 4');
					document.getElementById("chkbx").style.display = "block";
					document.getElementById("option").style.display = "block";
					document.getElementById("test").style.display = "none";
					
				}
				
			}
			function correctOption(val){
				//var mysplits = val.split(',').length;
				//alert(val[0]);
				//if(mysplits[0]> mysplits[1]){
					//alert("wrong");
			//	}
			}
			
	
	
	</script>

</html>
