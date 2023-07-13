<?php
    session_start();
    require_once("database.php");

    if(isset($_POST['submit'])) {
        $ref_no = $_POST['referrence_no'];
        $trans_type = $_POST['payment_method'];
        $id = $_SESSION['user-id'];
        $trans_amount = $_POST['amount_transfer'];

        //Check if payment method is not selected
        if($trans_type == "Select Payment Method") {
            header('location: paynow.php?msg=invalidpayment');
        }

        //If payment method is selected
        else {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            if($config->connect_error){
                die('Payment Error : ' .$config->connect_error);
            }
    
            else {
                //Check if Referrence Number exist in database
                $find = "SELECT ref_no, loan_amount FROM loan_destination WHERE ref_no = '$ref_no'";
                $findit = mysqli_query($config, $find);
                $findrow = mysqli_fetch_row($findit);

                //If referrence number exist
                if ($findrow[0] >= 1) {
                    $sql = "INSERT INTO trans_record (acc_no, for_loan, trans_type, trans_amount) VALUES ('$id', '$ref_no', '$trans_type', '$trans_amount')";
                    
                    if(mysqli_query($config, $sql)) {
                        header('location: paynow.php?msg=paymentsuccess');

                        $rem = $findrow[1];

                        //If the pay amount is greater than the remaining balance
                        if ($trans_amount > $rem) {
                            header('location: paynow.php?msg=negativevalue');
                        }

                        //Deducts payment to the database
                        else {
                            $update = "UPDATE loan_destination SET loan_amount = loan_amount - $trans_amount WHERE ref_no = '$ref_no'";

                            //Check if the remaining balance is zero
                            if (mysqli_query($config, $update)) {

                                $checkbalance = "SELECT loan_amount FROM loan_destination WHERE ref_no = '$ref_no'";
                                $checkresult = mysqli_query($config, $checkbalance);

                                while($uwu = mysqli_fetch_array($checkresult)) {
                                    $loanbalance = $uwu[0];

                                    if ($loanbalance == "0") {

                                        $updatestatus = "UPDATE loan_destination SET loan_status = 'Closed' WHERE ref_no = '$ref_no'";
                                        if (mysqli_query($config, $updatestatus)) {
                                            header('location: paynow.php?msg=paymentsuccess');
                                        }
                                        else {
                                            header('location: paynow.php?msg=updatestatuserror');
                                        }
                                    }
                                    else {
                                        //DO NOTHING
                                    }
                                }
                            }
                            else {
                                header('location: paynow.php?msg=paymentfailed');
                            }
                        }
                    }
                    else {
                        header('location: paynow.php?msg=paymentfailed');
                    }
                    
                }
                else {
                    header('location: paynow.php?msg=refnotfound');
                }

            }
        }
    }

    mysqli_close($config);

    
?>
