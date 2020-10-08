document.addEventListener("DOMContentLoaded", () => {
  const boton_naviera = document.getElementById("nav-naviera");
  const boton_puerto = document.getElementById("nav-puerto");

  boton_naviera.addEventListener("click", () => {
    boton_naviera.classList.add("active");
    boton_puerto.classList.remove("active");
  });

  boton_puerto.addEventListener("click", () => {
    boton_naviera.classList.remove("active");
    boton_puerto.classList.add("active");
  });
});
