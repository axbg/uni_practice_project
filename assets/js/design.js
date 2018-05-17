
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

    modalAction.innerText = "Sign Up";
    modalAction.onclick = signUpPanel;

    modalTitle.innerText = "Login";
    modalBody.innerHTML = "<div id='sign-in-panel'><p><input type='text' id='email' placeholder='Email'></p>" +
        "<p><input type='password' id='password' placeholder='Password'></p>" +
        "<p><input type='submit' onclick='loginForm()'></p></div>";

};

let signUpPanel = () => {

    let modalBody = document.getElementById("modalBody");
    let modalAction = document.getElementById("modalAction");

    modalAction.innerText = "Login";
    modalAction.onclick = openLoginModal;

    modalBody.innerHTML = "<div id='sign-in-panel'>" +
        "<p><input type='text' id='firstName' name='firstName' placeholder='Firstname'></p>" +
        "<p><input type='text' id='lastName' name='lastName' placeholder='Lastname'></p>" +
        "<p><input type='text' id='phone' name='phone' placeholder='Phone'></p>" +
        "<p><input type='text' id='address' name='address' placeholder='Address'></p>" +
        "<p><input type='text' id='email' name='email' placeholder='Email'></p>" +
        "<p><input type='password' id='password' name='password' placeholder='Password'></p>" +
        "<p><input type='submit' onclick='registerForm()'></p></div>";
};


let profileInterface = () => {

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");

    axios.get(url + "/profile.php")
        .then((response) => {
            modalTitle.innerText = "Profile";
            modalBody.innerHTML = '<p>First Name: ' + response.data.firstName + '</p>';
            modalBody.innerHTML += '<p>Last Name: ' + response.data.lastName + '</p>';
            modalBody.innerHTML += '<p>Email: ' + response.data.email + '</p>';
            modalBody.innerHTML += '<p>Phone: ' + response.data.phone + '</p>';
            modalBody.innerHTML += '<p>Address: ' +response.data.address + '</p>';

        }).catch((err) => {
        //toastr here
        console.log(err.message);
    })
};

let openCartModal = () => {

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");
    let modalAction = document.getElementById("modalAction");


    modalTitle.innerText = "Your Cart";
    modalBody.innerHTML = "";
    modalAction.innerText = "Trimire comanda";

    axios.get(url + "/api/getCart.php")
        .then((result) => {

            let cart = "";
            for(let i = 0; i < result.data[0].length; i++){
                cart += "<div style='min-height:150px;border-bottom:1px solid black;'>" +
                    "<p style='float:left;cursor:pointer' productId='" + result.data[0][i]['productId'] + "'onclick='deleteFromCart(this)'>X</p>" +
                    "<span>Produs: " + result.data[0][i]['name'] + "</span>" +
                    "<span style='float:right;'>Pret: " + result.data[0][i]['price'] + "</span>" +
                    "<p><img style='' src='"+ result.data[0][i]['image'] + "' width=100 height=100;'></p>" +
                    "<span>Cantitate: </span>" +
                    "<span id='quantity-"+ result.data[0][i]['productId'] +"'>" + result.data[1][i] + "</span></div>"
            }

            modalBody.innerHTML = cart;

        }).catch((err) => {
        //toastr
        console.log("error happened");
    });

};

let openLogoutModal = () => {

    let modalTitle = document.getElementById("modalTitle");
    let modalBody = document.getElementById("modalBody");

    document.getElementById("modalAction").style.display = "none";

    modalTitle.innerText = "Logout";
    modalBody.innerHTML = "profile";

};
