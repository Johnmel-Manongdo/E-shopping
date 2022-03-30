<?php

include "../db_conn.php";

session_start();

if (isset($_POST['otp_code'])) {

    $otp_code = $_POST['otp_code'];

    if (empty($otp_code)) {
        header("Location: ../otp.php?error=OTP Code is required");
        exit();
    } else {
        $code_check = "SELECT * FROM tbl_user WHERE otp_code='$otp_code'";
        $result = mysqli_query($conn, $code_check);
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../home.php?success=Welcome!");
            exit();
        } else {
            header("Location: ../otp.php?error=Incorrect OTP Code");
            exit();
        }
    }
} else {
    header("Location: ../otp.php");
    exit();
}
