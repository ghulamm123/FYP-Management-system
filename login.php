<?php

session_start();

if( isset($_SESSION['user_status']) ){
	header("Location: index.php");
}

require 'database.php';

if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['user_status']))
{	if ($_POST['user_status']=='teacher')
	{
		$records = $conn->prepare('SELECT id, username, password, committee FROM internals WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		if ($records->execute()){

			$results = $records->fetch(PDO::FETCH_ASSOC);

			if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

					$_SESSION['user_id'] = $results['id'];
					$_SESSION['username'] = $results['username'];
					$_SESSION['committee'] = $results['committee'];
					$_SESSION['user_status'] = $_POST['user_status'];
					header("Location: index.php");
			} else {
				$message = "Sorry, those credentials do not match";
			}

		} else {
			$message = "Some Error in query!";
		}
	}

	elseif ($_POST['user_status']=='student')
	{
		$records = $conn->prepare('SELECT id, username, password, internal_id FROM groups WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		if ($records->execute()){

			$results = $records->fetch(PDO::FETCH_ASSOC);

			if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

				$_SESSION['user_id'] = $results['id'];
				$_SESSION['username'] = $results['username'];
				$_SESSION['internal_id'] = $results['internal_id'];
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

	<h1>Login</h1>
	<span>or <a href="register_student.php">Group Register</a></span>
	<span>/ <a href="register_teacher.php">Teacher Register</a></span>

	<form action="login.php" method="POST">

		<input type="text" placeholder="username" name="username" required>
		<input type="password" placeholder="and password" name="password" required>
		<input type="radio" name="user_status" value="teacher" required> teacher
		<input type="radio" name="user_status" value="student" required> student <br><br>

		<input type="submit">

	</form>
	<?php echo $message;
	echo "<br> <a href='admin_login.php'>Admin?</a>";
	?>

</body>
</html>
