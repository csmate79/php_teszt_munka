<?php 
$con = mysqli_connect('localhost','root','','registrations');

if (isset($_POST['uname'])) {
	$uname = $_POST['uname'];
	$pw = $_POST['password'];

	$sql = "select * from regtable where username='".$uname."' AND password='".$pw."' limit 1";

	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) == 1) {
		echo "Successful... redirecting to front page.";
		header("refresh:2;url=page.php");
	} else {
		echo "unsuccessfuly.. redirecting to front page.";
		header("refresh:2;url=index.php");
	}
}
?>