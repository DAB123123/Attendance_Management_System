<?php
ob_start();
session_start();

if($_SESSION['name'] != 'oasis') {
  header('location: login.php');
  exit(); // Stop further execution
}
?>

<?php include('connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Attendance Management System 1.0</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<header>
  <h1>Online Attendance Management System 1.0</h1>
  <div class="navbar">
    <a href="index.php">Home</a>
    <a href="students.php">Students</a>
    <a href="teachers.php">Faculties</a>
    <a href="attendance.php">Attendance</a>
    <a href="report.php">Report</a>
    <a href="../logout.php">Logout</a>
  </div>
</header>

<center>
<div class="row">
  <div class="content">
    <h3>Student List</h3>
    <br>
    <form method="post" action="">
      <label>Batch (ex. 2020)</label>
      <input type="text" name="sr_batch">
      <input type="submit" name="sr_btn" value="Go!">
    </form>
    <br>
    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Registration No.</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Batch</th>
          <th scope="col">Semester</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if(isset($_POST['sr_btn'])) {
        $srbatch = $_POST['sr_batch'];
        $stmt = $conn->prepare("SELECT * FROM students WHERE st_batch = :srbatch ORDER BY st_id ASC");
        $stmt->bindParam(':srbatch', $srbatch);
        $stmt->execute();
        $i = 0;
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $i++;
      ?>
        <tr>
          <td><?php echo $data['st_id']; ?></td>
          <td><?php echo $data['st_name']; ?></td>
          <td><?php echo $data['st_dept']; ?></td>
          <td><?php echo $data['st_batch']; ?></td>
          <td><?php echo $data['st_sem']; ?></td>
          <td><?php echo $data['st_email']; ?></td>
        </tr>
      <?php
        }
      }
      ?>
      </tbody>
    </table>
  </div>
</div>
</center>

</body>
</html>
