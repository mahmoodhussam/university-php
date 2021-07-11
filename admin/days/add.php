<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['day_name'];
        if(!checkEmpty($name)) {
            $sql = "INSERT INTO days (`days_name`) VALUES('$name')";
            $isInsert = insertRow($sql);
            if($isInsert) {
                $success_message = "Add New Day";
                header('refresh:2; url =' . BURLA . 'days');
            } else {
                $error_message = "ERROR";
            }
        } else {
            $error_message = 'Please enter the day name';
        }
    }
?>
<?php require(BLA . 'inc/header.php'); ?>

<div class="container mt-5">
    <div class="container mt-5">
        <?php if(isset($error_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
        <?php } ?>
        <?php if(isset($success_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $success_message; ?></h3></div>
        <?php } ?>
    </div>
    <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="mb-3">
        <label for="day_name" class="form-label">Day Name</label>
        <input type="text" name="day_name" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<?php require(BLA . 'inc/footer.php'); ?>