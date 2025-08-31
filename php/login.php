<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists
    $checkUser = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Start session and store user info
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            echo "<script>alert('Login successful!'); window.location.href = '../dashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid password.'); window.location.href = '../login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href = '../login.php';</script>";
    }
} else {
    header("Location: ../login.php");
}
?>
