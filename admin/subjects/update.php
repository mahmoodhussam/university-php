<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(!checkEmpty($_POST['subject_name'])) {
        $id = $_POST['subject_num'];
        $name = $_POST['subject_name'];
        $row = getRow('subjects','subject_num',$id);
        if($row) {
            $sql = "UPDATE subjects SET subject_name = '$name' WHERE subject_num = '$id' ";
            $check = updateRow($sql);
            if($check) {
                $success_message = "Update Majer Success";
                header('refresh:2; url=' . BURLA . 'subjects/');
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