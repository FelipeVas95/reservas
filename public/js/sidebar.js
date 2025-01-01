document.getElementById("toggleSidebar").addEventListener("click", function () {
    const sidebar = document.getElementById("sidebar");
    const hr_menu = document.getElementById("hr_menu");
    const id = document.getElementById("icon_collapse");
    const cont_btn_menu = document.getElementById("cont_bton_collap");
    const name_app = document.getElementById("name_app");
    //cont_btn_menu.classList.toggle("text-end");
    id.classList.toggle("fa-bars");
    name_app.classList.toggle("hide");
    id.classList.toggle("fa-ellipsis-v");
    sidebar.classList.toggle("collapsed");
    hr_menu.classList.toggle("collapsed");
});
