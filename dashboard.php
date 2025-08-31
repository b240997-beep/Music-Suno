<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("config/config.php");
include("include/header.php");

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Default avatar if none set
$avatar = !empty($user['avatar']) ? $user['avatar'] : 'default-avatar.png';

// Fetch playlists with song count
$playlist_query = "
    SELECT p.id, p.name, p.description, p.created_at, COUNT(ps.song_id) AS song_count
    FROM playlists p
    LEFT JOIN playlist_songs ps ON p.id = ps.playlist_id
    WHERE p.user_id = '$user_id'
    GROUP BY p.id, p.name, p.description, p.created_at
    ORDER BY p.created_at DESC
";
$playlist_result = mysqli_query($conn, $playlist_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
        }
        .sidebar {
            background-color: #1f1f1f;
            padding: 20px;
            height: 100vh;
        }
        .playlist-card {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            color: white;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }
        .playlist-card:hover {
            transform: scale(1.05);
        }
        .add-playlist-btn {
            border: 2px dashed #888;
            background: transparent;
            color: #888;
            font-size: 1.5rem;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        .add-playlist-btn:hover {
            border-color: white;
            color: white;
            background: rgba(255,255,255,0.05);
        }
        img.avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-md-3 sidebar text-center">
            <img src="uploads/avatars/<?php echo htmlspecialchars($avatar); ?>" 
                 alt="Avatar" class="img-fluid rounded-circle mb-3 avatar">
            <h4><?php echo htmlspecialchars($user['name']); ?></h4>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
            <p><?php echo htmlspecialchars($user['contact']); ?></p>
            <a href="logout.php" class="btn btn-danger btn-sm mt-3">Logout</a>
        </div>

        <!-- Right Content -->
        <div class="col-md-9 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Your Playlists</h3>
                <div class="add-playlist-btn" data-bs-toggle="modal" data-bs-target="#addPlaylistModal">+</div>
            </div>
            
            <div class="row g-3">
                <?php if (mysqli_num_rows($playlist_result) > 0): ?>
                    <?php while ($playlist = mysqli_fetch_assoc($playlist_result)): ?>
                        <div class="col-md-4">
                            <div class="playlist-card" onclick="window.location.href='playlist.php?id=<?php echo $playlist['id']; ?>'">
                                <h5><?php echo htmlspecialchars($playlist['name']); ?></h5>
                                <p><?php echo $playlist['song_count'] ?? 0; ?> Songs</p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">You haven't created any playlists yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Add Playlist Modal -->
<div class="modal fade" id="addPlaylistModal" tabindex="-1" aria-labelledby="addPlaylistModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="create_playlist.php">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="addPlaylistModalLabel">Create New Playlist</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="playlistName" class="form-label">Playlist Name</label>
            <input type="text" class="form-control" id="playlistName" name="playlist_name" required>
          </div>
          <div class="mb-3">
            <label for="playlistDescription" class="form-label">Description (optional)</label>
            <textarea class="form-control" id="playlistDescription" name="playlist_description" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
