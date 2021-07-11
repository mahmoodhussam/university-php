<?php
    require_once('config.php');
    require('functions/validate.php');
    $majer_id = $days_id = 0;
    $majers_data = getRows('majer');
    $subjects_data = getRows('subjects');
    $days_data = getRows('days');
    $tiems_data = getRows('times');

    if(isset($_POST['majer_id'])) {
        $student_name = $_POST['student_name'];
        $student_number = $_POST['student_number']; 
        $majer_id = $_POST['majer_id'];
        if(!checkEmpty($majer_id)) {
            $subjects_data = getRowsWithCondition('subjects','subject_majer_id',$majer_id);
        }
    }
    if(isset($_POST['days_id'])) {
        $days_id = $_POST['days_id'];
        $subject_num = $_POST['subject_num'];
        if(!checkEmpty($days_id)) {
            $tiems_data = getRowsWithCondition('times','time_days_id',$days_id);
        }
    }
    if(isset($_POST['submit_form'])) {
        $student_name = $_POST['student_name'];
        $student_number = $_POST['student_number'];
        $majer_id = $_POST['majer_id'];
        $subject_num = $_POST['subject_num'];
        $days_id = $_POST['days_id'];
        $time_id = $_POST['time_id'];
        if(!checkEmpty($student_name) && !checkEmpty($student_number) && !checkEmpty($majer_id) && !checkEmpty($subject_num) && !checkEmpty($days_id) && !checkEmpty($time_id)) {
            if(is_numeric($subject_num)) {
                $sql = "INSERT INTO registers (reg_name,reg_number,reg_majer_id,reg_subject_id,reg_days_id,reg_time_id) 
                VALUES('$student_name','$student_number','$majer_id','$subject_num','$days_id','$time_id')";
                $insert_result = insertRow($sql);
                if($insert_result) {
                    $success_message = "DONE";
                    header('refresh:3; url='. BURL);
                } else {
                    $error_message = "Not Validate Input";
                }
            } else {
                $error_message = "Student Number must be only numbers";
            }
        } else {
            $error_message = "Please Fill All Fields";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">   
                <a class="navbar-brand" href="<?php echo BURL ?>"><img src="<?php echo ASSESTS. 'images/BAU.jpg' ?>" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BURL; ?>"><h5>HOME</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BURL.'register.php'; ?>"><h5>Register</h5></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mt-5">
        <?php if(isset($error_message)) {?>
        <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
        <?php } ?>
        <?php if(isset($success_message)) {?>
        <div class="p-3 mb-2 bg-success text-center text-white"><h3><?php echo $success_message; ?></h3></div>
        <?php } ?>
    </div>
    <div class="container pt-5 mt-5 mb-5">
        <form id="report_filter" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-3">
                <label for="student_name" class="form-label">Student Name</label>
                <input type="text" name="student_name" value="<?php echo $student_name ?? '' ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label for="student_number" class="form-label">Student Number</label>
                    <input type="number" name="student_number" value="<?php echo $student_number ?>" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="majer_id" class="form-label">Majer Name</label>
                <select class="form-select" name="majer_id" onchange="document.getElementById('report_filter').submit();" aria-label="Default select example">
                    <option></option>
                    <?php if(isset($majers_data)): ?>
                        <?php foreach($majers_data as $majer): ?>
                            <option value="<?php echo $majer['majer_id'] ?>" <?php if($majer['majer_id'] == $majer_id) { ?> selected <?php } ?> ><?php echo $majer['majer_name']; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="subject_id" class="form-label">Subject Name</label>
                <select class="form-select" name="subject_num" aria-label="Default select example">
                    <option></option>
                    <?php if(isset($subjects_data)): ?>
                        <?php foreach($subjects_data as $subject): ?>
                            <option value="<?php echo $subject['subject_num']; ?>" <?php if($subject['subject_num'] == $subject_num) { ?> selected <?php } ?>><?php echo $subject['subject_name']; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="days_id" class="form-label">Days</label>
                <select class="form-select" name="days_id" onchange="document.getElementById('report_filter').submit();" aria-label="Default select example">
                    <option></option>
                    <?php if(isset($days_data)): ?>
                        <?php foreach($days_data as $days): ?>
                            <option value="<?php echo $days['days_id']; ?>" <?php if($days['days_id'] == $days_id) { ?> selected <?php } ?>><?php echo $days['days_name']; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="time_id" class="form-label">Time</label>
                <select class="form-select" name="time_id" aria-label="Default select example">
                    <option ></option>
                    <?php if(isset($tiems_data)): ?>
                        <?php foreach($tiems_data as $time): ?>
                            <option value="<?php echo $time['time_id']; ?>"><?php echo $time['time_period']; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <button type="submit" name="submit_form" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>