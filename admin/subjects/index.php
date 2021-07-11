<?php
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    $data_subjects = getRows('subjects');
    $data_majers = getRows('majer');
    if(isset($_POST['submit'])) {
        $majer_id = $_POST['majer_id'];
        if(!checkEmpty($majer_id)) {
            $data_subjects = getRowsWithCondition('subjects', 'subject_majer_id', $majer_id);   
        }
    }
?>

<?php require(BLA.'inc/header.php'); ?>
<div class="container mt-5 mb-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <select class="form-select mt-5 mb-5" name="majer_id" aria-label="Default select example">
                <option>------</option>
                <?php if($data_majers): ?>
                <?php foreach($data_majers as $majer): ?>
                    <option value="<?php echo $majer['majer_id']; ?>"><?php echo $majer['majer_name'] ;?></option>
                <?php endforeach; ?>
                <?php endif; ?>
        </select>
        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
    </form>
</div>
<div class="container mt-5">
    <table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Majer Name</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data_subjects)): ?>
        <?php foreach($data_subjects as $row): ?>
            <?php 
                $majer = getRow('majer','majer_id',$row['subject_majer_id']);
                $majer_name = $majer['majer_name'];    
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['subject_num']); ?></td>
                <td><?php echo htmlspecialchars($majer_name); ?></td>
                <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo BURLA .'subjects/edit.php?num=' . $row['subject_num']; ?>">Edit</a>
                    <a class="btn btn-danger delete" data-id="<?php echo $row['subject_num']; ?>" data-field="subject_num" data-table="subjects" href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
    </table>
</div>

<?php require(BLA.'inc/footer.php'); ?>