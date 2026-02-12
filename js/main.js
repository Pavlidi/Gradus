const burger = document.getElementById("burger");
const menu = document.getElementById("menu");
const closeMenu = document.getElementById("closeMenu");

burger.addEventListener("click", () => {
  menu.classList.add("open");
});

closeMenu.addEventListener("click", () => {
  menu.classList.remove("open");
});