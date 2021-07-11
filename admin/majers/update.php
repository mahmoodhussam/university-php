<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(!checkEmpty($_POST['majer_name'])) {
        $id = $_POST['majer_id'];
        $name = $_POST['majer_name'];
        $row = getRow('majer','majer_id',$id);
        if($row) {
            $sql = "UPDATE majer SET majer_name = '$name' WHERE majer_id = '$id' ";
            $check = updateRow($sql);
            if($check) {
                $success_message = "Update Majer Success";
                header('refresh:2; url=' . BURLA . 'majers/');
            } else {
                $error_message = "Update Error";
                header('refresh:2; url=' . BURLA);
            }
        } else {
            $error_message = "This majer does not exist";
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