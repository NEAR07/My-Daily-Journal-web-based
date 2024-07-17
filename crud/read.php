<?php
include('../config.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT id, entry_datetime, description FROM items ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Entries</title>
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
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            background-color: #fff; /* Latar belakang tabel putih */
        }
        .btn-custom {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Diary Entries</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Entry Date Time</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['entry_datetime'] . "</td>
                                <td>" . $row['description'] . "</td>
                                <td>
                                    <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm btn-custom'>Update</a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm btn-custom'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary btn-custom">Back to Home</a>
    </div>
</body>
</html>
