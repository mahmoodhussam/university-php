<?php
    require_once('../../config.php');
    
    $data = getRows('days');
?>
<?php require(BLA.'inc/header.php'); ?>

<div class="container mt-5">
    <table class="table mt-5">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Days Name</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data)): ?>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['days_id']); ?></td>
                <td><?php echo htmlspecialchars($row['days_name']); ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo BURLA . 'days/edit.php?id='. $row['days_id'];?>">Edit</a>
                    <a class="btn btn-danger delete" data-id="<?php echo $row['days_id']; ?>"
                        data-table="days" data-field="days_id" href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
    </table>
</div>


<?php require(BLA.'inc/footer.php'); ?>
