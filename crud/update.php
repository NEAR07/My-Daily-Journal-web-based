<?php
include('../config.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT entry_datetime, description FROM items WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_datetime = $_POST['entry_datetime'];
    $description = $_POST['description'];

    $sql = "UPDATE items SET entry_datetime='$entry_datetime', description='$description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../index.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333; /* Warna teks kembali ke hitam agar mudah terbaca */
        }
        .container {
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8); /* Transparansi latar belakang konten */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Update Item</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="entry_datetime">Entry Date Time:</label>
                    <input type="datetime-local" class="form-control" id="entry_datetime" name="entry_datetime" value="<?php echo $row['entry_datetime']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $row['description']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="read.php" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</body>
</html>
