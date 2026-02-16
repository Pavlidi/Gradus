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
      text: "ЕГЭ по профильной математике — один из самых сложных школьных экзаменов, требующий глубокого понимания тем и умения логически рассуждать."
    },
    oge: {
      title: "Математика",
      text: "ОГЭ по математике помогает сформировать базу для дальнейшего обучения и уверенно подготовиться к старшей школе."
    }
  },
  physics: {
    ege: {
      title: "Физика",
      text: "ЕГЭ по физике требует понимания законов природы, решения задач и работы с формулами."
    },
    oge: {
      title: "Физика",
      text: "ОГЭ по физике формирует фундаментальное понимание механики, электричества и тепловых процессов."
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