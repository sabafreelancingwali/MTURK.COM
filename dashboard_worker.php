<?php
session_start();
include "config.php";
 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "worker") {
    echo "<script>alert('Access denied! Please login as worker'); window.location='login.php';</script>";
    exit();
}
 
$user_id = $_SESSION['user_id'];
$name    = $_SESSION['name'];
 
// Fetch accepted/completed tasks
$sql = "SELECT * FROM tasks WHERE assigned_to='$user_id'";
$result = $conn->query($sql);
 
// Calculate earnings
$earning_sql = "SELECT SUM(payment) as total FROM tasks WHERE assigned_to='$user_id' AND status='completed'";
$earning_res = $conn->query($earning_sql);
$earning_row = $earning_res->fetch_assoc();
$total_earnings = $earning_row['total'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Worker Dashboard</title>
  <style>
    body {font-family:Arial, sans-serif; background:#eef2f7; margin:0; padding:0;}
    .navbar {background:#2c3e50; color:white; padding:15px; text-align:center;}
    .navbar h2 {margin:0;}
    .container {width:90%; margin:20px auto;}
    .card {background:white; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2); margin-bottom:20px;}
    h3 {margin-top:0; color:#2c3e50;}
    table {width:100%; border-collapse:collapse; margin-top:15px;}
    table th, table td {padding:12px; border:1px solid #ddd; text-align:center;}
    table th {background:#2980b9; color:white;}
    .btn {padding:10px 15px; border:none; border-radius:5px; cursor:pointer; color:white;}
    .logout {background:#e74c3c;}
    .logout:hover {background:#c0392b;}
  </style>
  <script>
    function logout(){ window.location.href="logout.php"; }
  </script>
</head>
<body>
  <div class="navbar">
    <h2>Welcome, <?php echo $name; ?> (Worker)</h2>
  </div>
  <div class="container">
    <div class="card">
      <h3>Your Earnings</h3>
      <p><b>Total Earnings:</b> $<?php echo number_format($total_earnings,2); ?></p>
      <button class="btn logout" onclick="logout()">Logout</button>
    </div>
 
    <div class="card">
      <h3>Your Tasks</h3>
      <table>
        <tr>
          <th>Task</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Deadline</th>
        </tr>
        <?php while($row=$result->fetch_assoc()){ ?>
          <tr>
            <td><?php echo $row['title']; ?></td>
            <td>$<?php echo $row['payment']; ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo $row['deadline']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</body>
</html>
