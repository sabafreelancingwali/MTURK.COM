<?php
include "config.php";
$tasks = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
  <title>MTurk Clone - Home</title>
  <style>
    body {font-family: Arial, sans-serif; margin:0; padding:0; background:#f4f6f8;}
    header {background:#2c3e50; color:white; padding:20px; text-align:center;}
    nav {margin:15px; text-align:center;}
    nav button {padding:10px 20px; margin:5px; border:none; border-radius:5px; cursor:pointer; background:#3498db; color:white; font-size:15px;}
    nav button:hover {background:#2980b9;}
    section {padding:20px;}
    .task-card {background:white; padding:15px; margin:10px auto; width:70%; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);}
    h2 {color:#2c3e50;}
  </style>
  <script>
    function go(page){ window.location.href = page; }
  </script>
</head>
<body>
  <header>
    <h1>Welcome to MTurk Clone</h1>
    <p>Earn money by completing small tasks online</p>
  </header>
  <nav>
    <button onclick="go('signup_worker.php')">Join as Worker</button>
    <button onclick="go('signup_requester.php')">Join as Requester</button>
    <button onclick="go('login.php')">Login</button>
  </nav>
  <section>
    <h2>Featured Tasks</h2>
    <?php while($row=$tasks->fetch_assoc()){ ?>
      <div class="task-card">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p><b>Pay:</b> $<?php echo $row['payment']; ?> | <b>Deadline:</b> <?php echo $row['deadline']; ?></p>
      </div>
    <?php } ?>
  </section>
</body>
</html>
