<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(is_numeric($_GET['id']) && !checkEmpty($_GET['id'])) {
        $days_id = $_GET['id'];
        $check = getRow('days','days_id',$days_id);
        if($check) {
            $days_name = $check['days_name'];
        } else {
            header('location: '. BURLA);
        }
    } else {
        header('location: ' . BURLA );
    }

?>

<?php require(BLA.'inc/header.php'); ?>

<div class="container mt-5">
    <form class="mt-5" action="<?php echo BURLA . 'days/update.php' ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Day Name</label>
            <input type="text" name="days_name" value="<?php echo htmlspecialchars($days_name); ?>"  class="form-control">
            <input type="hidden" name="days_id" value="<?php echo $days_id; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>