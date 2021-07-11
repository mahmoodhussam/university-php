<?php
    require_once('../../config.php');
    $data = getRows('majer');
?>

<?php require(BLA.'inc/header.php') ?>
<div class="container mt-5">
    <table class="table mt-5">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Majer Name</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data)): ?>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['majer_id']); ?></td>
                <td><?php echo htmlspecialchars($row['majer_name']); ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo BURLA . 'majers/edit.php?id='. $row['majer_id'];?>">Edit</a>
                    <a class="btn btn-danger delete" data-id="<?php echo $row['majer_id']; ?>"
                        data-table="majer" data-field="majer_id" href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
        <?php endif ?>
    </tbody>
    </table>
</div>




<?php require(BLA.'inc/footer.php'); ?>