<?php
$pageTitle = "الفعاليات";
include 'includes/header.php';
include __DIR__ . '/admin/db.php';

$searchVal = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$categoryVal = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';

// =====================
// BUILD QUERY
// =====================
$sql = "SELECT * FROM events WHERE 1=1";

if (!empty($searchVal)) {
    $search = mysqli_real_escape_string($conn, $searchVal);
    $sql .= " AND title LIKE '%$search%'";
}

if (!empty($categoryVal)) {
    $category = mysqli_real_escape_string($conn, $categoryVal);
    $sql .= " AND category = '$category'";
}

$sql .= " ORDER BY event_date DESC";

$events = mysqli_query($conn, $sql);
?>

<!-- عنوان الصفحة -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <h1 class="h3 mb-1">
            جميع الفعاليات
            <i class="bi bi-calendar2-week me-2"></i>
        </h1>
        <p class="mb-0 opacity-75">
            تصفح وابحث عن جميع الفعاليات القادمة في الجامعة.
        </p>
    </div>
</section>

<!-- قسم البحث والتصفية -->
<section class="py-4">
    <div class="container">

        <div class="search-bar">
            <form action="events.php" method="GET">
              <div class="row g-3 align-items-end text-end">

                    <div class="col-md-6">
                        <label for="searchInput" class="form-label fw-semibold">
                            البحث عن فعالية
                            <i class="bi bi-search me-1"></i>
                        </label>

                        <input
                            type="text"
                            id="searchInput"
                            name="search"
                            class="form-control"
                            placeholder="ابحث باسم الفعالية..."
                            value="<?= $searchVal ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="categoryFilter" class="form-label fw-semibold">
                            التصنيف
                            <i class="bi bi-tag me-1"></i>
                        </label>

                        <select id="categoryFilter" name="category" class="form-select">
                            <option value="">جميع التصنيفات</option>

                            <?php
                            $cats = mysqli_query($conn, "SELECT DISTINCT category FROM events");
                            while ($cat = mysqli_fetch_assoc($cats)):
                            ?>
                                <option value="<?= $cat['category'] ?>" 
                                    <?= ($categoryVal == $cat['category']) ? 'selected' : '' ?>>
                                    <?= $cat['category'] ?>
                                </option>
                            <?php endwhile; ?>

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            تصفية
                            <i class="bi bi-funnel me-1"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!--  عرض الفعاليات -->
        <div class="row g-4 mt-4" id="eventsGrid">

        <?php if ($events && mysqli_num_rows($events) > 0): ?>

            <?php while ($event = mysqli_fetch_assoc($events)): ?>

            <div class="col-sm-6 col-md-4">
                <div class="card event-card h-100">

                    <?php if (!empty($event['image'])): ?>
                        <img src="uploads/<?= $event['image'] ?>" class="card-img-top" alt="">
                    <?php endif; ?>

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

                        <p class="card-text small flex-grow-1">
                            <?= substr($event['description'], 0, 90) ?>...
                        </p>

                        <a href="event.php?id=<?= $event['id'] ?>" class="btn btn-outline-primary btn-sm mt-3">
                            عرض التفاصيل
                            <i class="bi bi-arrow-left ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="col-12 text-center py-5">
                <i class="bi bi-calendar-x fs-1"></i>
                <p class="mt-3">لا توجد فعاليات حالياً.</p>
            </div>

        <?php endif; ?>

        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>