<?php
include"database.php";

if (isset($_POST['archive_data'])) {

    // sql to delete a record
    $id=$_POST['delete_id'];
    $sql = "UPDATE loan_destination SET loan_status ='Archived' WHERE ref_no='$id'";

    if ($config->query($sql) === TRUE) {
      header("location:loan-management.php?archived");
    } 
    else {
      header ('location:loan-management.php?updatefailed');
      //echo "Error deleting record: " . $config->error;
    }

}

if (isset($_POST['delete_data'])) {

  // sql to delete a record
  $id=$_POST['delete_id'];
  $sql = "DELETE FROM loan_destination WHERE ref_no='$id'";

  if ($config->query($sql) === TRUE) {
    header("location:archive-data.php?success");
  } 
  else {
    header ('location:loan-management.php?updatefailed');
    //echo "Error deleting record: " . $config->error;
  }

}

$config->close();

?>