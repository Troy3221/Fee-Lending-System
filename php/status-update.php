<?php
    include_once "session.php";
    include_once "userdata.php";
    include_once "database.php";


    if(isset($_POST['approve-loan'])){
        $loan_status = $_POST['approve-loan'];
          

        $sql =  "UPDATE loan_destination SET loan_status ='$loan_status' WHERE acc_no= ('".$acc_no."');";

          $variable= mysqli_query($config, $sql);
          if($variable){
              header('location: loan-management.php');
          }
          else{
              header('location: loan-management.php');
          }

    }
?>