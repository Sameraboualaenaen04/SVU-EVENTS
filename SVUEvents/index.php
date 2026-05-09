<?php
$pageTitle = "الرئيسية";
include 'includes/header.php';
include __DIR__ . '/admin/db.php';

$featured = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC LIMIT 3");

while ($event = mysqli_fetch_assoc($featured)) 
?>


<section class="hero-section text-center">
    <div class="container">
        <h1 class="mb-3">
            دليل فعاليات الجامعة الافتراضية السورية
            <i class="bi bi-calendar-event me-2"></i>
        </h1>

        <p class="mb-4">
            اكتشف الفعاليات الأكاديمية، والأنشطة الرياضية، والحفلات الموسيقية والمزيد...
            كلها في مكان واحد.
        </p>

        <a href="events.php" class="btn btn-light btn-lg fw-bold px-5">
            عرض جميع الفعاليات
            <i class="bi bi-search me-2"></i>
        </a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="section-title">
            الفعاليات المميزة
            <i class="bi bi-star me-2"></i>
        </h2>

        <div class="row g-4">

        <?php
        include __DIR__ . '/admin/db.php';

        $featured = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC LIMIT 3");

        if ($featured && mysqli_num_rows($featured) > 0):
            while ($event = mysqli_fetch_assoc($featured)):
        ?>

            <div class="col-md-4">
                <div class="card event-card h-100">

                    <?php if (!empty($event['image'])): ?>
                        <img src="uploads/<?= $event['image'] ?>" class="card-img-top" alt="">
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <span class="badge bg-primary mb-2 align-self-start">
                            <?= $event['category'] ?>
                        </span>

                        <h5 class="card-title">
                            <?= $event['title'] ?>
                        </h5>

                        <p class="small mb-1">
                            <?= $event['location'] ?>
                            <i class="bi bi-geo-alt me-1"></i>
                        </p>

                        <p class="small mb-2">
                            <?= $event['event_date'] ?>
                            <i class="bi bi-calendar me-1"></i>
                        </p>

                        <p class="card-text small flex-grow-1">
                            <?= substr($event['description'], 0, 80) ?>...
                        </p>

                        <a href="event.php?id=<?= $event['id'] ?>" class="btn btn-primary mt-3">
                            عرض التفاصيل
                        </a>

                    </div>
                </div>
            </div>

        <?php
            endwhile;
        else:
        ?>

            <div class="col-12 text-center py-4">
                لا توجد فعاليات مميزة حالياً
            </div>

        <?php endif; ?>

        </div>
    </div>
</section>

<!-- ===================== CATEGORIES ===================== -->

<section class="py-4 bg-light">
    <div class="container">

        <h2 class="section-title">
            تصفح حسب التصنيف
            <i class="bi bi-grid me-2"></i>
        </h2>

        <div class="row g-3">

        <?php
        $cats = mysqli_query($conn, "SELECT DISTINCT category FROM events");

        if ($cats && mysqli_num_rows($cats) > 0):
            while ($cat = mysqli_fetch_assoc($cats)):
        ?>

            <div class="col-6 col-sm-4 col-md-3">
                <a href="events.php?category=<?= $cat['category'] ?>" class="category-card">
                    <i class="bi bi-grid text-primary"></i>
                    <span><?= $cat['category'] ?></span>
                </a>
            </div>

        <?php
            endwhile;
        endif;
        ?>

        </div>
    </div>
</section>

<!-- ===================== LATEST EVENTS ===================== -->

<section class="py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">
                أحدث الفعاليات
                <i class="bi bi-clock me-2"></i>
            </h2>

            <a href="events.php" class="btn btn-outline-primary btn-sm">
                عرض الكل
            </a>
        </div>

        <div class="row g-4">

        <?php
        $latest = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC LIMIT 3");

        if ($latest && mysqli_num_rows($latest) > 0):
            while ($event = mysqli_fetch_assoc($latest)):
        ?>

            <div class="col-sm-6 col-md-4">
                <div class="card event-card h-100">

                    <div class="card-body d-flex flex-column">

                        <span class="badge bg-primary mb-2 align-self-start">
                            <?= $event['category'] ?>
                        </span>

                        <h6 class="card-title fw-semibold">
                            <?= $event['title'] ?>
                        </h6>

                        <p class="small mb-1">
                            <?= $event['location'] ?>
                            <i class="bi bi-geo-alt me-1"></i>
                        </p>

                        <p class="small mb-2">
                            <?= $event['event_date'] ?>
                            <i class="bi bi-calendar me-1"></i>
                        </p>

                        <a href="event.php?id=<?= $event['id'] ?>" class="btn btn-outline-primary btn-sm mt-auto">
                            التفاصيل
                        </a>

                    </div>
                </div>
            </div>

        <?php
            endwhile;
        endif;
        ?>

        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>