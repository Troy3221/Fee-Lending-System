<?php
    include_once("database.php");

    if(isset($_POST['submit'])) {
        if(!empty($_FILES["image"]["name"])) {
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if(in_array($fileType, $allowTypes)) {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                $sql = "UPDATE accounts SET profile_pic = '$imgContent'";
                $status = mysqli_query($config, $sql);

                if($status) {
                    header("location: manage-accounts.php?success");
                } 
                else {
                    header("location: manage-accounts.php?failed");
                }
            }
            else {
                header("location: manage-accounts.php?format");
            }
        }
        else {
            header("location: manage-accounts.php?no-file");
        }
        
    }

?>