<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style>
    body {
        background: #eae9e9;
        background: linear-gradient(to right, #eae9e9, #eae9e9);
    }

    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }

    p {
        text-align: center;
    }
</style>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <?php
                        if (isset($_SESSION['status'])) {
                            if ($_SESSION['status'] == "ok") {
                        ?>
                                <div class="alert alert-info alert-dismissible fade show">
                                    <p><?php echo $_SESSION['result'] ?></p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <p><?php echo $_SESSION['result'] ?></p>
                                    <button type="button" class="btn-close" data-bs-dismiss="danger"></button>
                                </div>
                        <?php
                            }

                            unset($_SESSION['result']);
                            unset($_SESSION['status']);
                        }
                        ?>
                        <form action="php_code/verify_otp_code.php" method="POST">
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <p class="error"><strong><?php echo $_GET['error']; ?></strong></p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php } ?>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="otp_code" id="floatingInput" placeholder="Enter username here...">
                                <label for="floatingInput">OTP Code</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-login text-uppercase fw-bold" type="submit" name="send">Verify</button>
                            </div>
                            <div class="d-grid mt-3">
                                <p>Use another account instead? Login <a href="index.php">here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>