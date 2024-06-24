<?php
ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
    header('location: ../index.php');
    exit;
}

include('connect.php');

// Data insertion
try {
    // Checking if the data comes from the students form
    if (isset($_POST['std'])) {
        // Prepare statement for students data insertion to the "students" table
        $stmt = $conn->prepare("INSERT INTO students (st_id, st_name, st_dept, st_batch, st_sem, st_email) VALUES (:st_id, :st_name, :st_dept, :st_batch, :st_sem, :st_email)");
        $stmt->bindParam(':st_id', $_POST['st_id']);
        $stmt->bindParam(':st_name', $_POST['st_name']);
        $stmt->bindParam(':st_dept', $_POST['st_dept']);
        $stmt->bindParam(':st_batch', $_POST['st_batch']);
        $stmt->bindParam(':st_sem', $_POST['st_sem']);
        $stmt->bindParam(':st_email', $_POST['st_email']);
        $stmt->execute();
        $success_msg = "Student added successfully.";
    }

    // Checking if the data comes from the teachers form
    if (isset($_POST['tcr'])) {
        // Prepare statement for teachers data insertion to the "teachers" table
        $stmt = $conn->prepare("INSERT INTO teachers (tc_id, tc_name, tc_dept, tc_email, tc_course) VALUES (:tc_id, :tc_name, :tc_dept, :tc_email, :tc_course)");
        $stmt->bindParam(':tc_id', $_POST['tc_id']);
        $stmt->bindParam(':tc_name', $_POST['tc_name']);
        $stmt->bindParam(':tc_dept', $_POST['tc_dept']);
        $stmt->bindParam(':tc_email', $_POST['tc_email']);
        $stmt->bindParam(':tc_course', $_POST['tc_course']);
        $stmt->execute();
        $success_msg = "Teacher added successfully.";
    }
} catch (Exception $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System 1.0</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="styles.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.message {
    padding: 10px;
    font-size: 15px;
    font-style: bold;
    color: black;
}
</style>
</head>
<body>

<header>
    <h1>Online Attendance Management System 1.0</h1>
    <div class="navbar">
        <a href="signup.php">Create Users</a>
        <a href="index.php">Add Data</a>
        <a href="../logout.php">Logout</a>
    </div>
</header>

<center>
<div class="message">
    <?php if (isset($success_msg)) echo $success_msg; if (isset($error_msg)) echo $error_msg; ?>
</div>

<div class="content">
    <center> Select: <a href="#teacher">Teacher</a> | <a href="#student">Student</a> <br></center>

    <div class="row" id="student">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
            <h4>Add Student's Information</h4>
            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Reg. No.</label>
                <div class="col-sm-7">
                    <input type="text" name="st_id" class="form-control" id="input1" placeholder="student reg. no." required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-7">
                    <input type="text" name="st_name" class="form-control" id="input1" placeholder="student full name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Department</label>
                <div class="col-sm-7">
                    <input type="text" name="st_dept" class="form-control" id="input1" placeholder="department ex. CSE" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Batch</label>
                <div class="col-sm-7">
                    <input type="text" name="st_batch" class="form-control" id="input1" placeholder="batch e.x 2020" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Semester</label>
                <div class="col-sm-7">
                    <input type="text" name="st_sem" class="form-control" id="input1" placeholder="semester ex. Fall-15" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-7">
                    <input type="email" name="st_email" class="form-control" id="input1" placeholder="valid email" required>
                </div>
            </div>

            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Student" name="std">
        </form>
    </div>
    <br><br><br>
    <div class="rowtwo" id="teacher">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
            <h4>Add Teacher's Information</h4>
            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Teacher ID</label>
                <div class="col-sm-7">
                    <input type="text" name="tc_id" class="form-control" id="input1" placeholder="teacher's id" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-7">
                    <input type="text" name="tc_name" class="form-control" id="input1" placeholder="teacher full name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Department</label>
                <div class="col-sm-7">
                    <input type="text" name="tc_dept" class="form-control" id="input1" placeholder="department ex. CSE" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-7">
                    <input type="email" name="tc_email" class="form-control" id="input1" placeholder="valid email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">Subject Name</label>
                <div class="col-sm-7">
                    <input type="text" name="tc_course" class="form-control" id="input1" placeholder="subject ex. Software Engineering" required>
                </div>
            </div>

            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Add Teacher" name="tcr">
        </form>
    </div>
</div>
<br>
</center>
</body>
</html>
