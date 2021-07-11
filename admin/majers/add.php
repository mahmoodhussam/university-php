<?php require_once('../../config.php'); ?>
<?php
    require(BL.'/functions/validate.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['majer_name'];
        if(!checkEmpty($name)) {
            if(is_string($name)) {
                $is_exist = getRow('majer','majer_name', $name);
                if(!$is_exist) {
                $sql = "INSERT INTO majer (`majer_name`) VALUES('$name')";
                $check = insertRow($sql);
                if($check) {
                    $success_message = "New Majer Added";
                    header('refresh:2; url='. BURLA);
                } else {
                    $error_message = "Error";
                }
            } else {
                $error_message = "This majer is existed";
            }
            } else {
                $error_message = 'Majer must be only string';
            }
        } else {
            $error_message = "Majers cannot be empty";
        }
    }
?>
<?php require(BLA.'inc/header.php');  ?>
<div class="container mt-5">
    <div class="container mt-5">
        <?php if(isset($error_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
        <?php } ?>
        <?php if(isset($success_message)) {?>
        <div class="p-3 mb-2 bg-success text-center text-white"><h3><?php echo $success_message; ?></h3></div>
        <?php } ?>
    </div>
    <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="mb-3">
        <label for="majer_name" class="form-label">Majer Name</label>
        <input type="text" name="majer_name" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
</div>



<?php require(BLA.'inc/footer.php'); ?>