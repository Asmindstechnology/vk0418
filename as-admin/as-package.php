<?php
  session_start(); 
	// This condition is used to check session, admin is signin or not
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.php');
	  }
	
	include  "as-config.php";
	
	// This codition is used to create package
	if(isset($_POST["packagename"])){
			$packagename = strtoupper($_POST["packagename"]);
			if(empty($packagename)){
				header('Location: table.php');
			}else{
			$sql = "INSERT INTO `as_package` (`package_name`)
					VALUES ('".$packagename."')";
					
					if ($conn->query($sql) === FALSE) {
						    echo "<br>Error: " . $sql . "<br>" . $conn->error;
					}header('Location: table.php');
			}
	}

	// This codition is used to delete package	
	if(isset($_POST["Delete"])){
			$delete_package = "DELETE FROM `as_package` WHERE `package_name` ='".$_POST["delete_pack"]."'";
			$delete_package_question = "DELETE FROM `as_question` WHERE `language` ='".$_POST["delete_pack"]."'";
			$delete_test_package = "DELETE as_subpackage, as_test FROM as_subpackage INNER JOIN as_test ON as_subpackage.package = as_test.package_name WHERE as_subpackage.package = '".$_POST["delete_pack"]."'";
			
			if ($conn->query($delete_test_package) === FALSE) {
				echo "Error deleting test package record: " . $conn->error;
			}
			if ($conn->query($delete_package) === FALSE) {
				echo "Error deleting package record: " . $conn->error;
			}
			if ($conn->query($delete_package_question) === FALSE) {
				echo "Error deleting package record: " . $conn->error;
			}header('Location: table.php');
			
	}
	
	//This  condition is used to create subpackage
	if(isset($_POST["create_test"])){
			$test_name = $_POST["test_name"];
			if(empty($test_name)){
				header('Location: as-test.php');
			}else{
			$create_test = "INSERT INTO `as_subpackage` (`subpackage` , `package`)
					VALUES ('".$_POST["test_package_name"]."-".$_POST["test_name"]."' ,'".$_POST["test_package_name"]."' )";
					
					if ($conn->query($create_test) === FALSE) {
						    echo "<br>Error: " . $sql . "<br>" . $conn->error;
					}header('Location: as-test.php');
			}
	}

	// This codition is used to delete subpackage	
	if(isset($_POST["Delete_test"])){
			$delete_test = "DELETE FROM `as_subpackage` WHERE `subpackage` ='".$_POST["delete_test_name"]."'";
			$delete_atest = "DELETE FROM `as_test` WHERE `test_name` ='".$_POST["delete_test_name"]."'";
			$delete_question = "UPDATE `as_question` SET `subpackage` = ' ' WHERE `subpackage` = '".$_POST["delete_test_name"]."'";

			
			if ($conn->query($delete_test) === FALSE) {
				echo "Error deleting record: " . $conn->error;
			}
			if ($conn->query($delete_atest) === FALSE) {
				echo "Error deleting record: " . $conn->error;
			}
			if ($conn->query($delete_question) === FALSE) {
				echo "Error deleting package record: " . $conn->error;
			}header('Location: as-test.php');
			
	}
	
	//This Condition is use to add test question
	if(isset($_POST['add_question'])){
		foreach($_POST['test'] as $test){
			$add_question = "UPDATE `as_question` SET `subpackage` = '".$_POST["tese_name"]."' WHERE `id` = '".$test."'";
			
			if (mysqli_query($conn, $add_question)) {
				header('Location: as-setquestion.php');
			} else {
				header('Location: as-setquestion.php');
				echo "Error updating record: " . mysqli_error($conn);exit;
			}
		header('Location: as-setquestion.php');			
		}		
		header('Location: as-setquestion.php');	
	}
	//This condition is used to update the test time,mark and number of questions.
	if(isset($_POST["time_save"])){
		//print_r($_POST["subpackage"]);exit;
		$package = explode("-",$_POST["subpackage"]);
		$package_name = $package[0];
		$sql = "SELECT * FROM `as_test` WHERE test_name = '".$_POST["subpackage"]."'";
		$result = mysqli_query($conn,$sql);
		$res = mysqli_num_rows($result);
		
		if($res > 0){
			$create_test = "UPDATE `as_test` SET `test_time` = '".$_POST["minutes"]."',`total_questions` = '".$_POST["question"]."',`test_mark` = '".$_POST["mark"]."',`total_mark` = '".$_POST["total"]."',`package_name` = '".$package_name."'  WHERE `test_name` = '".$_POST["subpackage"]."'";
		}else{
			$create_test = "INSERT INTO `as_test` (`test_name` , `test_time`, `total_questions`, `test_mark`,`total_mark`,`package_name`)
					VALUES ('".$_POST["subpackage"]."' ,'".$_POST["minutes"]."','".$_POST["question"]."','".$_POST["mark"]."' ,'".$_POST["total"]."','".$package_name."')";
		}	
					if ($conn->query($create_test) === FALSE) {
						    echo "<br>Error: " . $sql . "<br>" . $conn->error;
					}header('Location: as-setquestion.php');
	}
	//This condition is used to delete the questions from package
	if(isset($_POST['delete_question'])){
	
		foreach($_POST['test'] as $test){
			$add_question = "DELETE FROM `as_question` WHERE id='".$test."'";
			if (mysqli_query($conn, $add_question)) {
				header('Location: as-deleteques.php');
			} else {
				header('Location: as-deleteques.php');
				echo "Error updating record: " . mysqli_error($conn);exit;
			}
		header('Location: as-deleteques.php');			
		}		
		header('Location: as-deleteques.php');	
	}
	//This condition is used to delete the questions from sub-package
	if(isset($_POST['deletesub_question'])){
		if(empty($_POST['test'])){
			header('Location: as-subquesdelete.php');
		}else{
			
			foreach($_POST['test'] as $test){
				$add_question = "DELETE FROM `as_question` WHERE id='".$test."'";
				if (mysqli_query($conn, $add_question)) {
					header('Location: as-subquesdelete.php');
				} else {
					header('Location: as-subquesdelete.php');
					echo "Error updating record: " . mysqli_error($conn);exit;
				}
			}		
			header('Location: as-subquesdelete.php');
		}
	}
	//This condition is used to remove the questions from sub-package and added to package
	if(isset($_POST['removesub_question'])){
		
		if(empty($_POST['test'])){
			header('Location: as-subquesdelete.php');
		}else{
			foreach($_POST['test'] as $test){
				$remove_question = "UPDATE `as_question` SET `subpackage` = ' ' WHERE `id` = '".$test."'";
				
				
				if (mysqli_query($conn, $remove_question)) {
					
				} else {
					header('Location: as-subquesdelete.php');
					echo "Error updating record: " . mysqli_error($conn);exit;
				}
			
			}
			$result = mysqli_query($conn,"SELECT subpackage FROM  `as_question` WHERE subpackage = '".$_POST["subpackage"]."'");
			$num_rows = mysqli_num_rows($result);	
			$mark = mysqli_query($conn,"SELECT test_mark,total_mark FROM as_test WHERE test_name = '".$_POST["subpackage"]."' ");
			$row = mysqli_fetch_array($mark);
			$total_mark = $num_rows * $row['test_mark'];
			$sql = mysqli_query($conn,"UPDATE `as_test` SET `total_questions` = '".$num_rows."',`total_mark` = '".$total_mark."' WHERE `test_name` = '".$_POST["subpackage"]."'");
			header('Location: as-subquesdelete.php');
		}
		
	}
	
//This condition is used to insert the package attributes
	if(isset($_POST['save-packageattribute'])){
	
		$tmp =  addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		$sql = mysqli_query($conn,"UPDATE `as_package` SET `amount` = '".$_POST['package-amount']."',`image` = '".$tmp."',`description` = '".$_POST["package-description"]."' WHERE `package_name` = '".$_POST["package-name"]."'");
		header('Location: maps.php');
	}
