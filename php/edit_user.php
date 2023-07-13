<?php
include_once "session.php";
include_once "userdata.php";
include_once "database.php";

if (isset($_POST['save-changes'])) {
    $acc_no = $_POST['acc-no'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email_add = $_POST['email-add'];
    $mobile_no = $_POST['mobile-no'];
    $birth_date = $_POST['birth-date'];
    $age = $_POST['age'];
    $user_address = $_POST['user-address'];
    $user_name = $_POST['user-name'];
    $user_pass = $_POST['user-pass'];

    $query = "UPDATE accounts SET first_name='$fname', last_name='$lname', email_add='$email_add', mobile_no='$mobile_no', birth_date='$birth_date', age='$age', address='$user_address', username='$user_name', password='$user_pass' WHERE acc_no='$acc_no'";

    $variable = mysqli_query($config, $query);
    if ($variable) {
        header('location: manage-clients.php');
    } else {
        header('location: manage-clients.php');
    }
}
