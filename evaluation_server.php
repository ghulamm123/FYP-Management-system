<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') ) {
	if (isset($_POST['midyear_form_submit'])) {

		$count = 0;

		for ($i = 0; $i < count($_POST['student_id']); $i++) {


			$criterion_1 = $_POST['criterion_1'][$i];
			$criterion_2 = $_POST['criterion_2'][$i];
			$criterion_3 = $_POST['criterion_3'][$i];
			$criterion_4 = $_POST['criterion_4'][$i];
			$criterion_5 = $_POST['criterion_5'][$i];
			$criterion_6 = $_POST['criterion_6'][$i];


			if(!empty($criterion_1) && !empty($criterion_2) && !empty($criterion_3) && !empty($criterion_4) && !empty($criterion_5) && !empty($criterion_6)) {
				$count++;
			}

		}

		if ($count == count($_POST['student_id'])) {

			$group_id = $_POST['group_id'];
			$proposal_id = $_POST['proposal_id'];
			$internal_id = $_POST['internal_id'];

			for ($i = 0; $i < count($_POST['student_id']); $i++) {


				$criterion_1 = $_POST['criterion_1'][$i];
				$criterion_2 = $_POST['criterion_2'][$i];
				$criterion_3 = $_POST['criterion_3'][$i];
				$criterion_4 = $_POST['criterion_4'][$i];
				$criterion_5 = $_POST['criterion_5'][$i];
				$criterion_6 = $_POST['criterion_6'][$i];
				$student_id = $_POST['student_id'][$i];

				$stmt = $conn->prepare('INSERT INTO midyear (group_id, student_id, proposal_id, internal_id, external_id, criterion_1, criterion_2, criterion_3, criterion_4, criterion_5, criterion_6) VALUES (:group_id, :student_id, :proposal_id, :internal_id, :external_id, :criterion_1, :criterion_2, :criterion_3, :criterion_4, :criterion_5, :criterion_6)');

				$stmt->bindParam(':group_id', $group_id);
				$stmt->bindParam(':student_id', $student_id);
				$stmt->bindParam(':proposal_id', $proposal_id);
				$stmt->bindParam(':internal_id', $internal_id);
				$stmt->bindParam(':external_id', $_SESSION['user_id']);
				$stmt->bindParam(':criterion_1', $criterion_1);
				$stmt->bindParam(':criterion_2', $criterion_2);
				$stmt->bindParam(':criterion_3', $criterion_3);
				$stmt->bindParam(':criterion_4', $criterion_4);
				$stmt->bindParam(':criterion_5', $criterion_5);
				$stmt->bindParam(':criterion_6', $criterion_6);

				$stmt->execute();

			}

			$stmt = $conn->prepare('UPDATE groups SET midyear_status = 1 WHERE id = :id');
			$stmt->bindParam(':id', $group_id);
			$stmt->execute();

			header("Location: index.php");

		} else {
				echo "All Fields Are Required!";
			}

	}


	elseif (isset($_POST['final_form_submit'])) {

		$count = 0;

		for ($i = 0; $i < count($_POST['student_id']); $i++) {


			$criterion_1 = $_POST['criterion_1'][$i];
			$criterion_2 = $_POST['criterion_2'][$i];
			$criterion_3 = $_POST['criterion_3'][$i];
			$criterion_4 = $_POST['criterion_4'][$i];
			$criterion_5 = $_POST['criterion_5'][$i];
			$criterion_6 = $_POST['criterion_6'][$i];


			if(!empty($criterion_1) && !empty($criterion_2) && !empty($criterion_3) && !empty($criterion_4) && !empty($criterion_5) && !empty($criterion_6)) {
				$count++;
			}

		}

		if ($count == count($_POST['student_id'])) {

			$group_id = $_POST['group_id'];
			$proposal_id = $_POST['proposal_id'];
			$internal_id = $_POST['internal_id'];

			for ($i = 0; $i < count($_POST['student_id']); $i++) {


				$criterion_1 = $_POST['criterion_1'][$i];
				$criterion_2 = $_POST['criterion_2'][$i];
				$criterion_3 = $_POST['criterion_3'][$i];
				$criterion_4 = $_POST['criterion_4'][$i];
				$criterion_5 = $_POST['criterion_5'][$i];
				$criterion_6 = $_POST['criterion_6'][$i];
				$student_id = $_POST['student_id'][$i];

				$stmt = $conn->prepare('INSERT INTO final (group_id, student_id, proposal_id, internal_id, external_id, criterion_1, criterion_2, criterion_3, criterion_4, criterion_5, criterion_6) VALUES (:group_id, :student_id, :proposal_id, :internal_id, :external_id, :criterion_1, :criterion_2, :criterion_3, :criterion_4, :criterion_5, :criterion_6)');

				$stmt->bindParam(':group_id', $group_id);
				$stmt->bindParam(':student_id', $student_id);
				$stmt->bindParam(':proposal_id', $proposal_id);
				$stmt->bindParam(':internal_id', $internal_id);
				$stmt->bindParam(':external_id', $_SESSION['user_id']);
				$stmt->bindParam(':criterion_1', $criterion_1);
				$stmt->bindParam(':criterion_2', $criterion_2);
				$stmt->bindParam(':criterion_3', $criterion_3);
				$stmt->bindParam(':criterion_4', $criterion_4);
				$stmt->bindParam(':criterion_5', $criterion_5);
				$stmt->bindParam(':criterion_6', $criterion_6);

				$stmt->execute();

			}

			$stmt = $conn->prepare('UPDATE groups SET final_status = 1 WHERE id = :id');
			$stmt->bindParam(':id', $group_id);
			$stmt->execute();

			header("Location: index.php");

		} else {
				echo "All Fields Are Required!";
			}

	}


	 else{
		header("Location: index.php");
	}
}
	else{
		header("Location: login.php");
}
?>
