const userLogin = document.querySelector("#userLogin");
const consultantLogin = document.querySelector("#consultantLogin");
const mainContainer = document.querySelector(".main-container");

consultantLogin.addEventListener("click", () => {
  mainContainer.classList.add("sign-up-mode");
});

userLogin.addEventListener("click", () => {
  mainContainer.classList.remove("sign-up-mode");
});
