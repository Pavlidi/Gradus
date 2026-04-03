const tabs = document.querySelectorAll('.menu-item');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {

        const target = tab.dataset.tab;

        // активная кнопка
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        // активный контент
        contents.forEach(c => {
            c.classList.remove('active');

            if (c.id === target) {
                c.classList.add('active');
            }
        });

    });
});

const subjects = document.querySelectorAll('.subject');

subjects.forEach(subject => {
    subject.addEventListener('click', () => {

        subjects.forEach(t => t.classList.remove('active'));
        subject.classList.add('active');

    });
});



//          ======= Анимация заполнения прогресса - Begin ======
document.querySelectorAll('.progress__line-active').forEach(el => {
    const targetWidth = el.getAttribute('data-width'); // 👈 переносим из style

    setTimeout(() => {
        el.style.width = targetWidth;
    }, 200);
});
//          ======= Анимация заполнения прогресса - End ======





//          ======= Demo-test - Begin ======
document.querySelectorAll('.bar').forEach(bar => {
    const value = bar.dataset.value;
    const fill = bar.querySelector('.bar-fill');

    // 100 = вся высота блока
    fill.style.height = value + "%";
});
//          ======= Demo-test - End ======





function openTasks()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "block";
    }

    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "block";
    }

    var sectionDemotest = document.getElementsByClassName('section-demotest');
    for (let i = 0; i < sectionDemotest.length; i++) {
        sectionDemotest[i].style.display = "none";
    }

    var sectionPerformance = document.getElementsByClassName('section-performance');
    for (let i = 0; i < sectionPerformance.length; i++) {
        sectionPerformance[i].style.display = "none";
    }

    var sectionProgress = document.getElementsByClassName('section-progress');
    for (let i = 0; i < sectionProgress.length; i++) {
        sectionProgress[i].style.display = "none";
    }

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
    }
}

function openStatistics()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "block";
    }

    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }

    var sectionDemotest = document.getElementsByClassName('section-demotest');
    for (let i = 0; i < sectionDemotest.length; i++) {
        sectionDemotest[i].style.display = "block";
    }

    var sectionPerformance = document.getElementsByClassName('section-performance');
    for (let i = 0; i < sectionPerformance.length; i++) {
        sectionPerformance[i].style.display = "block";
    }

    var sectionProgress = document.getElementsByClassName('section-progress');
    for (let i = 0; i < sectionProgress.length; i++) {
        sectionProgress[i].style.display = "block";
    }

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
    }
}

function openMaterials()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "none";
    }
    
    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }

    var sectionDemotest = document.getElementsByClassName('section-demotest');
    for (let i = 0; i < sectionDemotest.length; i++) {
        sectionDemotest[i].style.display = "none";
    }

    var sectionPerformance = document.getElementsByClassName('section-performance');
    for (let i = 0; i < sectionPerformance.length; i++) {
        sectionPerformance[i].style.display = "none";
    }

    var sectionProgress = document.getElementsByClassName('section-progress');
    for (let i = 0; i < sectionProgress.length; i++) {
        sectionProgress[i].style.display = "none";
    }

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "block";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "block";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
    }
}

function openProfile()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "none";
    }

    var sectionDemotest = document.getElementsByClassName('section-demotest');
    for (let i = 0; i < sectionDemotest.length; i++) {
        sectionDemotest[i].style.display = "none";
    }

    var sectionPerformance = document.getElementsByClassName('section-performance');
    for (let i = 0; i < sectionPerformance.length; i++) {
        sectionPerformance[i].style.display = "none";
    }

    var sectionProgress = document.getElementsByClassName('section-progress');
    for (let i = 0; i < sectionProgress.length; i++) {
        sectionProgress[i].style.display = "none";
    }

    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "block";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "block";
    }
}


//          ======= Registration - Begin ======
// =====================
// 📱 МАСКА ТЕЛЕФОНА +7
// =====================
function formatPhoneInput(input) {

    input.addEventListener("input", () => {
        let digits = input.value.replace(/\D/g, "");

        // всегда начинается с 7
        if (!digits.startsWith("7")) {
            digits = "7" + digits;
        }

        digits = digits.substring(0, 11);

        let formatted = "+7";

        if (digits.length > 1) formatted += " (" + digits.substring(1,4);
        if (digits.length >= 4) formatted += ") " + digits.substring(4,7);
        if (digits.length >= 7) formatted += "-" + digits.substring(7,9);
        if (digits.length >= 9) formatted += "-" + digits.substring(9,11);

        input.value = formatted;
    });
}


// =====================
// 📞 ПРИМЕНЕНИЕ К INPUT
// =====================
document.addEventListener("DOMContentLoaded", () => {

    const phone = document.getElementById("phone");
    const regPhone = document.getElementById("regPhone");

    if (phone) formatPhoneInput(phone);
    if (regPhone) formatPhoneInput(regPhone);

});


// =====================
// 🧹 ФОРМАТ ДЛЯ БД
// =====================
function getCleanPhone(value) {
    return "+" + value.replace(/\D/g, "");
}


// =====================
// 👁️ ПОКАЗ ПАРОЛЯ
// =====================
function togglePassword() {
    const input = document.getElementById("password");

    if (!input) return;

    input.type = input.type === "password" ? "text" : "password";
}


// =====================
// 🔐 ЛОГИН + LOADING
// =====================
document.addEventListener("DOMContentLoaded", () => {

    const loginBtn = document.getElementById("loginBtn");

    if (!loginBtn) return;

    loginBtn.addEventListener("click", function () {

        const btn = this;
        const phoneInput = document.getElementById("phone");
        const passwordInput = document.getElementById("password");

        const phone = getCleanPhone(phoneInput.value);
        const password = passwordInput.value;

        // валидация
        if (phone.length < 12) {
            alert("Введите корректный номер");
            return;
        }

        if (!password) {
            alert("Введите пароль");
            return;
        }

        // loading
        btn.classList.add("loading");
        btn.innerText = "Вход...";

        setTimeout(() => {
            btn.classList.remove("loading");
            btn.innerText = "Войти";
        }, 1500);
    });

});


// =====================
// 🪟 МОДАЛКА РЕГИСТРАЦИИ
// =====================
function openModal() {
    const modal = document.getElementById("modal");
    if (modal) modal.classList.add("active");
}

function closeModal() {
    const modal = document.getElementById("modal");
    if (modal) modal.classList.remove("active");
}


// =====================
// ❌ ЗАКРЫТИЕ ПО КЛИКУ ВНЕ
// =====================
document.addEventListener("click", (e) => {
    const modal = document.getElementById("modal");

    if (!modal) return;

    if (e.target === modal) {
        modal.classList.remove("active");
    }
});
//          ======= Registration - End ======


// Переключатель предмета в ЛК
function changeSubject(subject) {
    const currentHash = window.location.hash || '#tasks';
    window.location.href = "?subject=" + subject + currentHash;
}

document.addEventListener("DOMContentLoaded", () => {
    const hash = window.location.hash;

    if (hash === '#statistics') {
        openStatistics();

        document.querySelectorAll('.menu-item').forEach(t => t.classList.remove('active'));
        document.querySelector('[data-tab="statistics"]').classList.add('active');

    } else {
        openTasks();

        document.querySelectorAll('.menu-item').forEach(t => t.classList.remove('active'));
        document.querySelector('[data-tab="tasks"]').classList.add('active');
    }
});

