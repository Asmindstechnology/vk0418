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