const url="http://desktop/PlaySolutions%20Shop/assets/backend/scripts";

window.onload = () => {

    if(localStorage.getItem("logged")){

        let msg = document.getElementsByClassName("user-msg");

        for(let i = 0; i < msg.length; i++){
            msg[i].innerText = "Welcome " + localStorage.getItem("email");
            msg[i].onclick = openLogoutModal;
        }

        let icons = document.getElementsByClassName("fa-user-times");

        while(icons.length) {
            icons[0].classList.add("fa-user");
            icons[0].classList.remove("fa-user-times");
        }
    }

};

let loginForm = () => {

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let data = {
        'email': email,
        'password': password
    };

    let params = new URLSearchParams();
    params.append('email',email);
    params.append('password',password);

    axios.post(url+"/login.php", params)
        .then((response)=>{

            if(response.status === 200){

                localStorage.setItem('logged', 1);
                localStorage.setItem('email', email);

                console.log('Logged in');
                location.reload();
            } else if(response.status === 202) {
                //use toastr
                console.log('You are already logged in');
            }

        }).catch((ex) => {
            console.log("error");
    });
};

let logoutForm = () => {

    localStorage.removeItem("logged");
    localStorage.removeItem("email");

    axios.post(url + "/logout.php")
        .then((result) => {
            //use toastr
            location.reload();
    });
};