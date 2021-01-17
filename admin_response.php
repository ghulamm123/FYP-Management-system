<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	if (isset($_POST['midyear_response'])) {
		$group_id = $_POST['group_id'];

		$response = $conn->prepare('SELECT t1.fullname, t1.rollno, t1.enrollment, t1.cgpa, t2.criterion_1, t2.criterion_2, t2.criterion_3, t2.criterion_4, t2.criterion_5, t2.criterion_6 FROM students t1 INNER JOIN midyear t2 ON t1.id = t2.student_id WHERE t1.group_id = :group_id');
		$response->bindParam(':group_id', $group_id);
		$response->execute();
		$message = "Mid-Year Response";

	}

	elseif (isset($_POST['final_response'])) {
		$group_id = $_POST['group_id'];

		$response = $conn->prepare('SELECT t1.fullname, t1.rollno, t1.enrollment, t1.cgpa, t2.criterion_1, t2.criterion_2, t2.criterion_3, t2.criterion_4, t2.criterion_5, t2.criterion_6 FROM students t1 INNER JOIN final t2 ON t1.id = t2.student_id WHERE t1.group_id = :group_id');
		$response->bindParam(':group_id', $group_id);
		$response->execute();
		$message = "Final Response";

	}

	 else{
		header("Location: index.php");
	}
}
	else{
		header("Location: admin_login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>FYMS</title>
	<style>
	.box {
    border: 1px solid black;
	}
	</style>
	<!--<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'> -->
</head>
<body>
		<br />Welcome <?= $_SESSION['username']; ?>
		<br /><br />
		<p style='text-align: center'><font size="5"><?= $message; ?></font></p>

			<?php while($results = $response->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="box">
			<?php
			echo "Student Name: ".$results['fullname'] ." ROLL No: ".$results['rollno'] ."<br>";
			echo "Enrollment No: ".$results['enrollment'] ." CGPA: ".$results['cgpa'] ."<br>" ."<br>";
			echo "Criterion 1: How clearly has the student identified issues and explained the Methodology? PLO-4 <br>";
			echo $results['criterion_1'] ."<br>";
			echo "Criterion 2: How well have the tasks been distributed among members? PLO-11 <br>";
			echo $results['criterion_2'] ."<br>";
			echo "Criterion 3: How do you rate the project's progress and plan to carry out rest of the project? PLO-11 <br>";
			echo $results['criterion_3'] ."<br>";
			echo "Criterion 4: How do you grade the student’s performance as an individual and as a team member? PLO-9 <br>";
			echo $results['criterion_4'] ."<br>";
			echo "Criterion 5: How do you grade student’s personal ethics? PLO-8 <br>";
			echo $results['criterion_5'] ."<br>";
			echo "Criterion 6: Demonstration of Project? PLO-4 <br>";
			echo $results['criterion_6'] ."<br>" ."</div>" ."<br>";
			}
			?>
</body>
</html>
