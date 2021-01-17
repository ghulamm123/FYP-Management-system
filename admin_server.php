<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'admin') ) {
	if (isset($_POST['assign_internal'])) {
		$group_id = $_POST['group_id'];
		$internal_id = $_POST['internal_id'];

		$assign_internal = $conn->prepare('UPDATE groups SET internal_id = :internal_id, internal_req_id = :internal_req_id WHERE id = :group_id');
		$assign_internal->bindParam(':group_id', $group_id);
		$assign_internal->bindParam(':internal_id', $internal_id);
		$assign_internal->bindParam(':internal_req_id', $internal_id);
		$assign_internal->execute();
		header("Location: groups_admin.php");

	}


	elseif (isset($_POST['assign_midyear_external'])) {
		$group_id = $_POST['group_id'];
		$external_id = $_POST['external_id'];

		$assign_external = $conn->prepare('UPDATE groups SET midyear_external_id = :external_id WHERE id = :group_id');
		$assign_external->bindParam(':group_id', $group_id);
		$assign_external->bindParam(':external_id', $external_id);
		$assign_external->execute();
		header("Location: midyear_admin.php");

	}

	elseif (isset($_POST['assign_final_external'])) {
		$group_id = $_POST['group_id'];
		$external_id = $_POST['external_id'];

		$assign_external = $conn->prepare('UPDATE groups SET final_external_id = :external_id WHERE id = :group_id');
		$assign_external->bindParam(':group_id', $group_id);
		$assign_external->bindParam(':external_id', $external_id);
		$assign_external->execute();
		header("Location: final_admin.php");

	}

	elseif (isset($_POST['defence_deadline'])) {
		$defence_date = $_POST['defence_date'];

		$defence_deadline_date = $conn->prepare('UPDATE admin SET defence_deadline = :defence_date WHERE id = :id');
		$defence_deadline_date->bindParam(':id', $_SESSION['user_id']);
		$defence_deadline_date->bindParam(':defence_date', $defence_date);
		$defence_deadline_date->execute();
		header("Location: admin_home.php");

	}

	elseif (isset($_POST['internal_deadline'])) {
		$internal_date = $_POST['internal_date'];

		$internal_deadline_date = $conn->prepare('UPDATE admin SET internal_selection_deadline = :internal_date WHERE id = :id');
		$internal_deadline_date->bindParam(':id', $_SESSION['user_id']);
		$internal_deadline_date->bindParam(':internal_date', $internal_date);
		$internal_deadline_date->execute();
		header("Location: admin_home.php");

	}

	 else{
		header("Location: index.php");
	}
}
	else{
		header("Location: admin_login.php");
}
?>
