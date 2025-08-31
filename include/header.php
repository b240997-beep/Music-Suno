<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music Suno</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
      integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
  <header>
      <nav>
        <div id="logo">
          <div><i class="fa-solid fa-music"></i></div>
          <div>Music Suno</div>
        </div>

        <div class="search-bar">
          <div>
            <a href="index.php" class="href"><i class="fa-solid fa-house"></i></a>
          </div>
          <div>
            <input
              type="search" placeholder="What do you want to play ?">
          </div>
        </div>

        <div class="navbar">
          <?php if (isset($_SESSION['user_id'])): ?>
            <span>Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
            <a href="add-songs.php">Add a song</a>
          <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
          <?php endif; ?>
        </div>
      </nav>
  </header>
