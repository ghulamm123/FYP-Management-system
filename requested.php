<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}

require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'student') ) {
	$max_committee = $conn->prepare('SELECT MAX(committee) AS maximum FROM internals');
	$max_committee->execute();
	$max = $max_committee->fetch(PDO::FETCH_ASSOC);
	$max_value = $max['maximum'];

	$file_ret_sql = 'SELECT filename, description, date_time ';

	$count = 1;

	for ($i = 0; $i < $max_value; $i++) {
		$file_ret_sql .= ', comment_'.$count.' ';
		$count ++;
	}


	$file_ret_sql .= 'FROM requested WHERE group_id = :id ';

	$file_ret = $conn->prepare($file_ret_sql);
	$file_ret->bindParam(':id', $_SESSION['user_id']);
	$file_ret->execute();



	$file_approve_sql = 'SELECT id, filename, description, date_time ';

	$count = 1;

	for ($i = 0; $i < $max_value; $i++) {
		$file_approve_sql .= ', comment_'.$count.' ';
		$count ++;
	}

	$count = 1;
	$file_approve_sql .= 'FROM requested WHERE (status_'.$count.' = 1 ';

	for ($i = 1; $i < $max_value; $i++) {
		$count ++;
		$file_approve_sql .= ' AND status_'.$count.' = 1 ';
	}

	$file_approve_sql .= ') AND (group_id = :id) ';

	$file_approve = $conn->prepare($file_approve_sql);
	$file_approve->bindParam(':id', $_SESSION['user_id']);
	$file_approve->execute();



	$file_reject_sql = 'SELECT filename, description, date_time ';

	$count = 1;

	for ($i = 0; $i < $max_value; $i++) {
		$file_reject_sql .= ', comment_'.$count.' ';
		$count ++;
	}

	$count = 1;
	$file_reject_sql .= 'FROM requested WHERE (status_'.$count.' = 0 ';

	for ($i = 1; $i < $max_value; $i++) {
		$count ++;
		$file_reject_sql .= ' OR status_'.$count.' = 0 ';
	}

	$file_reject_sql .= ') AND (group_id = :id) ';

	$file_reject = $conn->prepare($file_reject_sql);
	$file_reject->bindParam(':id', $_SESSION['user_id']);
	$file_reject->execute();



	$file_pending_sql = 'SELECT filename, description, date_time FROM requested WHERE (status_'.$count.' IS NULL ';

	$count = 1;

	for ($i = 1; $i < $max_value; $i++) {
		$count ++;
		$file_pending_sql .= ' AND status_'.$count.' IS NULL ';
	}

	$file_pending_sql .= ') AND (group_id = :id) ';

	$file_pending = $conn->prepare($file_pending_sql);
	$file_pending->bindParam(':id', $_SESSION['user_id']);
	$file_pending->execute();


	$defence_date = $conn->prepare('SELECT defence_deadline FROM admin WHERE id = 1');
	$defence_date->execute();
	$defence_deadline = $defence_date->fetch(PDO::FETCH_ASSOC);
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

		date_default_timezone_set('Asia/Karachi');
		$defence = $defence_deadline['defence_deadline'];
		$current_date = date('Y-m-d H:i:s');
		//$defenceTimestamp1 = strtotime($defence);
		//$dateTimestamp2 = strtotime($current_date);
		if ($defence > $current_date) {
		?>

		<form action="upload.php" method="POST" enctype="multipart/form-data">
			Project Name: <input type="text" name="namefile"> <br /><br />
			Description:  <textarea rows = "6" cols = "50" maxlength="300" placeholder="Enter description here...(300 character only)" name = "description">
			</textarea>
			<input type="file" name="file">
			<button type="submit" name="submit">UPLOAD FILE</button>
			</form>
		<?php
		}
		?>

			<p><font size="5">Uploaded Projects History:</font></p>
				<?php while($results = $file_ret->fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="box">
						<?php
						$files_show = 'uploads/requested/'.$results['filename'].$_SESSION['username'];
						echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>";
						echo "Project Description: ".$results['description']. "<br>";

						$count = 1;

						for ($i = 0; $i < $max_value; $i++) {
							echo "committee_" .$count. " comments: ".$results['comment_'.$count.'']. "<br>";
							$count ++;
						}
						echo "<a href='$files_show'>DETAILS</a>" . "<br>". "</div>".  "<br>";
						}?>

			<p><font size="5">Pending Projects:</font></p>
				<?php while($results = $file_pending->fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="box">
						<?php
						$files_show = 'uploads/requested/'.$results['filename'].$_SESSION['username'];
						echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
						echo "Project Description: ".$results['description']. "<br>";
						echo "<a href='$files_show'>DETAILS</a>" . "<br>". "</div>".  "<br>";
						}?>

			<p><font size="5">Approved Projects:</font></p>
				<?php while($results = $file_approve->fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="box">
						<?php
						$files_show = 'uploads/requested/'.$results['filename'].$_SESSION['username'];
						echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
						echo "Project Description: ".$results['description']. "<br>";

						$count = 1;

						for ($i = 0; $i < $max_value; $i++) {
							echo "committee_" .$count. " comments: ".$results['comment_'.$count.'']. "<br>";
							$count ++;
						}
						echo "<a href='$files_show'>DETAILS</a>";
						?>
						<form action="proposal.php" method="POST">
						<p style='text-align: right'>
						<button type="submit" name="proposal" value="<?php echo $results['id']; ?>">PROPOSAL</button>
						</p>
						</form> </div> <br>
						<?php
						} ?>

			<p><font size="5">Rejected Projects:</font></p>
				<?php while($results = $file_reject->fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="box">
						<?php
						$files_show = 'uploads/requested/'.$results['filename'].$_SESSION['username'];
						echo "Project Name: ".$results['filename'] ."<p style='text-align: right'>".$results['date_time']."</p>" ."<br>";
						echo "Project Description: ".$results['description']. "<br>";

						$count = 1;

						for ($i = 0; $i < $max_value; $i++) {
							echo "committee_" .$count. " comments: ".$results['comment_'.$count.'']. "<br>";
							$count ++;
						}
						echo "<a href='$files_show'>DETAILS</a>" . "<br>". "</div>".  "<br>";
						}?>

</body>
</html>
