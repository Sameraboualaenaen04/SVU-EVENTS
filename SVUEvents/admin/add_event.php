<?php
session_start();
require __DIR__ . "/db.php";


if (!isset($_SESSION["user_id"])) {
    header("Location: ../events.php");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $location = trim($_POST["location"]);
    $category = trim($_POST["category"]);
    $event_date = $_POST["event_date"];

    $imageName = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

    $uploadDir = "../uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);

    move_uploaded_file(
        $_FILES["image"]["tmp_name"],
        $uploadDir . $imageName
    );
}

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO events
        (title, description, location, category, event_date, image)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $title,
        $description,
        $location,
        $category,
        $event_date,
        $imageName
    );

    if (mysqli_stmt_execute($stmt)) {
        $success = "تم إضافة الفعالية بنجاح";
    } else {
        $error = "حدث خطأ";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>إضافة فعالية</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow p-4">

        <h2 class="mb-4 text-end">
            إضافة فعالية
        </h2>

        <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <input
                type="text"
                name="title"
                class="form-control mb-3"
                placeholder="عنوان الفعالية"
                required
            >

            <textarea
                name="description"
                class="form-control mb-3"
                placeholder="وصف الفعالية"
                rows="5"
                required
            ></textarea>

            <input
                type="text"
                name="location"
                class="form-control mb-3"
                placeholder="مكان الفعالية"
                required
            >

            <input
                type="text"
                name="category"
                class="form-control mb-3"
                placeholder="التصنيف"
                required
            >

            <input
                type="date"
                name="event_date"
                class="form-control mb-3"
                required
            >

            <input
                type="file"
                name="image"
                class="form-control mb-3"
            >

            <button class="btn btn-primary w-100">
                إضافة الفعالية
           </button>

           <br><br>

           <a class="btn btn-primary w-100" href="dashboard.php">
                الرجوع الى لوحة التحكم
           </a>

        </form>

    </div>

</div>

</body>
</html>