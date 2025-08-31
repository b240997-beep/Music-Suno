<?php
include('include/header.php');
include('config/config.php');
session_start();

// Fetch all songs ordered by published date
$songsQuery = "SELECT * FROM songs ORDER BY published_date DESC";
$songsResult = mysqli_query($conn, $songsQuery);
$songs = mysqli_fetch_all($songsResult, MYSQLI_ASSOC);
?>

<main>
    <?php if (empty($songs)) : ?>
        <h1>Welcome to Playlist Manager</h1>
        <p>Please contact the admin to upload the songs.</p>
    <?php else : ?>
        <div id="content" style="display: flex; gap: 20px;">
            
            <!-- Playlist Section (LEFT SIDEBAR) -->
            <div class="playlist" style="width: 250px; background: #1e1e1e; padding: 15px; border-radius: 8px;">
                <h3 style="margin-bottom: 10px;">Your Playlists</h3>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    $playlistsQuery = "SELECT * FROM playlists WHERE user_id = " . intval($_SESSION['user_id']);
                    $playlistsResult = mysqli_query($conn, $playlistsQuery);
                    
                    if (mysqli_num_rows($playlistsResult) > 0) {
                        echo "<ul style='list-style:none; padding:0;'>";
                        while ($playlist = mysqli_fetch_assoc($playlistsResult)) {
                            echo "<li style='margin-bottom:8px;'>
                                    <a href='playlist.php?id={$playlist['id']}' style='color:#1db954; text-decoration:none;'>
                                        " . htmlspecialchars($playlist['name']) . "
                                    </a>
                                  </li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p style='color:#aaa;'>No playlists created yet.</p>";
                    }
                    ?>
                <?php else: ?>
                    <p style="color:#aaa;">Login to see your playlists.</p>
                <?php endif; ?>
            </div>

            <!-- Trending / Recent Songs Section (RIGHT SIDE) -->
            <div class="trending" style="flex:1;">
                <h1>Recent Songs</h1>
                <div class="songs" style="display:flex;flex-wrap:wrap;gap:20px;">
                    <?php foreach ($songs as $song) : ?>
                        <div class="songs-card" style="width:200px;background:#1e1e1e;padding:10px;border-radius:8px;text-align:center;">
                            <?php if (!empty($song['cover_image'])) : ?>
                                <img src="<?php echo htmlspecialchars($song['cover_image']); ?>" alt="Cover" style="width:100%;height:200px;object-fit:cover;border-radius:5px;">
                            <?php else : ?>
                                <div style="width:100%;height:200px;background:#333;border-radius:5px;display:flex;align-items:center;justify-content:center;color:#777;">
                                    No Cover
                                </div>
                            <?php endif; ?>
                            <audio controls style="width:100%;margin-top:10px;">
                                <source src="<?php echo htmlspecialchars($song['audio_path']); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <p style="margin:8px 0 4px;"><?php echo htmlspecialchars($song['name']); ?></p>
                            <small><?php echo htmlspecialchars($song['artist']); ?></small>
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <form method="POST" action="php/add-to-playlist.php" style="margin-top:5px;">
                                    <input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
                                    <select name="playlist_id" required>
                                    <?php
                                    $playlistsQuery = "SELECT * FROM playlists WHERE user_id=" . $_SESSION['user_id'];
                                    $playlistsResult = mysqli_query($conn, $playlistsQuery);
                                    while ($playlist = mysqli_fetch_assoc($playlistsResult)) {
                                        echo "<option value='{$playlist['id']}'>" . htmlspecialchars($playlist['name']) . "</option>";
                                    }
                                    ?>
                                    </select>
                                    <button type="submit" style="background:none;border:none;color:#1db954;cursor:pointer;font-size:18px;">
                                        ➕
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Various Artists -->
                <h1 style="margin-top:40px;">Various Artists</h1>
                <div class="songs">
                    <?php
                    $artistsQuery = "SELECT DISTINCT artist FROM songs ORDER BY artist ASC";
                    $artistsResult = mysqli_query($conn, $artistsQuery);
                    while ($artistRow = mysqli_fetch_assoc($artistsResult)) :
                        $artist = $artistRow['artist'];
                        ?>
                        <div class="songs-card" style="width:100%;margin-bottom:30px;">
                            <h3><?php echo htmlspecialchars($artist); ?></h3>
                            <div style="display:flex;flex-wrap:wrap;gap:20px;">
                                <?php
                                $artistSongsQuery = "SELECT * FROM songs WHERE artist='" . mysqli_real_escape_string($conn, $artist) . "'";
                                $artistSongsResult = mysqli_query($conn, $artistSongsQuery);
                                while ($aSong = mysqli_fetch_assoc($artistSongsResult)) :
                                    ?>
                                    <div style="width:150px;background:#1e1e1e;padding:8px;border-radius:8px;text-align:center;">
                                        <?php if (!empty($aSong['cover_image'])) : ?>
                                            <img src="<?php echo htmlspecialchars($aSong['cover_image']); ?>" alt="Cover" style="width:100%;height:150px;object-fit:cover;border-radius:5px;">
                                        <?php else : ?>
                                            <div style="width:100%;height:150px;background:#333;border-radius:5px;display:flex;align-items:center;justify-content:center;color:#777;">
                                                No Cover
                                            </div>
                                        <?php endif; ?>
                                        <audio controls style="width:100%;margin-top:8px;">
                                            <source src="<?php echo htmlspecialchars($aSong['audio_path']); ?>" type="audio/mpeg">
                                        </audio>
                                        <p style="margin:6px 0;"><?php echo htmlspecialchars($aSong['name']); ?></p>
                                        <?php if (isset($_SESSION['user_id'])) : ?>
                                            <form method="POST" action="php/add-to-playlist.php" style="margin-top:5px;">
                                                <input type="hidden" name="song_id" value="<?php echo $aSong['id']; ?>">
                                                <button type="submit" style="background:none;border:none;color:#1db954;cursor:pointer;font-size:18px;">➕</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    <?php endif; ?>
</main>

<?php include("include/footer.php"); ?>
