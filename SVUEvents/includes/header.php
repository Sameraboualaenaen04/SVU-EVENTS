
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>SVU Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-calendar-event-fill fs-4"></i>
            <span class="fw-bold">SVUEvents</span>
        </a>

        <a class="navbar-brand d-flex align-items-center gap-2" href="admin/login.php">
            <i class="bi bi-person-circle fs-4"></i>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link"
                       href="index.php">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="events.php">الفعاليات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="about.php">من نحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="contact.php">التواصل</a>
                </li>
            </ul>
        </div>
      <button id="darkModeToggle" class="btn btn-outline-light btn-sm ms-3">
                <i class="bi bi-moon"></i>
            </button>
    </div>
</nav>

