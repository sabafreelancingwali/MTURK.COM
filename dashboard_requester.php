<?php
session_start();
include "config.php";
 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "requester") {
    echo "<script>alert('Access denied! Please login as requester'); window.location='login.php';</script>";
    exit();
}
 
$user_id = $_SESSION['user_id'];
$name    = $_SESSION['name'];
 
// Fetch tasks posted by requester
$sql = "SELECT * FROM tasks WHERE requester_id='$user_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Requester Dashboard</title>
  <style>
    body {font-family:Arial, sans-serif; background:#f7f9fc; margin:0; padding:0;}
    .navbar {background:#34495e; color:white; padding:15px; text-align:center;}
    .navbar h2 {margin:0;}
    .container {width:90%; margin:20px auto;}
    .card {background:white; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2); margin-bottom:20px;}
    h3 {margin-top:0; color:#2c3e50;}
    table {width:100%; border-collapse:collapse; margin-top:15px;}
    table th, table td {padding:12px; border:1px solid #ddd; text-align:center;}
    table th {background:#27ae60; color:white;}
    .btn {padding:10px 15px; border:none; border-radius:5px; cursor:pointer; color:white;}
    .logout {background:#e74c3c;}
    .logout:hover {background:#c0392b;}
    .post {background:#2980b9;}
    .post:hover {background:#1f6391;}
  </style>
  <script>
    function logout(){ window.location.href="logout.php"; }
    function postTask(){ window.location.href="post_task.php"; }
  </script>
</head>
<body>
  <div class="navbar">
    <h2>Welcome, <?php echo $name; ?> (Requester)</h2>
  </div>
  <div class="container">
    <div class="card">
      <button class="btn post" onclick="postTask()">+ Post New Task</button>
      <button class="btn logout" onclick="logout()">Logout</button>
    </div>
 
    <div class="card">
      <h3>Your Posted Tasks</h3>
      <table>
        <tr>
          <th>Title</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Assigned To</th>
          <th>Deadline</th>
        </tr>
        <?php while($row=$result->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $row['title']; ?></td>
            <td>$<?php echo $row['payment']; ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo $row['assigned_to'] ? $row['assigned_to'] : "Not Assigned"; ?></td>
            <td><?php echo $row['deadline']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</body>
</html>
