<?php
include "config.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
    // Insert into users table
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$pass', 'worker')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup successful! Please login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: ".$conn->error."');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Worker Signup</title>
  <style>
    body {font-family: Arial, sans-serif; background:#f4f6f8; margin:0; padding:0;}
    .container {width:40%; margin:60px auto; background:white; padding:25px; border-radius:12px;
                box-shadow:0 4px 10px rgba(0,0,0,0.2);}
    h2 {text-align:center; color:#2c3e50;}
    input {width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:6px; font-size:15px;}
    button {width:100%; padding:12px; background:#3498db; border:none; border-radius:6px;
            color:white; font-size:16px; cursor:pointer;}
    button:hover {background:#2980b9;}
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
    <h2>Join as Worker</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign Up</button>
    </form>
    <div class="back">
      <button onclick="goHome()">Back to Home</button>
    </div>
  </div>
</body>
</html>
 
