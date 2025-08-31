<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $contact  = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already exists
    $checkUser = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href = '../register.php';</script>";
    } else {
        // Insert new user
        $insertQuery = "INSERT INTO users (name, email, password, contact)
                        VALUES ('$name', '$email', '$hashed_password', '$contact')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Registration successful!'); window.location.href = '../login.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to register.'); window.location.href = '../register.php';</script>";
        }
    }
} else {
    header("Location: ../register.php");
}
?>
