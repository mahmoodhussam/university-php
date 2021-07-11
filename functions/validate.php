<?php

    function checkEmpty($value) {
        if(empty($value)) {
            return true;
        } 
        return false;
    }

    function checkEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    

?>