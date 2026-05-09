<?php

$pageTitle = "تفاصيل الفعالية";

/*
====================================================
  DATABASE CONNECTION
====================================================
*/
include __DIR__ . '/admin/db.php';

/*
====================================================
  GET EVENT ID
====================================================
*/
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid event ID");
}

/*
====================================================
  GET EVENT FROM DATABASE
====================================================
*/
$stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found");
}

/*
====================================================
  GET SIMILAR EVENTS (same category)
====================================================
*/
$category = $event['category'];

$stmt2 = mysqli_prepare(
    $conn,
    "SELECT * FROM events 
     WHERE category = ? AND id != ? 
     ORDER BY event_date DESC 
     LIMIT 6"
);

mysqli_stmt_bind_param($stmt2, "si", $category, $id);
mysqli_stmt_execute($stmt2);

$similarEvents = mysqli_stmt_get_result($stmt2);

include 'includes/header.php';

?>

<div class="bg-light py-2 border-bottom">
    <div class="container" dir="rtl">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">

                <li class="breadcrumb-item">
                    <a href="index.php">الرئيسية</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="events.php">الفعاليات</a>
                </li>

                <li class="active">
                    <?= htmlspecialchars($event['title']) ?>
                </li>

            </ol>
        </nav>

    </div>
</div>

<!-- تفاصيل الفعالية -->
<section class="py-5">
    <div class="container">

        <div class="row g-4">

            <!-- المحتوى الرئيسي -->
            <div class="col-lg-8">

                <!-- صورة الفعالية -->
                <?php if (!empty($event['image'])): ?>

                    <img src="uploads/<?= htmlspecialchars($event['image']) ?>"
                         class="event-detail-img mb-4">

                <?php else: ?>

                    <div class="event-detail-img d-flex align-items-center justify-content-center bg-light mb-4"
                         style="height:300px; border-radius:12px;">

                        <div class="text-center">
                            <i class="bi bi-image" style="font-size:3.5rem;"></i>
                            <p class="mt-2 small">ستظهر صورة الفعالية هنا</p>
                        </div>

                    </div>

                <?php endif; ?>

                <!-- العنوان والتصنيف -->
                <div class="mb-3 text-end">

                    <span class="badge bg-primary mb-2 align-self-end">
                        <?= htmlspecialchars($event['category']) ?>
                    </span>

                    <h1 class="h2 fw-bold">
                        <?= htmlspecialchars($event['title']) ?>
                    </h1>

                </div>

                <!-- وصف الفعالية -->
                <div class="card border-0 shadow-sm p-4 mb-4 text-end">

                    <h5 class="fw-semibold mb-3">
                        حول هذه الفعالية
                    </h5>

                    <p class="lh-lg">
                        <?= nl2br(htmlspecialchars($event['description'])) ?>
                    </p>

                </div>

                <!-- الأزرار -->
                <div class="d-flex flex-wrap gap-2 justify-content-end">


                    <button class="btn btn-outline-primary" onclick="shareEvent()">
                        مشاركة
                        <i class="bi bi-share ms-2"></i>
                    </button>

                    <a href="events.php" class="btn btn-outline-secondary">
                        العودة للفعاليات
                        <i class="bi bi-arrow-left ms-2"></i>
                    </a>

                </div>

            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm p-4 mb-4 text-end">

                    <h5 class="fw-semibold mb-3">
                        معلومات الفعالية
                    </h5>

                    <div class="event-meta-item d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-calendar-event"></i>
                        <div>
                            <small class="d-block">التاريخ</small>
                            <strong><?= htmlspecialchars($event['event_date']) ?></strong>
                        </div>
                    </div>

                    <div class="event-meta-item d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <small class="d-block">المكان</small>
                            <strong><?= htmlspecialchars($event['location']) ?></strong>
                        </div>
                    </div>

                    <div class="event-meta-item d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-tag"></i>
                        <div>
                            <small class="d-block">التصنيف</small>
                            <strong><?= htmlspecialchars($event['category']) ?></strong>
                        </div>
                    </div>

                    <div class="event-meta-item d-flex align-items-start gap-3">
                        <i class="bi bi-hash"></i>
                        <div>
                            <small class="d-block">رقم الفعالية</small>
                            <strong>#<?= $event['id'] ?></strong>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- الفعاليات المشابهة -->
<section class="py-4 bg-light">
    <div class="container">

        <h2 class="section-title text-end">
            الفعاليات المشابهة
            <i class="bi bi-grid ms-2"></i>
        </h2>

        <div class="row g-4">

            <?php while ($sim = mysqli_fetch_assoc($similarEvents)): ?>

                <div class="col-sm-6 col-md-4">

                    <div class="card event-card h-100">

                        <div class="card-body text-end">

                            <span class="badge bg-secondary mb-2">
                                <?= htmlspecialchars($sim['category']) ?>
                            </span>

                            <h6 class="card-title fw-semibold">
                                <?= htmlspecialchars($sim['title']) ?>
                            </h6>

                            <p class="small mb-1">
                                <?= htmlspecialchars($sim['location']) ?>
                            </p>

                            <p class="small mb-3">
                                <?= htmlspecialchars($sim['event_date']) ?>
                            </p>

                            <a href="event.php?id=<?= $sim['id'] ?>"
                               class="btn btn-outline-primary btn-sm">
                                عرض التفاصيل
                                <i class="bi bi-arrow-left ms-1"></i>
                            </a>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </div>
</section>

<script>

function shareEvent() {
    if (navigator.share) {
        navigator.share({
            title: "<?= addslashes($event['title']) ?>",
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('تم نسخ الرابط');
    }
}
</script>

<?php include 'includes/footer.php'; ?>