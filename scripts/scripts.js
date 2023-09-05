
var setting_menu=document.querySelector(".setting_menu");
var dark = document.getElementById("dark_btn");
function showMenu(){
    setting_menu.classList.toggle("setting_menu_height");
}
dark.onclick = function (){
    dark.classList.toggle("dark_btn_on");
    document.body.classList.toggle("dark_theme")
}