<?php
include"database.php";

if (isset($_POST['deletedata'])) {

    // sql to delete a record
    $id=$_POST['delete_id'];
    $sql = "DELETE FROM accounts WHERE acc_no='$id'";

    if ($config->query($sql) === TRUE) {
      header("location:manage-clients.php?success");
    } 
    else {
      echo "Error deleting record: " . $config->error;
    }

}

$config->close();

?>