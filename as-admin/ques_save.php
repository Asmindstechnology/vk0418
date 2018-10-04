<?php
// Create connection
$db = mysqli_connect('localhost', 'root', '', 'as_benchmark');

$a = $_POST["question"];
$b = $_POST["option1"];
$c = $_POST["option2"];
$d = $_POST["option3"];
$e = $_POST["option4"];
$f = $_POST["answer"];
$g = $_POST["langtype"];
$h = $_POST["questype"];
$query = "INSERT INTO as_question( question, option1, option2, option3, option4,answer,language,question_type) VALUES('$a','$b','$c','$d','$e','$f','$g','$h')";

$result =mysqli_query($db, $query);
echo $result;exit;
$db->close();
?>

