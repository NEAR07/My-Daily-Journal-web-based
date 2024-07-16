<?php
include('../config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_datetime = $_POST['entry_datetime'];
    $description = $_POST['description'];

    // Gunakan prepared statement untuk keamanan
    $sql = "INSERT INTO items (entry_datetime, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $entry_datetime, $description);

    if ($stmt->execute()) {
        header("Location: create.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('../index.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333; /* Warna teks kembali ke hitam */
            padding-top: 50px; /* untuk mengatur jarak atas */
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8); /* transparansi latar belakang form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create a Diary</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="entry_datetime">Entry Date Time:</label>
                <input type="datetime-local" class="form-control" id="entry_datetime" name="entry_datetime" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="../index.php" class="btn btn-secondary">Back to Home</a>
        </form>
    </div>
</body>
</html>
