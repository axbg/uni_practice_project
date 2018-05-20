const url="http://desktop/PlaySolutions%20Shop/assets/backend/scripts";

window.onload = () => {

    axios.get(url+"/api/checkCredentials.php")
        .then((result) => {

            if(result.status === 200 && localStorage.getItem("logged")){
                let msg = document.getElementsByClassName("user-msg");

                for(let i = 0; i < msg.length; i++){
                    msg[i].innerHTML = "<p>Welcome " + localStorage.getItem("email") + "</p>";
                    msg[i].innerHTML += "<div style='text-align:center'><p><button onclick='profileInterface()'>Profile</button></p>" +
                        "<p><input type='submit' onclick='logoutForm()' value='Logout'></p></div>";
                    msg[i].onclick = openLogoutModal;
                }

                let icons = document.getElementsByClassName("fa-user-times");

                while(icons.length) {
                    icons[0].classList.add("fa-user");
                    icons[0].classList.remove("fa-user-times");
                }

                if(localStorage.getItem("isAdmin") === '1') {
                    let adminPanel = document.getElementsByClassName("admin-panel");
                    adminPanel[0].style.display = "block";
                    adminPanel[1].style.display = "block";
                }
            }

        }).catch((err) => {

    });

    if(window.location.href.includes("product.html")) {
        getIndividualProduct();
    } else if(window.location.href.includes("categories.html")){
        getCategories();
    } else if(window.location.href.includes("brands.html")){
        getBrands();
    } else if (window.location.href.includes("category.html")){
        getCategory();
    }  else if (window.location.href.includes("brand.html")){
        getBrand();
    }  else if(window.location.href.includes("search.html")){
        searchProduct();
    } else if (window.location.href.includes("contact.html") || window.location.href.includes("admin.php")){
    }
    else{
        getProducts();
    }

};

let loginForm = () => {

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let params = new URLSearchParams();
    params.append('email',email);
    params.append('password',password);

    axios.post(url+"/login.php", params)
        .then((response)=>{

            if(response.status === 200){

                localStorage.setItem('logged', 1);
                localStorage.setItem('email', email);
                localStorage.setItem('isAdmin',response.data.isAdmin);
                location.reload();
            } else if(response.status === 202) {
                //use toastr
                console.log('You are already logged in');
            }

        }).catch((ex) => {
            console.log("error");
    });
};

let registerForm = () => {


    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let firstName = document.getElementById('firstName').value;
    let lastName = document.getElementById('lastName').value;
    let address = document.getElementById('address').value;
    let phone = document.getElementById('phone').value;

    let params = new URLSearchParams();
    params.append('email',email);
    params.append('password',password);
    params.append('firstName',firstName);
    params.append('lastName',lastName);
    params.append('address',address);
    params.append('phone',phone);

    axios.post(url+"/register.php", params)
        .then((response)=>{

            if(response.status === 200){

                console.log('You were registered. You can log in now.');
                //use toastr here
                openLoginModal();

            } else if(response.status === 202) {
                //use toastr
                console.log('Some error happened');
            }

        }).catch((ex) => {
        console.log("error");
    });

};

let logoutForm = () => {

    localStorage.removeItem("logged");
    localStorage.removeItem("email");
    localStorage.removeItem("isAdmin");

    axios.post(url + "/logout.php")
        .then((result) => {
            //use toastr
            location.reload();
    });
};