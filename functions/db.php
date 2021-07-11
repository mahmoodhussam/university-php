<?php
    // connect with database
    $server = 'localhost';
    $user = 'mahmoud';
    $password = 'Mmahmood2';
    $dbname = 'university'; 
    $conn = mysqli_connect($server, $user, $password, $dbname);
    if(!$conn) {
        die("Error Connection with DataBase");
    }
    function insertRow($sql) {
        global $conn;
        $result = mysqli_query($conn, $sql);
        if($result) 
            return true;
        return false; 
    }
    function getRow($table, $col, $val) {
        global $conn;
        $sql = "SELECT * FROM `$table` WHERE `$col` = '$val'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $row = [];
            if(mysqli_num_rows($result) > 0) {
                $row[] = mysqli_fetch_assoc($result);
                return $row[0];
            } else {
                return false;
            }    
        }
        return false;
    }
    
    function getRows($table) {
        global $conn;
        $sql = "SELECT * FROM `$table`";
        $result = mysqli_query($conn, $sql); 
        if($result) {
            $rows = [];
            if(mysqli_num_rows($result) > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $rows;
            }
            return false;
        }
        return false;
    }

    function getRowsWithCondition($table, $col, $val) {
        global $conn;
        $sql = "SELECT * FROM `$table` WHERE `$col` = '$val'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $rows = [];
            if(mysqli_num_rows($result) > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $rows;
            }
            return false;
        }
        return false;
    }

    function updateRow($sql) {
        global $conn;
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        }
        return false;
    }

    function deleteRow($sql) {
        global $conn;
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        }
        return false;
    }
?>