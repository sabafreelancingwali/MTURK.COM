?php
session_start();
include "config.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass  = $_POST['password'];
 
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role']    = $row['role'];
            $_SESSION['name']    = $row['name'];
 
            if ($row['role'] == "worker") {
                echo "<script>alert('Login successful! Redirecting...'); window.location='dashboard_worker.php';</script>";
            } else {
                echo "<script>alert('Login successful! Redirecting...'); window.location='dashboard_requester.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {font-family: Arial, sans-serif; background:#f0f3f7; margin:0; padding:0;}
    .container {width:40%; margin:60px auto; background:white; padding:25px; border-radius:12px;
                box-shadow:0 4px 10px rgba(0,0,0,0.2);}
    h2 {text-align:center; color:#2c3e50;}
    input {width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:6px; font-size:15px;}
    button {width:100%; padding:12px; background:#2980b9; border:none; border-radius:6px;
            color:white; font-size:16px; cursor:pointer;}
    button:hover {background:#1f6391;}
    .back {margin-top:15px; text-align:center;}
    .back button {background:#95a5a6;}
    .back button:hover {background:#7f8c8d;}
  </style>
  <script>
    function goHome(){ window.location.href = "index.php"; }
  </script>
</head>
<body>
  <div class="container">
    <h2>User Login</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="back">
      <button onclick="goHome()">Back to Home</button>
    </div>
  </div>
</body>
</html>
 
