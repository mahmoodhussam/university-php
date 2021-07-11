<?php
    require_once('../../config.php');
    require(BL.'/functions/validate.php');
    $data_times = getRows('times');
    $data_days = getRows('days');
    if(isset($_POST['submit'])) {
        $days_id = $_POST['days_id'];
        if(!checkEmpty($days_id)) {
            $data_times = getRowsWithCondition('times', 'time_days_id', $days_id);   
        }
    }
?>

<?php require(BLA.'inc/header.php'); ?>
<div class="container mt-5 mb-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="days">Days</label>
        <select class="form-select mt-3 mb-5" name="days_id" aria-label="Default select example">
                <option>------</option>
                <?php if($data_days): ?>
                <?php foreach($data_days as $days): ?>
                    <option value="<?php echo $days['days_id']; ?>"><?php echo $days['days_name'] ;?></option>
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
            <th scope="col">Days Name</th>
            <th scope="col">Time Period</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data_times)): ?>
        <?php foreach($data_times as $row): ?>
            <?php 
                $days = getRow('days','days_id',$row['time_days_id']);
                $days_name = $days['days_name'];    
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['time_id']); ?></td>
                <td><?php echo htmlspecialchars($days_name); ?></td>
                <td><?php echo htmlspecialchars($row['time_period']); ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo BURLA . 'times/edit.php?id=' . $row['time_id']; ?>">Edit</a>
                    <a class="btn btn-danger delete" href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
    </table>
</div>

<?php require(BLA.'inc/footer.php'); ?>