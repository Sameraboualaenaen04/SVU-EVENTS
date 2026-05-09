<?php
$pageTitle = "اتصل بنا";
include 'includes/header.php';

require __DIR__ . "/admin/db.php";

$success = "";
$error = "";

/* =========================
   SAVE MESSAGE
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // validation
    if (
        empty($name) ||
        empty($email) ||
        empty($message)
    ) {
        $error = "يرجى تعبئة جميع الحقول المطلوبة";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "البريد الإلكتروني غير صالح";
    }

    elseif (strlen($message) < 10) {
        $error = "يجب أن تحتوي الرسالة على 10 أحرف على الأقل";
    }

    else {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO contact_messages (name, email, subject, message)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $name,
            $email,
            $subject,
            $message
        );

        if (mysqli_stmt_execute($stmt)) {
            $success = "تم إرسال الرسالة بنجاح";
        } else {
            $error = "حدث خطأ أثناء الإرسال";
        }
    }
}
?>

<!-- عنوان الصفحة -->
<section class="bg-primary text-white py-4">
    <div class="container text-end">

        <h1 class="h3 mb-1">
            اتصل بنا
            <i class="bi bi-envelope ms-2"></i>
        </h1>

        <p class="mb-0 opacity-75">
            هل لديك استفسار او تريد اضافة فعالية؟ نحن هنا لمساعدتك.
        </p>

    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-md-7">

                <div class="card contact-card p-4 text-end">

                    <h4 class="fw-bold mb-4">
                        إرسال رسالة
                        <i class="bi bi-send ms-2 text-primary"></i>
                    </h4>

                    <!-- SUCCESS -->
                    <?php if($success): ?>
                        <div class="alert alert-success">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <!-- ERROR -->
                    <?php if($error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <!-- NAME -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                الاسم الكامل
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control text-end"
                                placeholder="أدخل اسمك الكامل"
                                required
                            >
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                البريد الإلكتروني
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control text-end"
                                placeholder="example@email.com"
                                required
                            >
                        </div>

                        <!-- SUBJECT -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                الموضوع
                            </label>

                            <select
                                name="subject"
                                class="form-select text-end"
                            >

                                <option value="">
                                    اختر الموضوع
                                </option>

                                <option value="استفسار عام">
                                    استفسار عام
                                </option>

                                <option value="إضافة فعالية">
                                    إضافة فعالية
                                </option>

                                <option value="دعم تقني">
                                    دعم تقني
                                </option>

                                <option value="أخرى">
                                    أخرى
                                </option>

                            </select>
                        </div>

                        <!-- MESSAGE -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                الرسالة
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="message"
                                class="form-control text-end"
                                rows="5"
                                placeholder="اكتب رسالتك هنا..."
                                required
                            ></textarea>

                        </div>

                        <!-- BUTTON -->
                        <button
                            type="submit"
                            class="btn btn-primary px-5"
                        >

                            إرسال الرسالة
                            <i class="bi bi-send ms-2"></i>

                        </button>

                    </form>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-5 text-end">

                <h4 class="fw-bold mb-4">
                    وسائل التواصل الأخرى
                </h4>

                <div class="col-md-5 text-end">

                <h4 class="fw-bold mb-4">
                    وسائل التواصل الأخرى
                </h4>

                <div class="d-flex flex-column gap-4">
                    <div class="d-flex gap-3 align-items-start">

                        <div class="bg-primary text-white rounded-3 p-3">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                البريد الإلكتروني
                            </h6>

                            <p class=" mb-0">info@svuonline.org.
                            </p>
                            <p class=" mb-0">
                                Support@svuonline.org
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-start">

                        <div class="bg-success text-white rounded-3 p-3">
                            <i class="bi bi-telephone-fill fs-4"></i>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                الهاتف
                            </h6>

                            <p class=" mb-0 rtl">
                                00963112113469
                        </p>

                            <p class=" mb-0">
                                الأحد - الخميس
                            </p>
                        </div>

                    </div>
                    <div class="d-flex gap-3 align-items-start">

                        <div class="bg-warning text-dark rounded-3 p-3">
                            <i class="bi bi-geo-alt-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">
                                العنوان
                            </h6>

                            <p class=" mb-0">
                                مكتب شؤون الطلاب
                            </p>

                            <p class=" mb-0">
                               مقر الجامعة الافتراضية عند مركز التعليم والتدريب الاذاعي
                            </p>

                            <p class=" mb-0">
                               سوريا _ دمشق جانب كلية الاداب اوتستراد المزة
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-start">

                        <div class="bg-info text-white rounded-3 p-3">
                            <i class="bi bi-clock-fill fs-4"></i>
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                أوقات الدوام
                            </h6>

                            <p class=" mb-0">
                                الأحد - الخميس
                            </p>

                            <p class=" mb-0">
                                10:00 صباحاً - 1:00 ظهرا
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>



    