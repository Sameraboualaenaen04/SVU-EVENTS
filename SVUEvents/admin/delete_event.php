<?php
session_start();
require __DIR__ . "/db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid event ID");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM events WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "Delete failed";
}
?>