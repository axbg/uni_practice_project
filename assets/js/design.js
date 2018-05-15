
window.onscroll = function() {fixedNav()};

let navbar = document.getElementsByTagName('nav')[0];

let sticky = navbar.offsetTop;

let fixedNav = () => {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
};

let openModal = (element) => {

    let number = element.getAttribute("number");

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");

    let titleContent = document.getElementById("card-title-" + number);
    let cardContent = document.getElementById("card-text-" + number);

    modalTitle.innerText = "";
    modalBody.innerText = "";

    modalTitle.innerText = titleContent.innerText;
    modalBody.innerText = cardContent.innerText;

};

let openLoginModal = () => {

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");
    let modalAction = document.getElementById("modalAction");

    modalAction.innerText = "Login";

    modalTitle.innerText = "Login";
    modalBody.innerHTML = "<p><input type='text' id='email' placeholder='Email'></p>";
    modalBody.innerHTML += "<p><input type='password' id='password' placeholder='Password'></p>";
    modalBody.innerHTML += "<p><input type='submit' onclick='loginForm()'></p>";

};

let openLogoutModal = () => {

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");

    document.getElementById("modalAction").style.display = "none";

    modalTitle.innerText = "Logout";
    modalBody.innerHTML = "<p><input type='submit' onclick='logoutForm()' value='Logout'></p>";

};
