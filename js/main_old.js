const burger = document.getElementById("burger");
const menu = document.getElementById("menu");
const closeMenu = document.getElementById("closeMenu");

burger.addEventListener("click", () => {
  menu.classList.add("open");
});

closeMenu.addEventListener("click", () => {
  menu.classList.remove("open");
});



// Таблица "Все курсы"
const content = {
  math: {
    ege: {
      title: "Математика",
      text: "ЕГЭ по профильной математике — один из\nсамых сложных школьных экзаменов,\nтребующий глубокого понимания тем\nи умения логически рассуждать.\n\nМы уделяем внимание не только решению\nзадач, но и правильному оформлению,\nработе с критериями и распределению\nвремени на экзамене."
    },
    oge: {
      title: "Математика",
      text: "ОГЭ по математике закладывает основу дальнейшего обучения и во многом определяет уверенность ученика в предмете.\n\nНа занятиях мы системно закрываем пробелы, формируем устойчивые навыки решения типовых заданий и постепенно приучаем ученика к экзаменационному формату."
    }
  },
  physics: {
    ege: {
      title: "Физика",
      text: "ЕГЭ по физике требует понимания физических процессов, аккуратных вычислений и грамотного анализа условий задач.\n\nМы учим выстраивать решение шаг за шагом, работать с графиками и экспериментальными данными, а также избегать распространённых ошибок, которые часто возникают из-за спешки или непонимания сути задачи."
    },
    oge: {
      title: "Физика",
      text: "ОГЭ по физике требует понимания основных законов, умения читать графики и применять формулы в стандартных ситуациях.\n\nМы помогаем ученикам разобраться в ключевых темах, научиться правильно рассуждать и уверенно выполнять задания экзаменационного формата без лишнего стресса."
    }
  }
};

let currentSubject = "math";
let currentExam = "ege";

const cardTitles = document.querySelectorAll(".cardTitle");
const cardTexts = document.querySelectorAll(".cardText");

const subjectButtons = document.querySelectorAll("[data-subject]");
const examButtons = document.querySelectorAll("[data-exam]");
const roleButtons = document.querySelectorAll("[data-role]");

function updateCard() {
  const data = content[currentSubject][currentExam];
  cardTitles.forEach(title => {
    title.textContent = data.title;
  });

  cardTexts.forEach(text => {
    text.textContent = data.text;
  });
}

function setActive(buttons, activeButton) {
  buttons.forEach(btn => btn.classList.remove("active"));
  activeButton.classList.add("active");
}

subjectButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    currentSubject = btn.dataset.subject;
    setActive(subjectButtons, btn);
    updateCard();
  });
});

examButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    currentExam = btn.dataset.exam;
    setActive(examButtons, btn);
    updateCard();
  });
});

roleButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    currentRole = btn.dataset.role;
    setActive(roleButtons, btn);
    updateCard();
  });
});


// Вопросы и ответы
document.querySelectorAll('.faq-question').forEach(button => {
  button.addEventListener('click', () => {

    const item = button.parentElement;

    // если хочешь чтобы был открыт только один пункт
    document.querySelectorAll('.faq-item').forEach(el => {
      if (el !== item) {
        el.classList.remove('active');
      }
    });

    item.classList.toggle('active');
  });
});

document.querySelectorAll('.faq-question-tablet').forEach(button => {
  button.addEventListener('click', () => {

    const item = button.parentElement;

    // если хочешь чтобы был открыт только один пункт
    document.querySelectorAll('.faq-item').forEach(el => {
      if (el !== item) {
        el.classList.remove('active');
      }
    });

    item.classList.toggle('active');
  });
});


updateCard();

// Переключение карточек через свайп
const swiper = new Swiper(".mySwiper", {
  slidesPerView: 1.6,                           // Автоматическая ширина (настроили в CSS 80%)
  centeredSlides: true,                             // Активная карточка строго по центру
  initialSlide: 1,                                  // ← Открываем вторую
  //spaceBetween: window.innerWidth * 0.025641,       // Расстояние между карточками
  pagination: {
    el: ".swiper-pagination",
    clickable: true,                                // Чтобы можно было кликать на точки
  },
});

const swiper2 = new Swiper(".mySwiper2", {
  slidesPerView: 1.1526,                           // Автоматическая ширина (настроили в CSS 80%)
  centeredSlides: true,                             // Активная карточка строго по центру
  initialSlide: 1,                                  // ← Открываем вторую
  pagination: {
    el: ".swiper-pagination",
    clickable: true,                                // Чтобы можно было кликать на точки
  },
});

const swiper3 = new Swiper(".mySwiper3", {
  slidesPerView: 1,                           // Автоматическая ширина (настроили в CSS 80%)
  centeredSlides: true,                             // Активная карточка строго по центру
  initialSlide: 1,                                  // ← Открываем вторую
  //spaceBetween: window.innerWidth * 0.2,       // Расстояние между карточками
  pagination: {
    el: ".swiper-pagination",
    clickable: true,                                // Чтобы можно было кликать на точки
  },
});

new Swiper(".coursesSwiper", {
  slidesPerView: "auto",
  spaceBetween: 12,
  centeredSlides: true,

  initialSlide: 1,

  speed: 600, // 🔥 плавность
  grabCursor: true,

  pagination: {
    el: document.querySelector(".coursesSwiper .swiper-pagination"),
    clickable: true,
  },
});

const navLinks = document.querySelectorAll('.nav-link');

navLinks.forEach(link => {
  link.addEventListener('click', function () {

    // Убираем active у всех
    navLinks.forEach(l => l.classList.remove('active'));

    // Добавляем текущему
    this.classList.add('active');

  });
});

// === Работа с кнопками "Записаться"... - Начало ===
const buttons = document.querySelectorAll('.open-form');
const modal = document.getElementById('formModal');
const formTitle = document.getElementById('formTitle');

buttons.forEach(btn => {
  btn.addEventListener('click', () => {

    // меняем заголовок
    formTitle.textContent = btn.dataset.title;

    // открываем форму
    modal.classList.add('active');
    form.classList.add('active');   // 🔥 ВОТ ЭТО КЛЮЧ
    success.classList.remove('active');
  });
});

const form = document.querySelector('.form');
const success = document.querySelector('.successModal');


document.addEventListener('click', (e) => {
  if (e.target.classList.contains('active') && e.target.classList.contains('form')) {
    form.classList.remove('active');
  }
});

// Перехват отправки
form.addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('send.php', {
    method: 'POST',
    body: formData
  })
    .then(() => {
      // 🔥 скрываем форму
      form.classList.remove('active');

      // 🔥 показываем success
      success.classList.add('active');

      form.reset();
    })
    .catch(() => {
      alert('Ошибка отправки');
    });
});




// Закрытие
const closeBtn = document.getElementById('closeSuccessBtn');

closeBtn.addEventListener('click', () => {
  success.classList.remove('active');
  modal.classList.remove('active');

  closeBtn.addEventListener('click', () => {
    success.classList.remove('active');
    modal.classList.remove('active');
  });
});

modal.addEventListener('click', (e) => {
  if (e.target.classList.contains('modal__overlay')) {
    modal.classList.remove('active');
  }
});
// === Работа с кнопками "Записаться"... - Конец ===



//  Forms - Begin
const tabss = document.querySelectorAll('.form__tab');
const roleInput = document.getElementById('roleInput');

tabss.forEach(tab => {
  tab.addEventListener('click', () => {
    tabss.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');

    const role = tab.dataset.role === 'parent' ? 'Родитель' : 'Ученик';
    roleInput.value = role;
  });
});
//  Forms - End



document.querySelectorAll('.switch-btn.role').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.switch-btn.role').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const role = btn.dataset.role === 'parent' ? 'Родитель' : 'Ученик';
    document.getElementById('roleInput').value = role;
  });
});
