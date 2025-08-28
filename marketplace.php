<?php
session_start();
include "config.php";
 
// Only workers should access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "worker") {
    echo "<script>alert('Access denied! Please login as worker'); window.location='login.php';</script>";
    exit();
}
 
$user_id = $_SESSION['user_id'];
$name    = $_SESSION['name'];
 
// Accept task if worker clicks
if (isset($_GET['accept'])) {
    $task_id = intval($_GET['accept']);
    $update = "UPDATE tasks SET assigned_to='$user_id', status='in progress' 
               WHERE id='$task_id' AND assigned_to IS NULL";
    if ($conn->query($update)) {
        echo "<script>alert('Task accepted successfully!'); window.location='marketplace.php';</script>";
    } else {
        echo "<script>alert('Error accepting task');</script>";
    }
}
 
// Fetch all unassigned tasks
$sql = "SELECT t.id, t.title, t.description, t.payment, t.deadline, u.name as requester
        FROM tasks t 
        JOIN users u ON t.requester_id = u.id
        WHERE t.assigned_to IS NULL";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Task Marketplace</title>
  <style>
    body {font-family:Arial, sans-serif; background:#f4f7fb; margin:0; padding:0;}
    .navbar {background:#2c3e50; color:white; padding:15px; text-align:center;}
    .navbar h2 {margin:0;}
    .container {width:90%; margin:20px auto;}
    .card {background:white; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2); margin-bottom:20px;}
    h3 {margin-top:0; color:#2c3e50;}
    table {width:100%; border-collapse:collapse; margin-top:15px;}
    table th, table td {padding:12px; border:1px solid #ddd; text-align:center;}
    table th {background:#2980b9; color:white;}
    .btn {padding:8px 12px; border:none; border-radius:5px; cursor:pointer; color:white;}
    .accept {background:#27ae60;}
    .accept:hover {background:#1e8449;}
    .logout {background:#e74c3c;}
    .logout:hover {background:#c0392b;}
    .dashboard {background:#8e44ad;}
    .dashboard:hover {background:#71368a;}
  </style>
  <script>
    function logout(){ window.location.href="logout.php"; }
    function dashboard(){ window.location.href="dashboard_worker.php"; }
  </script>
</head>
<body>
  <div class="navbar">
    <h2>Task Marketplace - Welcome <?php echo $name; ?></h2>
  </div>
  <div class="container">
    <div class="card">
      <button class="btn dashboard" onclick="dashboard()">Go to Dashboard</button>
      <button class="btn logout" onclick="logout()">Logout</button>
    </div>
 
    <div class="card">
      <h3>Available Tasks</h3>
      <table>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Payment</th>
          <th>Deadline</th>
          <th>Requester</th>
          <th>Action</th>
        </tr>
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ ?>
            <tr>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['description']; ?></td>
              <td>$<?php echo $row['payment']; ?></td>
              <td><?php echo $row['deadline']; ?></td>
              <td><?php echo $row['requester']; ?></td>
              <td><a href="marketplace.php?accept=<?php echo $row['id']; ?>"><button class="btn accept">Accept</button></a></td>
            </tr>
        <?php }} else { ?>
            <tr><td colspan="6">No tasks available right now.</td></tr>
        <?php } ?>
      </table>
    </div>
  </div>
</body>
</html>
