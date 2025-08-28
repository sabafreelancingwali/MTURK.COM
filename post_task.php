
<?php
include "config.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $pay = $_POST['payment'];
  $deadline = $_POST['deadline'];
  $conn->query("INSERT INTO tasks(title,description,payment,deadline) VALUES('$title','$desc','$pay','$deadline')");
  echo "<script>alert('Task posted successfully!'); window.location='marketplace.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Post a Task</title>
  <style>
    body {font-family:Arial; background:#f4f6f8;}
    .container {width:50%; margin:40px auto; background:white; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.2);}
    h2 {text-align:center; color:#2c3e50;}
    input,textarea {width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px;}
    button {background:#27ae60; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;}
    button:hover {background:#219150;}
  </style>
</head>
<body>
  <div class="container">
    <h2>Post a New Task</h2>
    <form method="POST">
      <input type="text" name="title" placeholder="Task Title" required>
      <textarea name="description" placeholder="Task Description" required></textarea>
      <input type="number" name="payment" placeholder="Payment ($)" required>
      <input type="date" name="deadline" required>
      <button type="submit">Post Task</button>
    </form>
  </div>
</body>
</html>
