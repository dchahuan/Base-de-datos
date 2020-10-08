const class_name = "active";

document.addEventListener("DOMContentLoaded", () => {
  const boton_naviera = document.getElementById("nav-naviera");
  const boton_puerto = document.getElementById("nav-puerto");

  boton_naviera.addEventListener("click", () => {
    if (!("active" in boton_naviera.contains(class_name))) {
      boton_naviera.classList.add(class_name);
    }

    if (boton_puerto.classList.contains(class_name)) {
      boton_puerto.classList.remove("active");
    }
  });

  boton_puerto.addEventListener("click", () => {
    boton_naviera.classList.remove("active");
    boton_puerto.classList.add("active");
  });
});
