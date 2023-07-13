<?php
include('database.php');
session_start();

if(isset($_POST['login_btn']))
{
    $user_name = $_POST['username-input']; 
    $user_pass = $_POST['password-input']; 

    $query = "SELECT * FROM accounts WHERE username ='$user_name' AND password='$user_pass' LIMIT 1";
    $query_run = mysqli_query($config, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if($usertypes['acc_priv'] == "Admin")
    {
        $_SESSION['username'] = $user_name;
        header('Location: dashboard.php');
		exit;
    }
    else if($usertypes['acc_priv'] == "User")
    {
        $_SESSION['username'] = $user_name;
        header('Location: home.php');
		exit;
    }
    else {
	header("location: ../index.php?Invalid");
	}
}
?>