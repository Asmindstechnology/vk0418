<?php
$conn = mysqli_connect("localhost","root","","as_benchmark");
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Set Question</title>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<script src="../bootstrap/jquery/3.3.1/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			
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
				if(question==''|| answer==''|| questype == '1')
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
					alert(result);
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
						document.getElementById("ques_type").value = '';
								
						
				}
				}
				});
				}
			}
			function myFunction(val){
				 document.getElementById("temp").style.display = "block";
				 document.getElementById("ques_type").value = val;
				 document.getElementById("span").innerHTML = val;
				 if(val == 1){ 
				 document.getElementById("temp").style.display = "none";
				 }
			}
			function QuesFunc(val){
				if(val == "true"){
				swal('You can type correct option: if TRUE->T OR FALSE->F');
				document.getElementById("option").style.display = "none";				
				//document.getElementById("test").style.display = "block";							
				//document.getElementById("check").style.display = "none";							
				}
				else if(val == '1'){
					document.getElementById("check").style.display = "none";
				}
				else{
					swal('If any one option is correct, you can type the correct option: option1 => 1, option => 2, option3 => 3, option4 => 4');
					document.getElementById("option").style.display = "block";
					document.getElementById("test").style.display = "none";
					//document.getElementById("check").style.display = "block";
				}
				
			}
			//~ function correctOption(value){
			 
				//~ if(value==1){
					//~ swal('correct');
				//~ }else{
					//~ swal('wrong');
				//~ }
			//}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row col-md-offset-2">
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
			<br/>				
			<div id="temp" style="display:none">
			
				<form action ="" method="POST">
					<input  type="hidden" value="" id="ques_type" name="ques_type">
				<div class="row">
					<h3><strong>Set Questions:<span id="span"></span></strong></h3>
					<div class="col-md-6">
						<label for="question">Question:</label>
						<input type="text" id="question" name="question" class="form-control col-md-3">
						<br/><br/><br/><br/>
						<!-- <div id="test" style="display:none"><p><strong>TYPE CORRECT OPTION:</strong></p><p> TRUE -> 1 </p><p> FALSE -> 0 </p></div>-->
						<div class="row col-md-9" id="opt">
							<div id="option">
								<label for="option1">Option 1:</label>
								<input type="text" id="option1" name="option1" class="form-control col-md-3">
								<br/><br/>
								<label for="option2">Option 2:</label>
								<input type="text" id="option2" name="option2" class="form-control col-md-3">
								<br/><br/>
								<label for="option3">Option 3:</label>
				 				<input type="text" id="option3" name="option3" class="form-control col-md-3">
								<br/><br/>
								<label for="option4">Option 4:</label>
								<input type="text" id="option4" name="option4" class="form-control col-md-3">
							</div>
						<br/><br>
						<label for="answer">Correct Option:</label>
						<input type="text" id="answer" name="answer" class="form-control col-md-3" onkeypress="correctOption(this.value)">
						<br/><br/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-4">
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
<!--
						<div class="col-md-8" id="check" style="display:none">
							<div class="form-group">
								<strong><p>Type the Correct Answer:</p></strong>
									<ul>
										<li>option1 => option1</li>
										<li>option2 => option2</li>
										<li>option3 => option3</li>
										<li>option4 => option4</li>
									</ul>
							</div>
						</div>
						
-->
					</div>	
				</div>
				<br/>
				<div class="row col-md-6">		
					<input id="sat" onclick="func()" type="button" value="SAVE" class="btn  btn-success col-md-3">
					
				</div>
				
				</form>
				
			</div>
		</div>
		
		
		
	</body>
</html>
