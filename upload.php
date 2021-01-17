<?php

session_start();

require 'database.php';

if ( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'teacher') )
{
	if (isset($_POST['submit'])) {

		date_default_timezone_set('Asia/Karachi');
		$current_date = date('Y-m-d H:i:s');

		$namefile = $_POST['namefile'];
		$description = $_POST['description'];

		$file = $_FILES ['file'];

		$filename = $_FILES ['file']['name'];
		$file_tmp_name = $_FILES ['file']['tmp_name'];
		$filesize = $_FILES ['file']['size'];
		$file_error = $_FILES ['file']['error'];
		$file_type = $_FILES ['file']['type'];

		$file_ext = explode('.', $filename);
		$file_actual_ext = strtolower(end($file_ext));

		$allowed_ext = array('pdf', 'docx', 'doc' );
		$allowed_Types = array('application/pdf', 'application/docx');

		if(!empty($description) && !empty($namefile)){
			if(in_array($file_actual_ext, $allowed_ext) || in_array($file_type)) {
				if($file_error === 0) {
					if ($filesize < 3000000) {
						$stmt = $conn->prepare('INSERT INTO uploads (internal_id, filename, description, date_time) VALUES (:internal_id, :filename, :description, :date_time)');
						$stmt->bindParam(':internal_id', $_SESSION['user_id']);
						$stmt->bindParam(':filename', $namefile);
						$stmt->bindParam(':description', $description);
						$stmt->bindParam(':date_time', $current_date);
						if( $stmt->execute() ){
							$file_destination = 'uploads/internals/'.$namefile.$_SESSION['username'];
							move_uploaded_file($file_tmp_name, $file_destination);
							header("Location: index.php");
						} else {
							header("Location: index.php");
						}
					} else {
						echo "Your file is too big!";
					}
				} else {
					echo "There was an error uploading you file!";
				}
			} else {
				echo "You cannot upload files of this type!";
			}
		} else {
			echo "File Name and description is required!";
		}
	} else{
		header("Location: index.php");
	}
}

elseif ( isset($_SESSION['user_status']) && ($_SESSION['user_status']== 'student') )
{
	if (isset($_POST['submit'])) {

		date_default_timezone_set('Asia/Karachi');
		$current_date = date('Y-m-d H:i:s');

		$namefile = $_POST['namefile'];
		$description = $_POST['description'];

		$file = $_FILES ['file'];

		$filename = $_FILES ['file']['name'];
		$file_tmp_name = $_FILES ['file']['tmp_name'];
		$filesize = $_FILES ['file']['size'];
		$file_error = $_FILES ['file']['error'];
		$file_type = $_FILES ['file']['type'];

		$file_ext = explode('.', $filename);
		$file_actual_ext = strtolower(end($file_ext));

		$allowed_ext = array('pdf', 'docx', 'doc' );
		$allowed_Types = array('application/pdf', 'application/msword');

		if(!empty($description) && !empty($namefile)){
			if(in_array($file_actual_ext, $allowed_ext) || in_array($file_type, $allowed_Types)) {
				if($file_error === 0) {
					if ($filesize < 3000000) {
						$stmt = $conn->prepare('INSERT INTO requested (group_id, filename, description, date_time) VALUES (:group_id, :filename, :description, :date_time)');
						$stmt->bindParam(':group_id', $_SESSION['user_id']);
						$stmt->bindParam(':filename', $namefile);
						$stmt->bindParam(':description', $description);
						$stmt->bindParam(':date_time', $current_date);
						if( $stmt->execute() ){
							$file_destination = 'uploads/requested/'.$namefile.$_SESSION['username'];
							move_uploaded_file($file_tmp_name, $file_destination);
							header("Location: index.php");
						} else {
							header("Location: index.php");
						}
					} else {
						echo "Your file is too big!";
					}
				} else {
					echo "There was an error uploading you file!";
				}
			} else {
				echo "You cannot upload files of this type!";
			}
		} else {
			echo "File Name and description is required!";
		}
	}

	elseif (isset($_POST['proposal_id'])) {
		$proposal_id = $_POST['proposal_id'];

		date_default_timezone_set('Asia/Karachi');
		$current_date = date('Y-m-d H:i:s');

		$namefile = $_POST['namefile'];
		$description = $_POST['description'];

		$file = $_FILES ['file'];

		$filename = $_FILES ['file']['name'];
		$file_tmp_name = $_FILES ['file']['tmp_name'];
		$filesize = $_FILES ['file']['size'];
		$file_error = $_FILES ['file']['error'];
		$file_type = $_FILES ['file']['type'];

		$file_ext = explode('.', $filename);
		$file_actual_ext = strtolower(end($file_ext));

		$allowed_ext = array('pdf', 'docx', 'doc' );
		$allowed_Types = array('application/pdf', 'application/msword');
		/* $allowed_Types = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'); */

		if(!empty($description) && !empty($namefile)){
			if(in_array($file_actual_ext, $allowed_ext) || in_array($file_type, $allowed_Types)) {
				if($file_error === 0) {
					if ($filesize < 3000000) {
						$stmt = $conn->prepare('INSERT INTO proposals (group_id, requested_id, internal_id, filename, description, date_time)
								VALUES (:group_id, :requested_id, :internal_id, :filename, :description, :date_time)');
						$stmt->bindParam(':group_id', $_SESSION['user_id']);
						$stmt->bindParam(':requested_id', $proposal_id);
						$stmt->bindParam(':internal_id', $_SESSION['internal_id']);
						$stmt->bindParam(':filename', $namefile);
						$stmt->bindParam(':description', $description);
						$stmt->bindParam(':date_time', $current_date);
						if( $stmt->execute() ){
							$file_destination = 'uploads/proposals/'.$namefile.$_SESSION['username'];
							move_uploaded_file($file_tmp_name, $file_destination);
							header("Location: requested.php");
						} else {
							header("Location: index.php");
						}
					} else {
						echo "Your file is too big!";
					}
				} else {
					echo "There was an error uploading you file!";
				}
			} else {
				echo "You cannot upload files of this type!";
			}
		} else {
			echo "File Name and description is required!";
		}
	}

	elseif (isset($_POST['document'])) {

		$document = $_POST['document'];

		$poster_tmp_name = $_FILES ['poster']['tmp_name'];
		$postersize = $_FILES ['poster']['size'];
		$poster_error = $_FILES ['poster']['error'];
		$poster_type = $_FILES ['poster']['type'];

		$brochure_tmp_name = $_FILES ['brochure']['tmp_name'];
		$brochuresize = $_FILES ['brochure']['size'];
		$brochure_error = $_FILES ['brochure']['error'];
		$brochure_type = $_FILES ['brochure']['type'];

		$allowed_Types = array('image/jpeg', 'image/png', 'image/jpg');

		if(in_array($poster_type, $allowed_Types) && in_array($brochure_type, $allowed_Types)) {
			if($poster_error === 0 && $brochure_error === 0) {
				if ($postersize < 3000000 && $brochuresize < 3000000) {

						$poster_destination = 'uploads/poster/'.$document.$_SESSION['username'];
						move_uploaded_file($poster_tmp_name, $poster_destination);

						$brochure_destination = 'uploads/brochure/'.$document.$_SESSION['username'];
						move_uploaded_file($brochure_tmp_name, $brochure_destination);

						$stmt = $conn->prepare('UPDATE proposals SET poster = 1 WHERE filename = :document');
						$stmt->bindParam(':document', $document);
						$stmt->execute();

						header("Location: index.php");

				} else {
					echo "Your file is too big!";
				}
			} else {
				echo "There was an error uploading you file!";
			}
		} else {
			echo "You cannot upload files of this type!";
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
