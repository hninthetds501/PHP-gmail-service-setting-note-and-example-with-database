<!-- Insert Query -->
<?php
require "conn.php";

	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];

	$sql="INSERT INTO user_data(email,name,subject,message,status) VALUES ('$email','$name','$subject','$message',0)";
	$i=mysqli_query($conn, $sql);
	if($i){
		header("location:index.php");
	}
	else{
		echo $sql;
	}

?>
