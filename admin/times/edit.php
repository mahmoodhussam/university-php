<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(!checkEmpty($_GET['id'])) {
        $time_id = $_GET['id'];
        $check = getRow('times','time_id',$time_id);
        if($check) {
            $time_period = $check['time_period'];
        } else {
            header('location: '. BURLA);
        }
    } else {
        header('location: ' . BURLA );
    }

?>

<?php require(BLA.'inc/header.php'); ?>

<div class="container mt-5">
    <form class="mt-5" action="<?php echo BURLA . 'times/update.php' ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Time Period</label>
            <input type="text" name="time_period" value="<?php echo htmlspecialchars($time_period); ?>"  class="form-control">
            <input type="hidden" name="time_id" value="<?php echo $time_id; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>