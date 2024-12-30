const toggleDarkMode = document.getElementById("toggle-dark-mode");
const body = document.body;

document.addEventListener("DOMContentLoaded", function () {
    // Comprobar si el modo nocturno está activado
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
    }
}),
toggleDarkMode.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("darkMode", "enabled");
        document
            .getElementById("icon-dark-mode")
            .classList.remove("fa-moon");
        document.getElementById("icon-dark-mode").classList.add("fa-sun");
    } else {
        localStorage.setItem("darkMode", "disabled");
        document
            .getElementById("icon-dark-mode")
            .classList.remove("fa-sun");
        document.getElementById("icon-dark-mode").classList.add("fa-moon");
    }
});



