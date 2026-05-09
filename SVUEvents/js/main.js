function validateContactForm() {
    var name = document.getElementById('contactName');
    var email = document.getElementById('contactEmail');
    var message = document.getElementById('contactMessage');
    var alertBox = document.getElementById('formAlert');
    var isValid = true;

    clearErrors();

    // Validateالاسم 
    if (name.value.trim() === '') {
        showError(name, 'يجب كتابة الاسم.');
        isValid = false;
    }

    // Validate Email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.trim() === '') {
        showError(email, 'يجب كتابة البريد الالكتروني الخاص بك.');
        isValid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        showError(email, 'الرجاء ادخال ايميل صحيح');
        isValid = false;
    }

    // Validate الرسالة
    if (message.value.trim() === '') {
        showError(message, 'يجب كتابة الرسالة.');
        isValid = false;
    } else if (message.value.trim().length < 10) {
        showError(message, 'الرسالة يجب ان تكون على الأقل عشرة أحرف.');
        isValid = false;
    }

    // رسالة النجاح في حال نجح الارسال
    if (isValid) {
        alertBox.className = 'alert alert-success';
        alertBox.innerHTML = '<i class="bi bi-check-circle me-2"></i>تم ارسال رسالتك بنجاح!';
        alertBox.style.display = 'block';
        //ارسال الرسالة النموذج للداتا بيز
        return false;
    } else {
        alertBox.className = 'alert alert-danger';
        alertBox.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>يرجى تصحيح الاخطاء.';
        alertBox.style.display = 'block';
        return false;
    }
}


function showError(field, message) {
    field.classList.add('is-invalid');
    var feedback = field.nextElementSibling;
    if (feedback && feedback.classList.contains('invalid-feedback')) {
        feedback.textContent = message;
    }
}

// حذف الأخطاء
function clearErrors() {
    document.querySelectorAll('.is-invalid').forEach(function(el) {
        el.classList.remove('is-invalid');
    });
    var alertBox = document.getElementById('formAlert');
    if (alertBox) alertBox.style.display = 'none';
}

// ---- Search filter on events.php ----
function filterEvents() {
    var input = document.getElementById('searchInput');
    var category = document.getElementById('categoryFilter');
    var cards = document.querySelectorAll('.event-card-wrapper');

    var searchVal = input ? input.value.toLowerCase() : '';
    var catVal = category ? category.value.toLowerCase() : '';

    cards.forEach(function(card) {
        var title = card.getAttribute('data-title') || '';
        var cat = card.getAttribute('data-category') || '';

        var matchSearch = title.toLowerCase().includes(searchVal);
        var matchCategory = catVal === '' || cat.toLowerCase() === catVal;

        card.style.display = (matchSearch && matchCategory) ? '' : 'none';
    });
}

// Attach live filtering if on events page
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var categoryFilter = document.getElementById('categoryFilter');

    if (searchInput) searchInput.addEventListener('keyup', filterEvents);
    if (categoryFilter) categoryFilter.addEventListener('change', filterEvents);
});