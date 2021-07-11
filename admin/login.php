<?php
    require_once('../config.php');
    require(BL.'/functions/validate.php');
    $email = "";
    if(isset($_SESSION['admin_name'])) {
        header('location: '. BURLA);
    }
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!checkEmpty($email) && !checkEmpty($password)) {
            if(checkEmail($email)) {
                $check = getRow('admins','admin_email',"$email");
                if($check) {
                    $check_password = password_verify($password, $check['admin_password']);
                    if($check_password) {
                        $_SESSION['admin_name'] = $check['admin_username'];
                        $_SESSION['admin_email'] = $check['admin_email'];
                        $_SESSION['admin_type'] = $check['admin_type'];
                        header('location: '. BURLA);
                    } else {
                        $error_message = "Password does not correct";
                    }
                } else {
                    $error_message = "Email does not correct";
                }
            } else {
                $error_message = "Please Add email in correct formate";
            }
        } else {
            $error_message = "Please Fill All Fileds";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Login | Page</title>
</head>
<body>
    <div class="container mt-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo BURL ?>"><img src="<?php echo ASSESTS. 'images/BAU.jpg' ?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo BURL ?>"><h5>HOME</h5></a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo BURL . 'register.php'; ?>"><h5>Register</h5></a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    </div>
    <div class="container mt-5">
        <?php if(isset($error_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
        <?php } ?>
        <?php if(isset($success_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $success_message; ?></h3></div>
        <?php } ?>
    </div>
    <div class="container mt-5">
        <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>