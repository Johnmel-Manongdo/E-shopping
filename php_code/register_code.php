<?php

session_start();

if (isset($_POST['submit'])) {
    include "../db_conn.php";

    if ($_POST["captcha_code"] === $_SESSION["captcha_code"]) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $user_name = validate($_POST['user_name']);
        $user_email = validate($_POST['user_email']);
        $user_pass = validate($_POST['user_pass']);
        $otp_code = rand(999999, 111111);

        $user_data = '&user_name=' . $user_name . '&user_email=' . $user_email . '&user_pass=' . $user_pass;

        if (empty($user_name)) {
            header("Location: ../register.php?error=Name is required&$user_name");
        } else if (empty($user_email)) {
            header("Location: ../register.php?error=Email is required&$user_email");
        } else if (empty($user_pass)) {
            header("Location: ../register.php?error=Password is required&$user_pass");
        } else {
            $encrypted_pass = password_hash($user_pass, PASSWORD_BCRYPT);
            $email_check = "SELECT * FROM tbl_user WHERE user_email = '$user_email'";
            $res = mysqli_query($conn, $email_check);
            if (mysqli_num_rows($res) > 0) {
                header("Location: ../register.php?error=Email already exist!!!");
            } else {
                $sql = "INSERT INTO tbl_user(user_name, user_email, user_pass, otp_code) 
               VALUES('$user_name', '$user_email', '$encrypted_pass', '$otp_code')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: ../index.php?success=Successfully Registered");
                } else {
                    header("Location: ../register.php?error=Unknown Error Occurred&$user_data");
                }
            }
        }
    } else {
        header("Location: ../register.php?error=Invalid Captcha");
    }
}
