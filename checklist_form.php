<?php

session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
		// redirect them to your desired location
		exit;
}


require 'database.php';

if( isset($_SESSION['user_status']) && ($_SESSION['user_status'] == 'teacher') ) {
	if (isset($_POST['checklist_form'])) {
		$proposal_id = $_POST['proposal_id'];
		$group_id = $_POST['group_id'];
	} else{
		header("Location: index.php");
	}

} else{
	header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
</style>
</head>
<body>
		<br />Welcome <?= $_SESSION['username']; ?>
		<br /><br />
		<p style='text-align: center'><font size="5">Final Submission Checklist:</font></p>

		<form action="checklist_server.php" method="POST">
			<table style="width:100%">
			  <tr>
			    <th>S#</th>
			    <th>Requirement(s)</th>
			    <th>Recommended File Name</th>
			    <th>Check</th>
			  </tr>
			</table>
			<table style="width:100%">
			    <tr>
			      <th>DOCUMENTS (Create a folder name it as Documents)</th>
			    </tr>
			</table>
			<table style="width:100%">
			  <tr>
			    <th rowspan="2">1</th>
			    <th rowspan="2">Approved Proposal</th>
			    <th>1_Proposal.docx</th>
			    <th><input type="checkbox" name="proposal_docx" value="1"></th>
			  </tr>
			  <tr>
			    <th>1_Proposal.pdf</th>
			    <th><input type="checkbox" name="proposal_pdf" value="1"></th>
			  </tr>
			  <tr>
			    <th rowspan="2">2</th>
			    <th rowspan="2">Research Paper</th>
			    <th>2_Research-Paper.docx</th>
			    <th><input type="checkbox" name="research_paper_docx" value="1"></th>
			  </tr>
			  <tr>
			    <th>2_Research-Paper.pdf</th>
			    <th><input type="checkbox" name="research_paper_pdf" value="1"></th>
			  </tr>
			  <tr>
			    <th rowspan="2">3</th>
			    <th rowspan="2">Final Report</th>
			    <th>3_Final-Report.docx</th>
			    <th><input type="checkbox" name="final_report_docx" value="1"></th>
			  </tr>
			  <tr>
			    <th>3_Final-Report.pdf</th>
			    <th><input type="checkbox" name="final_report_pdf" value="1"></th>
			  </tr>
			</table>
			<table style="width:100%">
			    <tr>
			      <th>PRESENTATIONS (Create a folder name it as Presentations)</th>
			    </tr>
			</table>
			<table style="width:100%">
			  <tr>
			      <th>4</th>
			      <th>Proposal Defense Presentation (if any)</th>
			      <th>4_Proposal_Defense.pptx</th>
			      <th><input type="checkbox" name="proposal_defense_pptx" value="1"></th>
			    </tr>
			    <tr>
			      <th>5</th>
			      <th>Mid-Year Presentation</th>
			      <th>5_Mid-Year.pptx</th>
			      <th><input type="checkbox" name="midyear_pptx" value="1"></th>
			    </tr>
			    <tr>
			      <th>6</th>
			      <th>Poster Day Presentation (if any)</th>
			      <th>6_Poster-Day.pptx</th>
			      <th><input type="checkbox" name="poster_day_pptx" value="1"></th>
			    </tr>
			    <tr>
			      <th>7</th>
			      <th>Final Exam Presentation</th>
			      <th>7_Final-Exam.pptx</th>
			      <th><input type="checkbox" name="final_exam_pptx" value="1"></th>
			    </tr>
			</table>
			<table style="width:100%">
			    <tr>
			      <th>SOFTWARE (Create a folder name it as Software)</th>
			    </tr>
			</table>
			<table style="width:100%">
				<tr>
			      <th rowspan="5">8</th>
			      <th>Here include all the software designed and implemented by you in separate folder as:</th>
			      <th></th>
			    </tr>
			      <tr>
			      <th>Executable: Executable version</th>
			      <th><input type="checkbox" name="executable" value="1"></th>
				</tr>
			    <tr>
			      <th>Source: Source Code</th>
			      <th><input type="checkbox" name="source_code" value="1"></th>
			    </tr>
			    <tr>
			      <th>Database: Database files (If any)</th>
			      <th><input type="checkbox" name="database_files" value="1"></th>
			    </tr>
			    <tr>
			      <th>Tools: Any other un-common tools (if used)</th>
			      <th><input type="checkbox" name="tools" value="1"></th>
			    </tr>
			</table>
			<table style="width:100%">
			    <tr>
			      <th>MISCELLANEOUS (Create a folder name it as Misc)</th>
			    </tr>
			</table>
			<table style="width:100%">
			  <tr>
			      <th rowspan="2">9</th>
			      <th>FYP Video in MP4 format not exceeding 50 MB of storage size</th>
			      <th><input type="checkbox" name="mp4_video" value="1"></th>
			    </tr>
			    <tr>
			      <th>Poster design, brochure, ICTR&D formatted proposal etc</th>
			      <th><input type="checkbox" name="poster" value="1"></th>
			    </tr>
			</table>
			<table style="width:100%">
			    <tr>
			      <th>HARDWARE (List down hardware items you have already submitted)</th>
			    </tr>
			</table>
			<table style="width:100%">
				<tr>
					<th>S#</th>
					<th>Hardware module/ item</th>
					<th>(Any details) – Use backside of the page if required</th>
				</tr>
				<tr>
					<th>10</th>
					<th><textarea rows = "5" cols = "35" maxlength="175" placeholder="Enter here...(175 character only)" name = "hardware_module"></textarea></th>
					<th><textarea rows = "5" cols = "40" maxlength="200" placeholder="Enter here...(200 character only)" name = "hardware_details"></textarea></th>
				</tr>
			</table>

			<p style='text-align: center'>
			<input type="hidden" name="proposal_id" value="<?php echo $proposal_id; ?>">
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
			<button type="submit" name="checklist">Submit</button>
			</p>
		</form>

</body>
</html>
