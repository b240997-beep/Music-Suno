<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("config/config.php");
include("include/header.php");

$user_id = $_SESSION['user_id'];

// Validate playlist ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p class='text-danger'>Invalid playlist ID.</p>";
    exit();
}

$playlist_id = intval($_GET['id']);

// Fetch playlist details and verify ownership
$playlist_query = "SELECT * FROM playlists WHERE id = $playlist_id AND user_id = $user_id LIMIT 1";
$playlist_result = mysqli_query($conn, $playlist_query);

if (mysqli_num_rows($playlist_result) === 0) {
    echo "<p class='text-danger'>Playlist not found or you don't have permission to view it.</p>";
    exit();
}

$playlist = mysqli_fetch_assoc($playlist_result);

// Fetch songs in this playlist
$songs_query = "
    SELECT s.*
    FROM songs s
    JOIN playlist_songs ps ON s.id = ps.song_id
    WHERE ps.playlist_id = $playlist_id
    ORDER BY ps.added_at DESC
";

$songs_result = mysqli_query($conn, $songs_query);
?>
<head>
    <meta charset="UTF-8" />
    <title><?php echo htmlspecialchars($playlist['name']); ?> - Playlist</title>
    <link rel="stylesheet" href="css/playlist.css" />
</head>

<div class="container my-4 text-white">
    <h2><?php echo htmlspecialchars($playlist['name']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($playlist['description'])); ?></p>
    <hr style="border-color:#444;">

    <?php if (mysqli_num_rows($songs_result) > 0): ?>
        <div class="row g-3">
            <?php while ($song = mysqli_fetch_assoc($songs_result)): ?>
                <div class="col-md-3">
                    <div style="background:#1e1e1e; padding:15px; border-radius:8px; text-align:center;">
                        <?php if (!empty($song['cover_image'])): ?>
                            <img src="<?php echo htmlspecialchars($song['cover_image']); ?>" alt="Cover" style="width:100%; height:180px; object-fit:cover; border-radius:5px;">
                        <?php else: ?>
                            <div style="width:100%; height:180px; background:#333; border-radius:5px; display:flex; align-items:center; justify-content:center; color:#777;">
                                No Cover
                            </div>
                        <?php endif; ?>
                        <audio controls style="width:100%; margin-top:10px;">
                            <source src="<?php echo htmlspecialchars($song['audio_path']); ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        <p style="margin:10px 0 4px;"><?php echo htmlspecialchars($song['name']); ?></p>
                        <small><?php echo htmlspecialchars($song['artist']); ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">No songs have been added to this playlist yet.</p>
    <?php endif; ?>
</div>

<?php include("include/footer.php"); ?>
