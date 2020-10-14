<!-- Insert Query -->
<?php
require "conn.php";

if(isset($_POST['btnsend'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];

	$sql="INSERT INTO user_data(email,name,subject,message,status) VALUES ('$email','$name','$subject','$message',0)";
	mysqli_query($conn, $sql);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sending email</title>
	<style>
		*{font-family: calibri}
		input{
			display: block;
			margin:3px;
		}
		input[type=submit]{
			display: inline;
		}
		span{
			color:red;
		}
	</style>
</head>
<body>
	<form action="" method="post" id="myform">
		<h2>Contact Us</h2>
		<h3>Please leave your email to get notification about every new items!</h3>
		<input type="text" name="name" placeholder="Enter your name">
		<input type="email" name="email" placeholder="Enter your gmail">
		<input type="text" name="subject" placeholder="Enter title">
		<label>Message:</label><br>
		<textarea name="message" name="message" cols="30" rows="5"></textarea><br>
		<input type="submit" name="btnsend" value="Send mail">
	</form>

<!-- unfinished count and message query -->
	<?php 
	// $status_sql=mysqli_query($conn,"SELECT * FROM user_data WHERE status=0");
	// $status_count=mysqli_num_rows($status_sql);

	if(isset($_POST	['btnsendmail'])){
		$email=$_POST['myemail'];
		$reply=$_POST['repliedtext'];
		
		if(mail($email,'Thanks for contact',$reply,'From: darkestblackqueen@gmail.com'))
		{
			$update_status=mysqli_query($conn,"UPDATE user_data SET status=1 WHERE email='$email'");
		}else{
			echo "no";
		}
	}
	?>
	<caption><h2>User's Mail </h2></caption>
	<table border="1px solid" cellpadding="3px">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Title</th>
			<th>Message</th>
			<th>Action</th>
		</thead>
		<tbody>
			
			
			<?php 
			$i=1;

			$rows=mysqli_query($conn,"SELECT * FROM user_data");
			$results=mysqli_fetch_all($rows);
				//print_r($results);
			foreach($results as $result):
				$username=$result[1];
				$useremail=$result[0];
				$usersubject=$result[2];
				$usermessage=$result[3];
				$status=$result[4];

				
				?>
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php echo $username?></td>
					<td><?php echo $useremail?></td>
					<td><?php echo $usersubject?></td>
					<td><?php echo $usermessage?></td>
					<td>
						<form action="" method="post" name="myform">
							<input type="hidden" name="myemail" value="<?php echo $useremail ?>">
							<textarea  name="repliedtext"></textarea>
							<input type="submit" name="btnsendmail" value="Reply" id="id<?php echo $useremail ?>">
							<span><?php if($status==1) echo "* finished" ?></span>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
</body>
</html>