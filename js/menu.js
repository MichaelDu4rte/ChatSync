
const menu = document.querySelector('#menu-icon');
const navbar = document.querySelector('.navbar');
const icon = document.querySelector('.fa-bars');

menu.addEventListener("click", function() {
    navbar.classList.toggle('active');
    icon.classList.toggle('fa-x')
})

windows.onscroll=() => {
    navbar.classList.remove('active');
}