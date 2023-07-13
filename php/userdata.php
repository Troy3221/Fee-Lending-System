<?php
include_once "database.php";

$username = $_SESSION["username"];

$sql = mysqli_query($config, "SELECT * FROM accounts WHERE username = '$username'");

while($rows = mysqli_fetch_array($sql)) {
	$_SESSION['user-id'] = $rows['acc_no'];
	$_SESSION['first'] = $rows['first_name'];
	$_SESSION['last'] = $rows['last_name'];
	$_SESSION['email'] = $rows['email_add'];
	$_SESSION['mobile'] = $rows['mobile_no'];
	$_SESSION['bday'] = $rows['birth_date'];
	$_SESSION['age'] = $rows['age'];
	$_SESSION['address'] = $rows['address'];
	$_SESSION['username'] = $rows['username'];
	$_SESSION['priv'] = $rows['acc_priv'];
	$_SESSION['stats'] = $rows['acc_status'];
}

$id = $_SESSION['user-id'];



?>
