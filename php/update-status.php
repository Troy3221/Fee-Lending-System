<?php
	include_once("database.php");

	if(isset($_POST['approve-loan'])) {
		$ref_no = $_POST['ref-no'];
		
		$sql = "UPDATE loan_destination SET loan_status = 'Approved' WHERE ref_no = '$ref_no'";

		if ($config -> query($sql) === TRUE) {
		  header ('location:loan-management.php?approved');
		} else {
			header ('location:loan-management.php?updatefailed');
			//echo "Error updating record: " . $config->error;
		}
	}	

	if(isset($_POST['decline-loan'])) {
		$ref_no = $_POST['ref-no'];

		$sql = "UPDATE loan_destination SET loan_status = 'Declined' WHERE ref_no = '$ref_no'";

		if ($config -> query($sql) === TRUE) {
		  header ('location:loan-management.php?declined');
		} else {
			header ('location:loan-management.php?updatefailed');
		  //echo "Error updating record: " . $config->error;
		}
	}

	if(isset($_POST['terminate-loan'])) {
		$ref_no = $_POST['ref-no'];

		$sql = "UPDATE loan_destination SET loan_status = 'Terminated' WHERE ref_no = '$ref_no'";

		if ($config -> query($sql) === TRUE) {
		  header ('location:loan-management.php?terminated');
		} else {
			header ('location:loan-management.php?updatefailed');
			//echo "Error updating record: " . $config->error;
		}
	}		

	mysqli_close($config);

?>