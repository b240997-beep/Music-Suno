<?php include("include/header.php"); ?>
  <form action="php/register.php" method="POST">
    <h2>Register</h2>

    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Contact:</label>
    <input type="text" name="contact" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Register</button>
    <p>Already registered? <a href="login.php">Login</a></p>
  </form>
<?php include("include/footer.php"); ?>
