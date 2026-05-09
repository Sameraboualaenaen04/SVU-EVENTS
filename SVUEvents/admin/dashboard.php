<?php
session_start();
require __DIR__ . "/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

/* =========================
   TOTAL EVENTS
========================= */
$countQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM events"
);

$totalEvents = mysqli_fetch_assoc($countQuery)['total'];

/* =========================
   LATEST EVENT
========================= */
$latestQuery = mysqli_query(
    $conn,
    "SELECT * FROM events
     ORDER BY event_date DESC
     LIMIT 1"
);

$latestEvent = mysqli_fetch_assoc($latestQuery);

/* =========================
   ALL EVENTS
========================= */
$events = mysqli_query(
    $conn,
    "SELECT * FROM events ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.dashboard-card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.stat-card{
    border-radius:15px;
    color:white;
    padding:25px;
}

.table img{
    width:70px;
    height:50px;
    object-fit:cover;
    border-radius:8px;
}

</style>

</head>

<body>

<div class="container py-5">

<!-- TOP BAR -->
<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="fw-bold">
لوحة التحكم
</h2>

<p class="text-muted">
مرحباً <?= $_SESSION["username"] ?>
</p>
</div>

<div>

<a href="add_event.php" class="btn btn-primary">
إضافة فعالية
</a>

<a href="../index.php" class="btn btn-danger">
تسجيل الخروج  و العودة الى الصفحة الرئيسية
</a>

</div>

</div>

<!-- STATS -->
<div class="row mb-4">

<div class="col-md-6 mb-3">

<div class="stat-card bg-primary">

<h5>
عدد الفعاليات
</h5>

<h1 class="fw-bold">
<?= $totalEvents ?>
</h1>

</div>

</div>

<div class="col-md-6 mb-3">

<div class="stat-card bg-success">

<h5>
    فعالية رائجة
</h5>

<h4 class="fw-bold">
<?= $latestEvent ? $latestEvent["title"] : "لا توجد فعاليات" ?>
</h4>

<p class="mb-0">
<?= $latestEvent ? $latestEvent["event_date"] : "" ?>
</p>

</div>

</div>

</div>

<!-- EVENTS TABLE -->
<div class="card dashboard-card">

<div class="card-body">

<h4 class="mb-4">
إدارة الفعاليات
</h4>

<table class="table table-hover align-middle text-center">

<thead class="table-dark">

<tr>
<th>الصورة</th>
<th>ID</th>
<th>العنوان</th>
<th>التصنيف</th>
<th>المكان</th>
<th>التاريخ</th>
<th>التحكم</th>
</tr>

</thead>

<tbody>

<?php while($event = mysqli_fetch_assoc($events)): ?>

<tr>

<td>

<?php if(!empty($event["image"])): ?>

<img src="../uploads/<?= $event["image"] ?>">

<?php else: ?>

لا يوجد

<?php endif; ?>

</td>

<td>
<?= $event["id"] ?>
</td>

<td>
<?= $event["title"] ?>
</td>

<td>
<?= $event["category"] ?>
</td>

<td>
<?= $event["location"] ?>
</td>

<td>
<?= $event["event_date"] ?>
</td>

<td>

<a
href="edit_event.php?id=<?= $event["id"] ?>"
class="btn btn-warning btn-sm"
>
تعديل
</a>

<a
href="delete_event.php?id=<?= $event["id"] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('هل تريد حذف الفعالية؟')"
>
حذف
</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>