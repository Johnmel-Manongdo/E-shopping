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
            <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <!-- <img src="img/logo.png" alt="" class="center" width="150px" height="150px"> -->
                        <h5 class="card-title text-center mb-5 fw-light fs-5">User Registration</h5>
                        <?php if (isset($_GET['success'])) { ?>
                            <script>
                                swal({
                                    title: "<?php echo $_GET['success']; ?>",
                                    icon: "success",
                                    button: "Okay",
                                });
                            </script>
                        <?php } ?>
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <p class="error"><strong><?php echo $_GET['error']; ?></strong></p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php } ?>
                        <form action="php_code/register_code.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="user_name" value="<?php if (isset($_GET['user_name']))
                                                                                                    echo ($_GET['user_name']); ?>" placeholder="Enter username here...">
                                <label for="user_name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="user_email" value="<?php if (isset($_GET['user_email']))
                                                                                                        echo ($_GET['user_email']); ?>" placeholder="Enter email here...">
                                <label for="user_email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="user_pass" value="<?php if (isset($_GET['user_pass']))
                                                                                                        echo ($_GET['user_pass']); ?>" placeholder="Enter password here...">
                                <label for="user_pass">Password</label>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="form-group row">
                                <p>Enter what's in the image</p>
                                <div class="col">
                                    <img src="captcha/captcha_gen.php" />
                                </div>
                                <div class="col">
                                    <input type="text" name="captcha_code" style="text-transform:uppercase;" class="form-control" id="captcha-input" autocomplete="off" placeholder="Enter captcha" />
                                </div>
                            </div>
                            <a href="" id="cl">Click to refresh</a>
                            <div class="d-grid mt-5">
                                <button class="btn btn-success btn-login text-uppercase fw-bold" id="st" type="submit" name="submit">Register</button>
                            </div>
                            <div class="d-grid mt-3">
                                <p>Already have an Account? Login <a href="index.php">here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#st").on('click', function() {
                $("#msg").css('display', 'block');

            });
            $("#cl").on('click', function() {
                location.reload();
            });


        });
    </script>
</body>

</html>