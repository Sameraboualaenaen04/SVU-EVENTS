<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row gy-4">

            <div class="col-md-4">
                <h5 class="fw-bold mb-3">
                   SVUEvents
                    <i class="bi bi-calendar-event-fill me-2 text-white"></i>
                </h5>
                <p class=" small">
    دليلك الشامل لجميع فعاليات الجامعة. ابقَ على اطلاع دائم، وشارك بفعالية  
                </p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3 pl-3"> تنقل سريع</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class=" text-decoration-none footer-link">الرئيسية</a></li>
                    <li><a href="events.php" class=" text-decoration-none footer-link">الفعاليات</a></li>
                    <li><a href="about.php" class=" text-decoration-none footer-link">من نحن</a></li>
                    <li><a href="contact.php" class=" text-decoration-none footer-link">التواصل</a></li>
                </ul>
            </div>

            
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">التواصل</h6>
                <p class=" small mb-1">
                    <i class="bi bi-envelope me-2"></i>Support@svuonline.org
                </p>
                <p class=" small mb-1">
                    <i class="bi bi-telephone me-2"></i>00963112113469
                </p>
                <p class=" small">
                    <i class="bi bi-geo-alt me-2"></i>سوريا _ دمشق جانب كلية الاداب اوتستراد المزة
                </p>
            </div>

        </div>

        <hr class="border-secondary mt-4">

        <p class="text-center  small mb-0">
            &copy; <?php echo date('Y'); ?> SVUEvents &mdash; University Events Directory
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const toggleBtn = document.getElementById("darkModeToggle");
    const body = document.body;

    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
    }

    toggleBtn?.addEventListener("click", () => {
        body.classList.toggle("dark-mode");

        localStorage.setItem(
            "darkMode",
            body.classList.contains("dark-mode") ? "enabled" : "disabled"
        );
    });

});
</script>

</body>
</html>
