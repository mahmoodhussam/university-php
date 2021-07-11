<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(!checkEmpty($_GET['num'])) {
        $subject_num = $_GET['num'];
        $check = getRow('subjects','subject_num',$subject_num);
        if($check) {
            $subject_name = $check['subject_name'];
        } else {
            header('location: '. BURLA);
        }
    } else {
        header('location: ' . BURLA );
    }

?>

<?php require(BLA.'inc/header.php'); ?>

<div class="container mt-5">
    <form class="mt-5" action="<?php echo BURLA . 'subjects/update.php' ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Subject Name</label>
            <input type="text" name="subject_name" value="<?php echo htmlspecialchars($subject_name); ?>"  class="form-control">
            <input type="hidden" name="subject_num" value="<?php echo $subject_num; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>