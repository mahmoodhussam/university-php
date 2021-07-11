<?php
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    $rows = getRows('days');
    if(isset($_POST['submit'])) {
        $days_id = $_POST['days_id'];
        $period = $_POST['time_period'];
        if(!checkEmpty($days_id) && !checkEmpty($period)) {
            $row = getRow('days','days_id',$days_id);
            if($row) {
                    $sql = "INSERT INTO times (time_period,time_days_id)
                    VALUES('$period','$days_id')";
                    $check = insertRow($sql);
                    if($check) {
                        $success_message = "Success";
                        header('refresh:2; url='. BURLA.'times');
                    } else {
                        $error_message = "ERROR";
                    }
                } else {
                    $error_message = "Subject number is exist";
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
    <label for="select">Days</label>
    <select class="form-select mt-3 mb-5" name="days_id" aria-label="Default select example">
            <option selected></option>
            <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <option value="<?php echo $row['days_id']; ?>"><?php echo $row['days_name'] ;?></option>
            <?php endforeach; ?>
            <?php endif; ?>
    </select>
    <div class="mb-3 mt-5">
        <label for="time_period" class="form-label">Times Period</label>
        <input type="text" name="time_period" value="<?php echo $name ?? ''?>" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>