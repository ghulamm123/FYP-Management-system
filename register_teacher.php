<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


if( isset($_SESSION['user_status']) ){
	header("Location: index.php");
}

require 'database.php';


if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fullname']) && !empty($_POST['designation']) && !empty($_POST['committee']))
{
	if ($_POST['password'] == $_POST['confirm_password']) {

		if ($_POST['committee'] == "no") {
			$committee = 0;

			// Enter the new user in the database
			$sql = "INSERT INTO internals (username, password, fullname, designation, committee) VALUES (:username, :password, :fullname, :designation, :committee)";
			$stmt = $conn->prepare($sql);
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':fullname', $_POST['fullname']);
			$stmt->bindParam(':designation', $_POST['designation']);
			$stmt->bindParam(':committee', $committee);

			if( $stmt->execute() ){

				$records = $conn->prepare('SELECT id, username, password, committee FROM internals WHERE username = :username');
				$records->bindParam(':username', $_POST['username']);
				$records->execute();

				$results = $records->fetch(PDO::FETCH_ASSOC);

				if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

					$_SESSION['user_id'] = $results['id'];
					$_SESSION['username'] = $results['username'];
					$_SESSION['committee'] = $results['committee'];
					$_SESSION['user_status'] = 'teacher';
					header("Location: index.php");
				}

			} else {
				$message = "Sorry there must have been an issue creating your account";
			}
		}

		elseif ($_POST['committee'] == "yes") {

				$max_committee = $conn->prepare('SELECT MAX(committee) AS maximum FROM internals');
				$max_committee->execute();
				$max = $max_committee->fetch(PDO::FETCH_ASSOC);
				$max_value = $max['maximum'];
				$committee = $max_value + 1;

			// Enter the new user in the database
			$sql = "INSERT INTO internals (username, password, fullname, designation, committee) VALUES (:username, :password, :fullname, :designation, :committee)";
			$stmt = $conn->prepare($sql);
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':fullname', $_POST['fullname']);
			$stmt->bindParam(':designation', $_POST['designation']);
			$stmt->bindParam(':committee', $committee);

			if( $stmt->execute() ){

				$add_column = $conn->prepare('ALTER TABLE requested ADD status_'.$committee.' BOOLEAN NULL DEFAULT NULL AFTER comment_'.$max_value.', ADD comment_'.$committee.' VARCHAR(300) NULL DEFAULT NULL AFTER status_'.$committee.'');

				if ( $add_column->execute() ) {

					$records = $conn->prepare('SELECT id, username, password, committee FROM internals WHERE username = :username');
					$records->bindParam(':username', $_POST['username']);
					$records->execute();

					$results = $records->fetch(PDO::FETCH_ASSOC);

					if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

						$_SESSION['user_id'] = $results['id'];
						$_SESSION['username'] = $results['username'];
						$_SESSION['committee'] = $results['committee'];
						$_SESSION['user_status'] = 'teacher';
						header("Location: index.php");
					}
				}

			} else {
				$message = "Sorry there must have been an issue creating your account";
			}
		}

	} else {
		$message = "Password and confirm password does not match";
	}

} else {
	$message = "All fields are required";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

	<div class="header">
		<a href="/">FYPMS</a>
	</div>

	<h1>Teacher Register</h1>
	<span>or <a href="login.php">login here</a></span>

	<form action="register_teacher.php" method="POST">

		Username: <input type="text" placeholder="Enter your username" name="username" required>
		Password: <input type="password" placeholder="and password" name="password" required>
		Confirm Password: <input type="password" placeholder="confirm password" name="confirm_password" required>
		Fullname: <input type="text" placeholder="fullname" name="fullname" required>
		Designation: <select name="designation">
					<option value="lecturer">Lecturer</option>
					<option value="assistant professor">Assistant Professor</option>
					<option value="associate professor">Associate Professor</option>
					<option value="professor">Professor</option>
					</select><br><br>
		Defence Committee: <input type="radio" name="committee" value="yes" required> Yes
							<input type="radio" name="committee" value="no" required> No <br><br>

		<input type="submit">

	</form>
	<?php echo $message;
	echo "<br> <a href='register_student.php'>Student?</a>";
	?>

</body>
</html>
