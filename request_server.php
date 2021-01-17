<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if ( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'student') )
{
	if (isset($_POST['internal_apply_id'])) {

		$internal_apply_id = $_POST['internal_apply_id'];

		$status = $conn->prepare('SELECT status FROM internals WHERE id = :id');
		$status->bindParam(':id', $internal_apply_id);
		$status->execute();
		$check = $status->fetch(PDO::FETCH_ASSOC);
		if ($check['status'] == '1') {

			$apply_internal = $conn->prepare('UPDATE groups SET internal_req_id = :internal_apply_id WHERE id = :id');
			$apply_internal->bindParam(':internal_apply_id', $internal_apply_id);
			$apply_internal->bindParam(':id', $_SESSION['user_id']);
			if( $apply_internal->execute() ){
				header("Location: internal_request.php");
			} else {
				header("Location: index.php");
			}
		} else {
			echo "Internal Not Available!!";
		}
	}

	elseif (isset($_POST['internal_drop'])) {

		$drop_internal = $conn->prepare('UPDATE groups SET internal_id = NULL, internal_req_id = NULL WHERE id = :id');
		$drop_internal->bindParam(':id', $_SESSION['user_id']);
		if( $drop_internal->execute() ){
			header("Location: internal_request.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['project_apply_id'])) {

		$project_apply_id = $_POST['project_apply_id'];

		$apply_project = $conn->prepare('UPDATE uploads SET group_req_id = :id WHERE id = :project_apply_id');
		$apply_project->bindParam(':id', $_SESSION['user_id']);
		$apply_project->bindParam(':project_apply_id', $project_apply_id);
		if( $apply_project->execute() ){
			header("Location: internal_request.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['project_drop_id'])) {

		$project_drop_id = $_POST['project_drop_id'];

		$drop_project = $conn->prepare('UPDATE uploads SET group_id = NULL, group_req_id = NULL WHERE id = :project_drop_id');
		$drop_project->bindParam(':project_drop_id', $project_drop_id);

		$drop_internal = $conn->prepare('UPDATE groups SET internal_id = NULL, internal_req_id = NULL WHERE id = :id');
		$drop_internal->bindParam(':id', $_SESSION['user_id']);

		if( ($drop_project->execute()) && ($drop_internal->execute()) ){
			header("Location: internal_request.php");
		} else {
			header("Location: index.php");
		}
	}

	else {
		header("Location: index.php");
	}

}

elseif ( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') )
{
	if (isset($_POST['group_accept_id'])) {

		$group_accept_id = $_POST['group_accept_id'];

		$accept_group = $conn->prepare('UPDATE groups SET internal_id = :id WHERE id = :group_accept_id');
		$accept_group->bindParam(':id', $_SESSION['user_id']);
		$accept_group->bindParam(':group_accept_id', $group_accept_id);
		if( $accept_group->execute() ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['group_reject_id'])) {

		$group_reject_id = $_POST['group_reject_id'];

		$reject_group = $conn->prepare('UPDATE groups SET internal_req_id = NULL WHERE id = :group_reject_id');
		$reject_group->bindParam(':group_reject_id', $group_reject_id);
		if( $reject_group->execute() ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['group_drop_id'])) {

		$group_drop_id = $_POST['group_drop_id'];

		$drop_group = $conn->prepare('UPDATE groups SET internal_id = NULL, internal_req_id = NULL WHERE id = :group_drop_id');
		$drop_group->bindParam(':group_drop_id', $group_drop_id);
		if( $drop_group->execute() ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['project_accept'])) {

		$project_id = $_POST['project_id'];
		$group_req_id = $_POST['group_req_id'];

		$accept_group = $conn->prepare('UPDATE groups SET internal_id = :id WHERE id = :group_req_id');
		$accept_group->bindParam(':id', $_SESSION['user_id']);
		$accept_group->bindParam(':group_req_id', $group_req_id);

		$accept_project = $conn->prepare('UPDATE uploads SET group_id = :group_req_id WHERE id = :project_id');
		$accept_project->bindParam(':group_req_id', $group_req_id);
		$accept_project->bindParam(':project_id', $project_id);

		if( ($accept_group->execute()) && ($accept_project->execute()) ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['project_reject'])) {

		$project_id = $_POST['project_id'];

		$reject_project = $conn->prepare('UPDATE uploads SET group_req_id = NULL WHERE id = :project_id');
		$reject_project->bindParam(':project_id', $project_id);
		if( $reject_project->execute() ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	elseif (isset($_POST['project_drop'])) {

		$project_id = $_POST['project_id'];
		$group_id = $_POST['group_id'];

		$drop_group = $conn->prepare('UPDATE groups SET internal_id = NULL, internal_req_id = NULL WHERE id = :group_id');
		$drop_group->bindParam(':group_id', $group_id);

		$drop_project = $conn->prepare('UPDATE uploads SET group_id = NULL, group_req_id = NULL WHERE id = :project_id');
		$drop_project->bindParam(':project_id', $project_id);

		if( ($drop_group->execute()) && ($drop_project->execute()) ){
			header("Location: index.php");
		} else {
			header("Location: index.php");
		}
	}

	else {
		header("Location: index.php");
	}

}

  else{
	header("Location: login.php");
}
?>
