<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'student') ) {
	$ret = $conn->prepare('SELECT internal_id, internal_req_id FROM groups WHERE id = :id');
	$ret->bindParam(':id', $_SESSION['user_id']);
	$ret->execute();
	$check = $ret->fetch(PDO::FETCH_ASSOC);

	$_SESSION['internal_id'] = $check['internal_id'];
	$_SESSION['internal_req_id'] = $check['internal_req_id'];
}
	else{
		header("Location: login.php");
}
include ('student_navbar.html');
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
	<?php

	if ( ($_SESSION['internal_id'] == NULL) && ($_SESSION['internal_req_id'] == NULL) ) {
		$project_pending = $conn->prepare('SELECT t1.username, t1.fullname, t1.designation, t2.filename, t2.description, t2.date_time FROM internals t1 INNER JOIN uploads t2 ON t1.id = t2.internal_id WHERE t2.group_req_id = :id  AND t2.group_id IS NULL');
		$project_pending->bindParam(':id', $_SESSION['user_id']);
		$project_pending->execute();
		$results = $project_pending->fetch(PDO::FETCH_ASSOC);

		if(!empty($results)) {

			echo "<p><font size='5'>Request Pending For Project:</font></p>";

			echo "<div class='box'>";
			$files_show = 'uploads/internals/'.$results['filename'].$results['username'];
			echo "Teacher Name: ".$results['fullname'] ."<br>";
			echo "Designation: ".$results['designation'] ."<br>";
			echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
			echo "Project Description: ".$results['description']. "<br>";
			echo "<a href='$files_show'>DETAILS</a>". "</div>".  "<br>";
		}

		else {

			$internal_date = $conn->prepare('SELECT internal_selection_deadline FROM admin WHERE id = 1');
			$internal_date->execute();
			$internal_deadline = $internal_date->fetch(PDO::FETCH_ASSOC);

			date_default_timezone_set('Asia/Karachi');
			$internal = $internal_deadline['internal_selection_deadline'];
			$current_date = date('Y-m-d H:i:s');
			//$internalTimestamp1 = strtotime($internal);
			//$dateTimestamp2 = strtotime($current_date);
			if ($internal > $current_date) {

				$internals_ret = $conn->prepare('SELECT id, fullname, designation FROM internals WHERE status = 1');
				$internals_ret->execute();

				echo "<p><font size='5'>Internals Available For Your Project:</font></p>";

				while($internal_info = $internals_ret->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='box'>";
				echo "Teacher Name: ".$internal_info['fullname'] ."<br>";
				echo "Designation: ".$internal_info['designation'];
				?>
				<form action="request_server.php" method="POST">
				<p style='text-align: right'>
				<button type="submit" name="internal_apply_id" value="<?php echo $internal_info['id']; ?>">APPLY</button>
				</p>
				</form> </div> <br>
				<?php
				}

				$projects_ret = $conn->prepare('SELECT t1.username, t1.fullname, t1.designation, t2.id, t2.filename, t2.description, t2.date_time FROM internals t1 INNER JOIN uploads t2 ON
								t1.id = t2.internal_id WHERE t1.status = 1 AND t2.group_req_id IS NULL AND t2.group_id IS NULL');
				$projects_ret->execute();

				echo "<p><font size='5'>Projects Uploaded By Teachers:</font></p>";

				while($results = $projects_ret->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='box'>";
				$files_show = 'uploads/internals/'.$results['filename'].$results['username'];
				echo "Teacher Name: ".$results['fullname'] ."<br>";
				echo "Designation: ".$results['designation'] ."<br>";
				echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
				echo "Project Description: ".$results['description']. "<br>";
				echo "<a href='$files_show'>DETAILS</a>";
				?>
				<form action="request_server.php" method="POST">
				<p style='text-align: right'>
				<button type="submit" name="project_apply_id" value="<?php echo $results['id']; ?>">APPLY</button>
				</p>
				</form> </div> <br>
				<?php
				}
			} else {
				echo "Deadline For Internal Selection Has Passed!";
			}
		}
	}

	elseif ( ($_SESSION['internal_id'] == NULL) && ($_SESSION['internal_req_id'] != NULL) ) {
		$internal_pending = $conn->prepare('SELECT fullname, designation FROM internals WHERE id = :id');
		$internal_pending->bindParam(':id', $_SESSION['internal_req_id']);
		$internal_pending->execute();

		echo "<p><font size='5'>Request Pending For Internal:</font></p>";

		$results = $internal_pending->fetch(PDO::FETCH_ASSOC);
		echo "<div class='box'>";
		echo "Teacher Name: ".$results['fullname'] ."<br>";
		echo "Designation: ".$results['designation'] ."<br>". "</div>".  "<br>";
	}

	elseif ( ($_SESSION['internal_id'] != NULL) && ($_SESSION['internal_req_id'] == NULL) ) {
		$project_confirm = $conn->prepare('SELECT t1.username, t1.fullname, t1.designation, t2.id, t2.filename, t2.description, t2.date_time FROM internals t1 INNER JOIN uploads t2 ON
							t1.id = t2.internal_id WHERE t1.id = :internal_id AND t2.group_req_id = :group_req_id AND t2.group_id = :group_id');
		$project_confirm->bindParam(':internal_id', $_SESSION['internal_id']);
		$project_confirm->bindParam(':group_req_id', $_SESSION['user_id']);
		$project_confirm->bindParam(':group_id', $_SESSION['user_id']);
		$project_confirm->execute();

		$results = $project_confirm->fetch(PDO::FETCH_ASSOC);

		echo "<p><font size='5'>Your Internal:</font></p>";

		echo "<div class='box'>";
		echo "Teacher Name: ".$results['fullname'] ."<br>";
		echo "Designation: ".$results['designation'] ."<br>". "</div>".  "<br>";

		echo "<p><font size='5'>Your Project From Teachers Pool:</font></p>";

		echo "<div class='box'>";
		$files_show = 'uploads/internals/'.$results['filename'].$results['username'];
		echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
		echo "Project Description: ".$results['description']. "<br>";
		echo "<a href='$files_show'>DETAILS</a>";
		?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<button type="submit" name="project_drop_id" value="<?php echo $results['id']; ?>">DROP</button>
		</p>
		</form> </div> <br>
		<?php
	}


	elseif ( ($_SESSION['internal_id'] != NULL) && ($_SESSION['internal_req_id'] != NULL) ) {
		$internal_confirm = $conn->prepare('SELECT fullname, designation FROM internals WHERE id = :id');
		$internal_confirm->bindParam(':id', $_SESSION['internal_id']);
		$internal_confirm->execute();

		echo "<p><font size='5'>Your Internal:</font></p>";

		$internal_info = $internal_confirm->fetch(PDO::FETCH_ASSOC);
		echo "<div class='box'>";
		echo "Teacher Name: ".$internal_info['fullname'] ."<br>";
		echo "Designation: ".$internal_info['designation'];
		?>
		<form action="request_server.php" method="POST">
		<p style='text-align: right'>
		<button type="submit" name="internal_drop">DROP</button>
		</p>
		</form> </div> <br>
		<?php
	}

	?>
</body>
</html>
