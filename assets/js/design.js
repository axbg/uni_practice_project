
window.onscroll = function() {fixedNav()};

var navbar = document.getElementsByTagName('nav')[0];

var sticky = navbar.offsetTop;

function fixedNav() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}