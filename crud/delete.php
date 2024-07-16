<?php
include('../config.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
