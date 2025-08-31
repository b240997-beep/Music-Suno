<?php
session_start();
include('../config/config.php');

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $song_id = intval($_POST['song_id']);
    $playlist_id = intval($_POST['playlist_id']);
    $user_id = $_SESSION['user_id'];

    // Check if playlist belongs to the logged-in user
    $checkPlaylist = mysqli_prepare($conn, "SELECT id FROM playlists WHERE id=? AND user_id=?");
    mysqli_stmt_bind_param($checkPlaylist, "ii", $playlist_id, $user_id);
    mysqli_stmt_execute($checkPlaylist);
    mysqli_stmt_store_result($checkPlaylist);

    if (mysqli_stmt_num_rows($checkPlaylist) === 0) {
        die("Invalid playlist or not authorized.");
    }

    // Avoid duplicate songs
    $checkSong = mysqli_prepare($conn, "SELECT id FROM playlist_songs WHERE playlist_id=? AND song_id=?");
    mysqli_stmt_bind_param($checkSong, "ii", $playlist_id, $song_id);
    mysqli_stmt_execute($checkSong);
    mysqli_stmt_store_result($checkSong);

    if (mysqli_stmt_num_rows($checkSong) > 0) {
        echo "Song already in playlist.";
    } else {
        // Add song
        $insert = mysqli_prepare($conn, "INSERT INTO playlist_songs (playlist_id, song_id) VALUES (?, ?)");
        mysqli_stmt_bind_param($insert, "ii", $playlist_id, $song_id);
        if (mysqli_stmt_execute($insert)) {
            echo "Song added to playlist!";
            
        } else {
            echo "Error adding song.";
        }
    }
}
?>
