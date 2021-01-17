<?php

session_start();

if( isset($_SESSION['user_status']) ){
	header("Location: index.php");
}

require 'database.php';

if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['user_status']))
{	if ($_POST['user_status']=='admin')
	{
		$records = $conn->prepare('SELECT id, username, password FROM admin WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		if ($records->execute()){

			$results = $records->fetch(PDO::FETCH_ASSOC);

			if(count($results) > 0 && $_POST['password'] == $results['password'] ){ //password_verify($_POST['password'], $results['password']) ){

					$_SESSION['user_id'] = $results['id'];
					$_SESSION['username'] = $results['username'];
					$_SESSION['user_status'] = $_POST['user_status'];
					header("Location: index.php");
			} else {
				$message = "Sorry, those credentials do not match";
			}

		} else {
			$message = "Some Error in query!";
		}
	}

} else {
	$message = "All fields are required";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Below</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/">FYPMS</a>
	</div>

	<h1>Administrator Login</h1>
	<!--<span>or <a href="register.php">register here</a></span>-->

	<form action="admin_login.php" method="POST">

		<input type="text" placeholder="username" name="username" required>
		<input type="password" placeholder="and password" name="password" required> <br><br>

		<input type="submit" name="user_status" value="admin">

	</form>
	<?php echo $message;
	echo "<br> <a href='login.php'>Student/Teacher?</a>";
	?>

</body>
</html>
