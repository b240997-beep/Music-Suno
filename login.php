<?php
include("include/header.php");
?>

      <form action="php/login.php" method="POST">
        <h2>Login</h2>
        <label>Email:</label>
        <input type="email" name="email" required />

        <label>Password:</label>
        <input type="password" name="password" required />

        <button type="submit">Login</button>
        <p>New here?<a href="register.php">Register here</a></p>
      </form>
<?php
include("include/footer.php");
?>