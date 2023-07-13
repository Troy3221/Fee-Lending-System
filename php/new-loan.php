<?php
require_once("database.php");
require_once("session.php");

$id = $_SESSION['user-id'];
$loan_amount = $_POST['loan-amount'];
$loan_period = $_POST['loan-duration'];
$loan_dest = $_POST['loan-dest'];
$bank_name = $_POST['bank-options'];
$interest_rate = null;
$overdue_penalty = '5%';
$recv_name = null;
$recv_no = null;
$loan_status = 'Pending';

#Interest Graph
switch($loan_amount) {
    case in_array($loan_amount, range(2000,3000)):
        $interest = "3%";
        break;

    case in_array($loan_amount, range(4000,7000)):
        $interest = "4%";
        break;

    case in_array($loan_amount, range(8000,10000)):
        $interest = "5%";
        break;
}


#Name 
switch($loan_dest) {
    case 'bank':
        $recv_no = $_POST['acc-name'];
        break;

    case 'gcash':
        $recv_no = $_POST['gcash-name'];
        break;

    case 'palawan':
        $recv_no = $_POST['palawan-name'];
        break;

    case 'paymaya':
        $recv_no = $_POST['paymaya-name'];
        break;
}

#Account Number 
switch($loan_dest) {
    case 'bank':
        $recv_no = $_POST['acc-no'];
        break;

    case 'gcash':
        $recv_no = $_POST['gcash-no'];
        break;

    case 'palawan':
        $recv_no = $_POST['palawan-no'];
        break;

    case 'paymaya':
        $recv_no = $_POST['paymaya-no'];
        break;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('localhost','root','','loaning_system');
$sql = "INSERT INTO loan_destination (id, loan_amount, loan_period, loan_dest, bank_name, interest_rate, overdue_penalty, recv_name, recv_no, loan_status) VALUES ($loan_amount, $loan_period, $loan_dest, $bank_name, $interest_rate, $overdue_penalty, $recv_name, $recv_no, $loan_status)";

if(mysqli_query($config, $sql)) {
    header("loaction: new-installlment.php?success");
} else {
    header("loaction: new-installlment.php?failed");
}
?>