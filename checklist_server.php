<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') ) {
	if (isset($_POST['checklist'])) {
		$proposal_id = $_POST['proposal_id'];
		$group_id = $_POST['group_id'];

		if (isset($_POST['proposal_docx'])) {
			$proposal_docx = $_POST['proposal_docx'];
		} else {
			$proposal_docx = 0;
		}

		if (isset($_POST['proposal_pdf'])) {
			$proposal_pdf = $_POST['proposal_pdf'];
		} else {
			$proposal_pdf = 0;
		}

		if (isset($_POST['research_paper_docx'])) {
			$research_paper_docx = $_POST['research_paper_docx'];
		} else {
			$research_paper_docx = 0;
		}

		if (isset($_POST['research_paper_pdf'])) {
			$research_paper_pdf = $_POST['research_paper_pdf'];
		} else {
			$research_paper_pdf = 0;
		}

		if (isset($_POST['final_report_docx'])) {
			$final_report_docx = $_POST['final_report_docx'];
		} else {
			$final_report_docx = 0;
		}

		if (isset($_POST['final_report_pdf'])) {
			$final_report_pdf = $_POST['final_report_pdf'];
		} else {
			$final_report_pdf = 0;
		}

		if (isset($_POST['proposal_defense_pptx'])) {
			$proposal_defense_pptx = $_POST['proposal_defense_pptx'];
		} else {
			$proposal_defense_pptx = 0;
		}

		if (isset($_POST['midyear_pptx'])) {
			$midyear_pptx = $_POST['midyear_pptx'];
		} else {
			$midyear_pptx = 0;
		}

		if (isset($_POST['poster_day_pptx'])) {
			$poster_day_pptx = $_POST['poster_day_pptx'];
		} else {
			$poster_day_pptx = 0;
		}

		if (isset($_POST['final_exam_pptx'])) {
			$final_exam_pptx = $_POST['final_exam_pptx'];
		} else {
			$final_exam_pptx = 0;
		}

		if (isset($_POST['executable'])) {
			$executable = $_POST['executable'];
		} else {
			$executable = 0;
		}

		if (isset($_POST['source_code'])) {
			$source_code = $_POST['source_code'];
		} else {
			$source_code = 0;
		}

		if (isset($_POST['database_files'])) {
			$database_files = $_POST['database_files'];
		} else {
			$database_files = 0;
		}

		if (isset($_POST['tools'])) {
			$tools = $_POST['tools'];
		} else {
			$tools = 0;
		}

		if (isset($_POST['mp4_video'])) {
			$mp4_video = $_POST['mp4_video'];
		} else {
			$mp4_video = 0;
		}

		if (isset($_POST['poster'])) {
			$poster = $_POST['poster'];
		} else {
			$poster = 0;
		}

		if (isset($_POST['hardware_module'])) {
			$hardware_module = $_POST['hardware_module'];
		} else {
			$hardware_module = "N/A";
		}

		if (isset($_POST['hardware_details'])) {
			$hardware_details = $_POST['hardware_details'];
		} else {
			$hardware_details = "N/A";
		}

		$stmt = $conn->prepare('INSERT INTO checklist (proposal_id, group_id, proposal_docx, proposal_pdf, research_paper_docx, research_paper_pdf, final_report_docx, final_report_pdf, proposal_defense_pptx, midyear_pptx, poster_day_pptx, final_exam_pptx, executable, source_code, database_files, tools, mp4_video, poster, hardware_module, hardware_details)

			VALUES (:proposal_id, :group_id, :proposal_docx, :proposal_pdf, :research_paper_docx, :research_paper_pdf, :final_report_docx, :final_report_pdf, :proposal_defense_pptx, :midyear_pptx, :poster_day_pptx, :final_exam_pptx, :executable, :source_code, :database_files, :tools, :mp4_video, :poster, :hardware_module, :hardware_details)');

		$stmt->bindParam(':proposal_id', $proposal_id);
		$stmt->bindParam(':group_id', $group_id);

		$stmt->bindParam(':proposal_docx', $proposal_docx);
		$stmt->bindParam(':proposal_pdf', $proposal_pdf);
		$stmt->bindParam(':research_paper_docx', $research_paper_docx);
		$stmt->bindParam(':research_paper_pdf', $research_paper_pdf);
		$stmt->bindParam(':final_report_docx', $final_report_docx);
		$stmt->bindParam(':final_report_pdf', $final_report_pdf);
		$stmt->bindParam(':proposal_defense_pptx', $proposal_defense_pptx);
		$stmt->bindParam(':midyear_pptx', $midyear_pptx);
		$stmt->bindParam(':poster_day_pptx', $poster_day_pptx);
		$stmt->bindParam(':final_exam_pptx', $final_exam_pptx);
		$stmt->bindParam(':executable', $executable);
		$stmt->bindParam(':source_code', $source_code);
		$stmt->bindParam(':database_files', $database_files);
		$stmt->bindParam(':tools', $tools);
		$stmt->bindParam(':mp4_video', $mp4_video);
		$stmt->bindParam(':poster', $poster);
		$stmt->bindParam(':hardware_module', $hardware_module);
		$stmt->bindParam(':hardware_details', $hardware_details);

		if ($stmt->execute()) {
			$query = $conn->prepare('UPDATE proposals SET checklist = 1 WHERE id = :id');
			$query->bindParam(':id', $proposal_id);
			$query->execute();

			header("Location: index.php");
		}

	} else{
		header("Location: index.php");
	}
}
	else{
		header("Location: login.php");
}
?>
