<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(!checkEmpty($_POST['time_period'])) {
        $id = $_POST['time_id'];
        $name = $_POST['time_period'];
        $row = getRow('times','time_id',$id);
        if($row) {
            $sql = "UPDATE times SET time_period = '$name' WHERE time_id = '$id' ";
            $check = updateRow($sql);
            if($check) {
                $success_message = "Update Time Success";
                header('refresh:2; url=' . BURLA . 'times/');
            } else {
                $error_message = "Update Error";
                header('refresh:2; url=' . BURLA);
            }
        } else {
            $error_message = "This time does not exist";
            header('refresh:2; url=' . BURLA);
        }
    } else {
        $error_message = "Connot Update to Empty";
        header('refresh:2; url=' . BURLA);
    }
?>

<?php require(BLA.'inc/header.php'); ?>
    <div class="container mt-5">
        <?php if(isset($error_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
        <?php } ?>
        <?php if(isset($success_message)) {?>
        <div class="p-3 mb-2 bg-success text-center text-white"><h3><?php echo $success_message; ?></h3></div>
        <?php } ?>
    </div>
<?php require(BLA.'inc/footer.php'); ?>