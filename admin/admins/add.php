<?php require_once('../../config.php');?>
<?php require(BL.'/functions/validate.php');?>
<?php require(BLA.'inc/header.php'); ?>
<?php
    $email = $username = '';
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!checkEmpty($username) && !checkEmpty($email) && !checkEmpty($password)) {
            if(checkEmail($email)) {
                $is_exist = getRow('admins','admin_email',$email); 
                if(!$is_exist) {
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO admins (`admin_username`, `admin_email`, `admin_password`)
                 VALUES('$username', '$email', '$hash_password')";
                $check = insertRow($sql);
                if($check) {
                    $success_message = "ADD NEW ADMIN";
                    header('refresh:2; url=' . BURLA);
                } else {
                    $error_message = "ERROR IN DATABASE";
                }
            } else {
                $error_message = "Email is exist";
            }    
            } else {
                $error_message = "Email must be in correct formate"; 
            }
        } else {
            $error_message = "Please Fill All Fields";
        }
    }

?>





<div class="container mt-5">
    <?php if(isset($error_message)) {?>
    <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
    <?php } ?>
    <?php if(isset($success_message)) {?>
    <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $success_message; ?></h3></div>
    <?php } ?>
    <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>



<?php require(BLA.'inc/footer.php'); ?>
