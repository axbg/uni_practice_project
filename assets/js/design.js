
window.onscroll = function() {fixedNav()};

let navbar = document.getElementsByTagName('nav')[0];

let sticky = navbar.offsetTop;

function fixedNav() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

function openModal(element){

    let number = element.getAttribute("number");

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");

    let titleContent = document.getElementById("card-title-" + number);
    let cardContent = document.getElementById("card-text-" + number);

    modalTitle.innerText = "";
    modalBody.innerText = "";

    modalTitle.innerText = titleContent.innerText;
    modalBody.innerText = cardContent.innerText;

}
