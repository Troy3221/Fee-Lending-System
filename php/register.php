<?php

	require_once("database.php");

	// Check button is NOT is clicked
	if(!isset($_POST['submit'])) {
		header('location: sign-up.php');
		exit();
	}

	// Go on
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$email = $_POST['email'];
	$mobile_no = $_POST['mobile_no'];
	$bday = $_POST['bday'];
	$age = $_POST['age'];
	$address = $_POST['address'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['confirm_password'];
	$checkbox = $_POST['agree'];
	$fileUploadName = $_FILES["identification"]["name"];
	$status = 'New';
	$privilege = 'User';
	$profile = $_FILES['../img/register.php']['name'];
	$regdate = $_POST['date_registered'];


	if(empty($fname) || empty($lname) || empty($email) || empty($mobile_no) || empty($bday) || empty($age) || empty($address) || empty($username) || empty($password) || empty($cpassword) || empty($fileUploadName))  {
		header('location: sign-up.php?error=emptyfields');
		exit();
	}

	// Check terms button is NOT is clicked
	if(!isset($_POST['agree'])) {
		header('location: sign-up.php?error=terms');
		exit();
	}

	if($password != $cpassword) {
		header('location: sign-up.php?error=notmatch');
		exit();
	}

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($fileUploadName);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["identification"]["tmp_name"]);
	if($check !== false) {
	  echo "File is an image - " . $check["mime"] . ".";
	  $uploadOk = 1;
	} else {
	  echo "File is not an image.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		header('location: sign-up.php?error=filetype');
		exit();
	  $uploadOk = 0;
	}

	$tmp_name = $_FILES["identification"]["tmp_name"];

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	  // if everything is ok, try to upload file
	  } else {
		if (move_uploaded_file($tmp_name, $target_file)) {
		  echo "The file ". htmlspecialchars( basename($fileUploadName)). " has been uploaded.";
		} else {
		  echo "Sorry, there was an error uploading your file.";
		}
	}

	$file = "uploads/".$fileUploadName;

	$sql = "INSERT INTO accounts (first_name, last_name, email_add, mobile_no, birth_date, age, address, valid_id, username, password, acc_status, acc_priv, date_registered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,NOW())";

	$stmt = mysqli_stmt_init($config);

	if (!mysqli_stmt_prepare($stmt,$sql))
	{
		header('location: sign-up.php?error=servererror');
		exit();
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "sssisissssss", $fname, $lname, $email, $mobile_no, $bday, $age, $address, $file, $username, $password, $status, $privilege);
		mysqli_stmt_execute($stmt);
		header('location: ../index.php?msg=accountregistered');
		exit();
}