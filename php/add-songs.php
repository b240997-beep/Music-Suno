<?php
include("../config/config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name          = mysqli_real_escape_string($conn, $_POST['name']);
    $genre         = mysqli_real_escape_string($conn, $_POST['genre']);
    $artist        = mysqli_real_escape_string($conn, $_POST['artist']);
    $publish_date  = mysqli_real_escape_string($conn, $_POST['publish_date']);


    // ===== Handle Audio Upload =====
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {
        $allowed_audio_ext = ['mp3', 'wav', 'ogg', 'm4a'];
        $audio_name   = $_FILES['audio']['name'];
        $audio_tmp    = $_FILES['audio']['tmp_name'];
        $audio_size   = $_FILES['audio']['size'];
        $audio_ext    = strtolower(pathinfo($audio_name, PATHINFO_EXTENSION));

        if (!in_array($audio_ext, $allowed_audio_ext)) {
            echo "<script>alert('Invalid audio format! Only MP3, WAV, OGG, M4A allowed.'); window.location.href='../add-songs.php';</script>";
            exit;
        }

        if ($audio_size > 20 * 1024 * 1024) { // 20MB limit
            echo "<script>alert('Audio file too large! Maximum size is 20MB.'); window.location.href='../add-songs.php';</script>";
            exit;
        }

        $audio_dir = "../uploads/audio/";
        if (!is_dir($audio_dir)) mkdir($audio_dir, 0777, true);

        $new_audio_name = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $audio_name);
        $audio_path = $audio_dir . $new_audio_name;

        if (!move_uploaded_file($audio_tmp, $audio_path)) {
            echo "<script>alert('Error uploading audio file.'); window.location.href='../add-songs.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please upload an audio file.'); window.location.href='../add-songs.php';</script>";
        exit;
    }
    echo "Hiii";
    // ===== Handle Cover Image Upload =====
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $allowed_img_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $img_name   = $_FILES['cover_image']['name'];
        $img_tmp    = $_FILES['cover_image']['tmp_name'];
        $img_size   = $_FILES['cover_image']['size'];
        $img_ext    = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

        if (!in_array($img_ext, $allowed_img_ext)) {
            echo "<script>alert('Invalid image format! Only JPG, JPEG, PNG, GIF allowed.'); window.location.href='../add-songs.php';</script>";
            exit;
        }

        if ($img_size > 5 * 1024 * 1024) { // 5MB limit
            echo "<script>alert('Image file too large! Maximum size is 5MB.'); window.location.href='../add-songs.php';</script>";
            exit;
        }

        $img_dir = "../uploads/images/";
        if (!is_dir($img_dir)) mkdir($img_dir, 0777, true);

        $new_img_name = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $img_name);
        $img_path = $img_dir . $new_img_name;

        if (!move_uploaded_file($img_tmp, $img_path)) {
            echo "<script>alert('Error uploading cover image.'); window.location.href='../add-songs.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please upload a cover image.'); window.location.href='../add-songs.php';</script>";
        exit;
    }
    echo "Hiii";
    // ===== Store in Database =====
    $audio_db_path = "uploads/audio/" . $new_audio_name;
    $img_db_path   = "uploads/images/" . $new_img_name;

    $insertQuery = "INSERT INTO songs (name, genre, artist, published_date, audio_path, cover_image)
                    VALUES ('$name', '$genre', '$artist', '$publish_date', '$audio_db_path', '$img_db_path')";
    var_dump($insertQuery);
    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Song added successfully!'); window.location.href='../add-songs.php';</script>";
    } else {
        echo "<script>alert('Database error: Unable to add song.'); window.location.href='../add-songs.php';</script>";
    }
} else {
    header("Location: ../add-songs.php");
}
?>
