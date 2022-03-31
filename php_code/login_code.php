<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/PHPMailer/src/Exception.php';
require '/vendor/PHPMailer/src/PHPMailer.php';
require '/vendor/PHPMailer/src/SMTP.php';

session_start();

include "../db_conn.php";

if (isset($_POST['submit'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_email = validate($_POST['user_email']);
    $user_pass = validate($_POST['user_pass']);

    if (empty($user_email)) {
        header("Location: ../index.php?error=Username is required");
        exit();
    } else if (empty($user_pass)) {
        header("Location: ../index.php?error=Password is required");
        exit();
    } else {
        $check_email = "SELECT * FROM tbl_user WHERE user_email = '$user_email'";
        $res = mysqli_query($conn, $check_email);
        if (mysqli_num_rows($res) > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['user_pass'];
            if (password_verify($user_pass, $fetch_pass)) {
                $email = $_POST['user_email'];
                $otp_code_sql = "SELECT otp_code FROM tbl_user";
                $otp_code = mysqli_query($conn, $otp_code_sql);
                //Load composer's autoloader

                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'yamada.shoji99@gmail.com';
                    $mail->Password = 'jdm091076581';
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    //Send Email
                    $mail->setFrom('yamada.shoji99@gmail.com');

                    //Recipients
                    $mail->addAddress($email);
                    $mail->addReplyTo('yamada.shoji99@gmail.com');

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = "OTP Code";
                    while ($row = $otp_code->fetch_assoc()) {
                        $mail->Body    = "You are trying to login in E-Shopping. 
                    To verify your identity, please use this code to login: " . $row['otp_code'];
                    }


                    $mail->send();

                    $_SESSION['result'] = 'OTP Code is already sent to ' . $email;
                    $_SESSION['status'] = 'ok';
                } catch (Exception $e) {
                    $_SESSION['result'] = 'Email could not be sent. Email Error: ' . $mail->ErrorInfo;
                    $_SESSION['status'] = 'error';
                }
                $user_name = $_SESSION['user_name'];
                header("Location: ../otp.php");
                exit();
            } else {
                header("Location: ../index.php?error=Incorrect Password");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Incorrect Email");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
