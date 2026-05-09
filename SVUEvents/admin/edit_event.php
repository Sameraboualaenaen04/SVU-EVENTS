<?php
session_start();

require __DIR__ . "/db.php";

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");

$event = mysqli_fetch_assoc($query);

if (!$event) {
    die("Event not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $category = $_POST["category"];
    $event_date = $_POST["event_date"];

    mysqli_query(
        $conn,
        "UPDATE events SET
        title='$title',
        description='$description',
        location='$location',
        category='$category',
        event_date='$event_date'
        WHERE id=$id"
    );

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>تعديل فعالية</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow p-4">

<h2 class="mb-4">تعديل فعالية</h2>

<form method="POST">

<input
type="text"
name="title"
class="form-control mb-3"
value="<?= $event['title'] ?>"
required
>

<textarea
name="description"
class="form-control mb-3"
rows="5"
required
><?= $event['description'] ?></textarea>

<input
type="text"
name="location"
class="form-control mb-3"
value="<?= $event['location'] ?>"
required
>

<input
type="text"
name="category"
class="form-control mb-3"
value="<?= $event['category'] ?>"
required
>

<input
type="date"
name="event_date"
class="form-control mb-3"
value="<?= $event['event_date'] ?>"
required
>

<button class="btn btn-success w-100">
حفظ التعديلات
</button>

</form>

</div>

</div>

</body>
</html>