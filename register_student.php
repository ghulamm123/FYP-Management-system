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


if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password']))
{	if ($_POST['password'] == $_POST['confirm_password']) {

		$count = 0;

		for ($i = 0; $i < 3; $i++) {


			$fullname = $_POST['fullname'][$i];
			$rollno = $_POST['rollno'][$i];
			$enrollment = $_POST['enrollment'][$i];
			$cgpa = $_POST['cgpa'][$i];


			if(!empty($fullname) && !empty($rollno) && !empty($enrollment) && !empty($cgpa)) {
				$count++;
			}

		}

		if ($count == 3 || $count == 2) {

			// Enter the new user in the database
			$sql = "INSERT INTO groups (username, password) VALUES (:username, :password)";
			$stmt = $conn->prepare($sql);
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':password', $password);

			if( $stmt->execute() ){

				$records = $conn->prepare('SELECT id, username, password, internal_id FROM groups WHERE username = :username');
				$records->bindParam(':username', $_POST['username']);
				$records->execute();

				$results = $records->fetch(PDO::FETCH_ASSOC);

				if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

						$_SESSION['user_id'] = $results['id'];
						$_SESSION['username'] = $results['username'];
						$_SESSION['internal_id'] = $results['internal_id'];
						$_SESSION['user_status'] = 'student';

					for ($i = 0; $i < $count; $i++) {


						$fullname = $_POST['fullname'][$i];
						$rollno = $_POST['rollno'][$i];
						$enrollment = $_POST['enrollment'][$i];
						$cgpa = $_POST['cgpa'][$i];

						$member_info = $conn->prepare('INSERT INTO students (group_id, fullname, rollno, enrollment, cgpa) VALUES (:group_id, :fullname, :rollno, :enrollment, :cgpa)');

						$member_info->bindParam(':group_id', $_SESSION['user_id']);
						$member_info->bindParam(':fullname', $fullname);
						$member_info->bindParam(':rollno', $rollno);
						$member_info->bindParam(':enrollment', $enrollment);
						$member_info->bindParam(':cgpa', $cgpa);

						$member_info->execute();

					}

					header("Location: index.php");
				}

			} else {
				$message = "Sorry there must have been an issue creating your account";
			}

		} else {
			$message = "Info of all members Required";
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

	<h1>Group Register</h1>
	<span>or <a href="login.php">login here</a></span>

	<form action="register_student.php" method="POST">

		Username: <input type="text" placeholder="Enter your username" name="username" required>
		Password: <input type="password" placeholder="and password" name="password" required>
		Confirm Password: <input type="password" placeholder="confirm password" name="confirm_password" required> <br>
		GROUP MEMBER 1:<br>
		Fullname: <input type="text" placeholder="Fullname" name="fullname[]" required>
		Rollno: <input type="text" placeholder="Rollno" name="rollno[]" required>
		Enrollment: <input type="text" placeholder="Enrollment" name="enrollment[]" required>
		CGPA: <input type="text" placeholder="CGPA" name="cgpa[]" required> <br>
		GROUP MEMBER 2:<br>
		Fullname: <input type="text" placeholder="Fullname" name="fullname[]" required>
		Rollno: <input type="text" placeholder="Rollno" name="rollno[]" required>
		Enrollment: <input type="text" placeholder="Enrollment" name="enrollment[]" required>
		CGPA: <input type="text" placeholder="CGPA" name="cgpa[]" required> <br>
		GROUP MEMBER 3:<br>
		Fullname: <input type="text" placeholder="Fullname" name="fullname[]" required>
		Rollno: <input type="text" placeholder="Rollno" name="rollno[]" required>
		Enrollment: <input type="text" placeholder="Enrollment" name="enrollment[]" required>
		CGPA: <input type="text" placeholder="CGPA" name="cgpa[]" required> <br><br>

		<input type="submit">

	</form>
	<?php echo $message;
	echo "<br> <a href='register_teacher.php'>Teacher?</a>";
	?>

</body>
</html>
