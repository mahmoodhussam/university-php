<?php
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    $rows = getRows('majer');
    if(isset($_POST['submit'])) {
        $majer_id = $_POST['majer_id'];
        $name = $_POST['subject_name'];
        $number = $_POST['subject_number'];
        if(!checkEmpty($majer_id) && !checkEmpty($name) && !checkEmpty($number)) {
            $row = getRow('majer','majer_id',$majer_id);
            if($row) {
                if(!getRow('subjects','subject_num',$number)) {
                    $sql = "INSERT INTO subjects (subject_num, subject_name,subject_majer_id)
                    VALUES('$number','$name','$majer_id')";
                    $check = insertRow($sql);
                    if($check) {
                        $success_message = "Success";
                        header('refresh:2; url='. BURLA.'subjects');
                    } else {
                        $error_message = "ERROR";
                    }
                } else {
                    $error_message = "Subject number is exist";
                }
            } else {
                $error_message = "This majer does not exist";
            }
        } else {
            $error_message = "Please Fill All Fields";
        }
    }
?>

<?php require(BLA.'inc/header.php'); ?>
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
    <label for="majer">Majer</label>
    <select class="form-select mt-3 mb-5" name="majer_id" aria-label="Default select example">
            <option selected></option>
            <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <option value="<?php echo $row['majer_id']; ?>"><?php echo $row['majer_name'] ;?></option>
            <?php endforeach; ?>
            <?php endif; ?>
    </select>
    <div class="mb-3 mt-5">
        <label for="subject_name" class="form-label">Subject Name</label>
        <input type="text" name="subject_name" value="<?php echo $name ?? ''?>" class="form-control">
    </div>
    <div class="mb-3">
        <label for="subject_number" class="form-label">Subject Number</label>
        <input type="text" name="subject_number" value="<?php echo $number ?? ''?>" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>