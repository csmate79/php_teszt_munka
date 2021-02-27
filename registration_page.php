<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-center">
			<form class="" method="post" name="" action="">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="uname" class="form-control" placeholder="Username">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="Email" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="Password" name="password" class="form-control" placeholder="Password">
				</div>
				<input class="btn btn-light" type="submit" name="submit" value="Sign up">
			</form>
		</div>
	</div>
</body>
</html>

<?php 
	$con = mysqli_connect('localhost','root','','registrations');
	if($con == false) {
		echo ('not success');
	}

	if (isset($_POST['submit'])) {
		$username = $_POST['uname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "insert into regtable(username,email,password) values('$username','$email','$password')" or die();

		if ($con->query($sql)===TRUE) {
			echo ('record added!');
		} else {
			echo "Error:" .$sql. "<br>". $con->error;
		}
	}

	$con->close();
?>