<?php
session_start();
require_once 'database.php';
 
 $id= $_SESSION['user-id'];

  if(isset($_POST['submit'])){
    
    $firstname = $_POST['user-first'];
    $lastname = $_POST['user-last'];
    $email = $_POST['user-email'];
    $mobile = $_POST['user-mobile'];
    $birthdate = $_POST['user-bday'];
    $age = $_POST['user-age'];
    $address = $_POST['user-add'];

    $sql = "UPDATE accounts SET first_name = '$firstname', last_name ='$lastname', email_add = '$email', mobile_no ='$mobile', birth_date ='$birthdate', age='$age', address ='$address' WHERE acc_no = '$id'";
    $result = mysqli_query($config, $sql);

    if($result) {
        header ('location:accounts.php?Success');
    } else {
        header ('location:accounts.php?Error');
    }
    mysqli_close($config);
}

?>

