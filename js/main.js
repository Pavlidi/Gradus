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

const cardTitle = document.getElementById("cardTitle");
const cardText = document.getElementById("cardText");

const subjectButtons = document.querySelectorAll("[data-subject]");
const examButtons = document.querySelectorAll("[data-exam]");

function updateCard() {
  const data = content[currentSubject][currentExam];
  cardTitle.textContent = data.title;
  cardText.textContent = data.text;
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

updateCard();