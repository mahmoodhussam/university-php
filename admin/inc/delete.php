<?php

    require('../../functions/db.php');
    $id = $_GET['id'];
    $field = $_GET['field'];
    $table = $_GET['table'];
    $sql = "DELETE FROM `$table` WHERE `$field` = '$id'";
    $check = deleteRow($sql);
    if($check) {
        $data['message'] = 'success';
    } else {
        $data['message'] = 'error';
    }
    echo json_encode($data);
?>