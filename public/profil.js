console.log("salut");
const menuSecondary = Array.from(
  document.querySelectorAll("#menu-secondary li")
);

menuSecondary.forEach((li) => {
  li.addEventListener("click", () => {
    //mettre la class hidden a tous
    menuSecondary.forEach((li) => {
      const cible = document.querySelector(`#${li.id}-container`);
      cible.classList.add("hidden");
      li.classList.remove("text-blue-500");
    });
    //mettre display block
    const cible = document.querySelector(`#${li.id}-container`);
    cible.classList.remove("hidden");
    cible.classList.add("block");
    li.classList.add("text-blue-500");
  });
});

// tooglebtnformimgprofil
const btn = document.querySelector('label[for="img_url"]');
btn.addEventListener("click", () => {
  const form = document.querySelector("#img-form");
  form.classList.remove("h-0");
  form.classList.add("h-auto");
});
// tooglebtnformNamePRofil
const btnName = document.querySelector("#btn-name");
btnName.addEventListener("click", () => {
  const form = document.querySelector("#name-form");
  form.classList.remove("h-0");
  form.classList.add("h-auto");
});
// tooglebtnformMailPRofil
const btnMail = document.querySelector("#btn-mail");

btnMail.addEventListener("click", () => {
  const form = document.querySelector("#mail-form");
  form.classList.remove("h-0");
  form.classList.add("h-auto");
});

const gear = document.querySelector("#gear");
gear.addEventListener("click", () => {
  const menusecondary = document.querySelector("#div-menu-secondary");
  menusecondary.classList.toggle("hidden");
  menusecondary.classList.toggle("absolute");
  menusecondary.classList.toggle("right-0");
  menusecondary.classList.toggle("w-[50%]");
  menusecondary.classList.toggle("z-10");
  menusecondary.classList.toggle("h-[100vh]");
  menusecondary.classList.toggle("text-center");
  menusecondary.classList.toggle("t-0");
});

const closeMenu = document.querySelector("#close-menu");
closeMenu.addEventListener("click", () => {
  const menusecondary = document.querySelector("#div-menu-secondary");
  menusecondary.classList.toggle("hidden");
  menusecondary.classList.toggle("absolute");
  menusecondary.classList.toggle("right-0");
  menusecondary.classList.toggle("w-[50%]");
  menusecondary.classList.toggle("z-10");
  menusecondary.classList.toggle("h-[100vh]");
  menusecondary.classList.toggle("text-center");
  menusecondary.classList.toggle("t-0");
});
