<?php 
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    if(is_numeric($_GET['id']) && !checkEmpty($_GET['id'])) {
        $majer_id = $_GET['id'];
        $check = getRow('majer','majer_id',$_GET['id']);
        if($check) {
            $majer_name = $check['majer_name'];
        } else {
            header('location: '. BURLA);
        }
    } else {
        header('location: ' . BURLA );
    }

?>

<?php require(BLA.'inc/header.php'); ?>

<div class="container mt-5">
    <form class="mt-5" action="<?php echo BURLA . 'majers/update.php' ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Majer Name</label>
            <input type="text" name="majer_name" value="<?php echo htmlspecialchars($majer_name); ?>"  class="form-control">
            <input type="hidden" name="majer_id" value="<?php echo $majer_id; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php require(BLA.'inc/footer.php'); ?>