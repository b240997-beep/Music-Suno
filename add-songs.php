<?php include("include/header.php"); ?>
  <form action="php/add-songs.php" method="POST" enctype="multipart/form-data" class="form-container">
    <h2>Add New Song</h2>

    <label>Song Name:</label>
    <input type="text" name="name" required>

    <label>Genre:</label>
    <input type="text" name="genre" required>

    <label>Artist:</label>
    <input type="text" name="artist" required>

    <label>Date of Publish:</label>
    <input type="date" name="publish_date" required>

    <label for="cover_image">Upload Cover Image:</label>
    <input type="file" name="cover_image" accept=".jpg,.jpeg,.png,.gif" required>

    <label>Upload Audio File:</label>
    <input type="file" name="audio" accept="audio/*" required>

    <button type="submit">Add Song</button>
  </form>

  <style>
    .form-container {
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      background: #1e1e1e;
      border-radius: 10px;
      color: #fff;
      font-family: Arial, sans-serif;
      box-shadow: 0px 0px 10px rgba(255,255,255,0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    .form-container input {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border-radius: 5px;
      border: none;
      outline: none;
    }

    .form-container input[type="file"] {
      background: #fff;
      color: #000;
    }

    .form-container button {
      width: 100%;
      padding: 10px;
      background: #ff6600;
      border: none;
      color: white;
      font-weight: bold;
      margin-top: 15px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .form-container button:hover {
      background: #e65c00;
    }
  </style>
<?php include("include/footer.php"); ?>
