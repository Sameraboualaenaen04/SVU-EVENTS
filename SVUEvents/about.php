<?php
// about.php

$pageTitle = "من نحن";
include 'includes/header.php';

$teamMembers = [
    [
        'name'       => 'سامر أبو العينين',
        'student_id' => 'muhammd_samer_265544',
        'role'       => 'قائد الفريق ومطور Back-End',
        'icon'       => 'bi-person-badge',
    ],
    [
        'name'       => 'سدرا حرب',
        'student_id' => 'sedra_313693',
        'role'       => 'مطور Front-End',
        'icon'       => 'bi-code-slash',
    ],
    [
        'name'       => 'جلال',
        'student_id' => '2021003',
        'role'       => 'مصمم واجهات وتجربة المستخدم',
        'icon'       => 'bi-palette',
    ],
    [
        'name'       => 'سارة',
        'student_id' => '2021004',
        'role'       => 'مصمم قاعدة البيانات',
        'icon'       => 'bi-database',
    ],
];
?>

<!-- عنوان الصفحة -->
<section class="bg-primary text-white py-4">
    <div class="container text-end">

        <h1 class="h3 mb-1">
            حول المشروع
            <i class="bi bi-info-circle ms-2"></i>
        </h1>

        <p class="mb-0 opacity-75">
            تعرف على المشروع والفريق المسؤول عن تطويره.
        </p>

    </div>
</section>

<section class="py-5">
    <div class="container">

        <div class="row g-4 align-items-center">

            <div class="col-md-7 text-end">
                <h2 class="section-title">
                    ما هو SVUEvents؟
                </h2>
                <p class="lh-lg">
                    <strong>SVUEvents</strong> هو موقع إلكتروني خاص بدليل فعاليات الجامعة،
                    تم تطويره ضمن مشروع مقرر
                    <strong>برمجة الويب BWP501</strong>.
                </p>
                <p class=" lh-lg">
                    يتيح هذا النظام للطلاب وأعضاء الهيئة التدريسية تصفح الفعاليات الجامعية،
                    والبحث عنها، واكتشاف كل ما هو جديد بطريقة منظمة وسهلة.
                </p>

                <!-- التقنيات المستخدمة -->
                <h5 class="fw-semibold mt-4 mb-3">
                    التقنيات المستخدمة
                </h5>

                <div class="d-flex flex-wrap gap-2 justify-content-end">

                    <span class="badge bg-primary fs-6 fw-normal px-3 py-2">
                        HTML5
                    </span>

                    <span class="badge bg-success fs-6 fw-normal px-3 py-2">
                        CSS3
                    </span>

                    <span class="badge bg-info text-dark fs-6 fw-normal px-3 py-2">
                        Bootstrap 5
                    </span>

                    <span class="badge bg-warning text-dark fs-6 fw-normal px-3 py-2">
                        JavaScript
                    </span>

                    <span class="badge bg-danger fs-6 fw-normal px-3 py-2">
                        PHP
                    </span>

                    <span class="badge bg-dark fs-6 fw-normal px-3 py-2">
                        MySQL
                    </span>

                </div>

            </div>

            <div class="col-md-5 text-center">

                <i class="bi bi-calendar-heart text-primary"
                   style="font-size:8rem; opacity:0.15;"></i>

                <div class="mt-3">

                    <div class="row g-3 text-center">

                        <div class="col-4">
                            <div class="bg-primary text-white rounded-3 p-3">

                                <i class="bi bi-calendar2-check fs-3"></i>

                                <p class="mb-0 small fw-semibold mt-1">
                                    فعاليات
                                </p>

                            </div>
                        </div>

                        <div class="col-4">
                            <div class="bg-success text-white rounded-3 p-3">

                                <i class="bi bi-people fs-3"></i>

                                <p class="mb-0 small fw-semibold mt-1">
                                    الفريق
                                </p>

                            </div>
                        </div>

                        <div class="col-4">
                            <div class="bg-warning text-dark rounded-3 p-3">

                                <i class="bi bi-star fs-3"></i>

                                <p class="mb-0 small fw-semibold mt-1">
                                    الجودة
                                </p>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        <h2 class="section-title text-center border-0 ps-0">

            فريق العمل
            <i class="bi bi-people ms-2"></i>

        </h2>

        <p class="text-center  mb-5">
            الطلاب المشاركون في تطوير هذا المشروع
        </p>

        <div class="row g-4 justify-content-center">

            <?php foreach ($teamMembers as $member): ?>

            <div class="col-sm-6 col-md-3">

                <div class="team-card text-center">

                    <div class="avatar">
                        <i class="bi <?php echo $member['icon']; ?>"></i>
                    </div>

                    <h6 class="fw-bold mb-1">
                        <?php echo htmlspecialchars($member['name']); ?>
                    </h6>

                    <p class="text-primary small fw-semibold mb-1">
                        الرقم الجامعي:
                        <?php echo htmlspecialchars($member['student_id']); ?>
                    </p>

                    <p class=" small mb-0">
                        <?php echo htmlspecialchars($member['role']); ?>
                    </p>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<!-- السياسة المتبعة لاضافة فعالية-->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4 text-end">
                    <h2 class ="section-title">
                        سياسة إضافة الفعاليات
                    </h2>
                    <p class="">
                        للحفاظ على جودة ودقة البيانات،
                        يتم مراجعة جميع الفعاليات قبل نشرها.
                    </p>
                    <ul class="list-group list-group-flush mt-3 list-dark">

                        <li class="list-group-item d-flex gap-3 px-0">
                            <div>
                                <strong>الدقة:</strong>
                                يجب أن تكون جميع بيانات الفعالية صحيحة ومحدثة.
                            </div>
                        </li>

                        <li class="list-group-item d-flex gap-3 px-0">
                            <div>
                                <strong>الانتماء الجامعي:</strong>
                                يجب أن تكون الفعالية مرتبطة بالجامعة أو أحد الأندية الطلابية.
                            </div>

                        </li>

                        <li class="list-group-item d-flex gap-3 px-0">
                            <div>
                                <strong>المحتوى المناسب:</strong>
                                يجب أن يكون المحتوى مناسباً للبيئة الأكاديمية.
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-3 px-0">
                            <div>
                                <strong>مدة الإرسال:</strong>
                                يجب إرسال الفعالية قبل موعدها بخمسة أيام على الأقل.
                            </div>
                        </li>
                        <li class="list-group-item d-flex gap-3 px-0 border-0">
                            <div>
                                <strong>الصور:</strong>
                                يجب أن تكون صور الفعالية بجودة عالية وبصيغة مناسبة.
                            </div>
                        </li>
                    </ul>
                    <div class="mt-4 text-end">
                        <a href="contact.php" class="btn btn-primary">
                            إرسال فعالية عبر التواصل
                            <i class="bi bi-envelope ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>