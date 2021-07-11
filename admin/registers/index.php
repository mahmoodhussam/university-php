<?php 
    require_once('../../config.php'); 
    require(BL.'/functions/validate.php');
?>
<?php
    $majer_id = $subject_num = $days_id =  $time_id  = 0;
    $days_data = getRows('days');
    $times_data = getRows('times');
    $majers_data = getRows('majer');
    $subjects_data = getRows('subjects');
    if(isset($_POST['majer_id'])) {
        $majer_id = $_POST['majer_id'];
        $subjects_data = getRowsWithCondition('subjects','subject_majer_id',$majer_id);
    }
    if(isset($_POST['days_id'])) {
        $days_id = $_POST['days_id'];
        $subject_num = $_POST['subject_num'];
        $times_data = getRowsWithCondition('times','time_days_id',$days_id);
    }
    if(isset($_POST['search'])) {
        $majer_id = $_POST['majer_id']; 
        $subject_num = $_POST['subject_num'];
        $days_id = $_POST['days_id'];
        $time_id = $_POST['time_id'];
        if(!checkEmpty($majer_id) && !checkEmpty($subject_num)) {
            global $conn;
            $sql = "SELECT * FROM registers WHERE reg_majer_id = '$majer_id' and reg_subject_id = '$subject_num' 
            and reg_days_id = '$days_id' and reg_time_id = '$time_id'";
            $result = mysqli_query($conn, $sql);
            $data_registers = [];
            if($result) {
                if(mysqli_num_rows($result) > 0) {
                    $data_registers = mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            }
        } else {
           echo "Please Fill All Fields";
        }
    }

?>
    <?php require(BLA.'inc/header.php'); ?>
    <div class="container">
        <div class="container mt-5">
            <?php if(isset($error_message)) {?>
            <div class="p-3 mb-2 bg-danger text-center text-white"><h3><?php echo $error_message; ?></h3></div>
            <?php } ?>
            <?php if(isset($success_message)) {?>
            <div class="p-3 mb-2 bg-success text-center text-white"><h3><?php echo $success_message; ?></h3></div>
            <?php } ?>
        </div>
    </div>
    <div class="container mt-5 pt-5"> 
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="report_filter" method="POST">
        <label class="mb-3" for="majer_id">Majer Name</label>
        <select class="form-select mb-5" name="majer_id" onchange="document.getElementById('report_filter').submit()" aria-label="Default select example">
            <option></option>
            <?php if(isset($majers_data)): ?>
                <?php foreach($majers_data as $majers):?>
                    <option value="<?php echo $majers['majer_id']; ?>" <?php if($majers['majer_id'] == $majer_id){ ?> selected <?php }?>><?php echo $majers['majer_name']; ?></option>
                <?php endforeach;?>
            <?php endif?>
        </select>
        <label class="mb-3" for="subject_num">Subject Name</label>
        <select class="form-select mb-5" name="subject_num" aria-label="Default select example">
            <option></option>
            <?php if(isset($subjects_data)): ?>
                <?php foreach($subjects_data as $subjects):?>
                    <option value="<?php echo $subjects['subject_num']; ?>" <?php if($subjects['subject_num'] == $subject_num){ ?> selected <?php } ?> ><?php echo $subjects['subject_name']; ?></option>
                <?php endforeach;?>
            <?php endif?>
        </select>
        <label class="mb-3" for="days_id">Days Name</label>
        <select class="form-select mb-5" name="days_id" onchange="document.getElementById('report_filter').submit()" aria-label="Default select example">
            <option></option>
            <?php if(isset($days_data)): ?>
                <?php foreach($days_data as $days):?>
                    <option value="<?php echo $days['days_id']; ?>" <?php if($days['days_id'] == $days_id){ ?> selected <?php } ?> ><?php echo $days['days_name']; ?></option>
                <?php endforeach;?>
            <?php endif?>
        </select>
        <label class="mb-3" for="subject_num">Subject Name</label>
        <select class="form-select mb-5"  name="time_id" aria-label="Default select example">
            <option></option>
            <?php if(isset($times_data)): ?>
                <?php foreach($times_data as $times):?>
                    <option value="<?php echo $times['time_id']; ?>" <?php if($times['time_id'] == $time_id){ ?> selected <?php } ?> ><?php echo $times['time_period']; ?></option>
                <?php endforeach;?>
            <?php endif?>
        </select>
        <button type="search" name="search" class="btn btn-primary">Search</button>
    </form>
    </div>
    <div class="container mt-5">
        <table class="table" id="info-table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Majer</th>
            <th scope="col">Subject</th>
            <th scope="col">Days</th>
            <th scope="col">Times</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data_registers)): ?> 
            <?php foreach($data_registers as $data): ?>  
                <?php
                    $reg_majer_data = getRow('majer','majer_id',$majer_id);
                    $reg_subject_data = getRow('subjects','subject_num',$subject_num);
                    $reg_days_data = getRow('days','days_id',$days_id);
                    $reg_time_data = getRow('times','time_id',$time_id);
                ?>
                    <tr>
                        <td><?php echo $data['reg_number']; ?></td>
                        <td><?php echo $data['reg_name'] ?></td>
                        <td><?php echo $reg_majer_data['majer_name'] ?></td>
                        <td><?php echo $reg_subject_data['subject_name'] ?></td>
                        <td><?php echo $reg_days_data['days_name'] ?></td>
                        <td><?php echo $reg_time_data['time_period'] ?></td>
                    </tr>
                <?php endforeach; ?>    
                <?php endif;?>
        </tbody>
        </table>
        <button class="btn btn-success mt-5 mb-5" onclick="fnExcelReport()">Dowload</button>
    </div>
    <?php require(BLA.'inc/footer.php');?>