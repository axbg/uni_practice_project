
let confirmPurchases = () => {

    let container = document.getElementById("admin-container");

    let helper = "";

    helper = '<div class="row">' +
        '<p class="col-4">UserID</p>'+
        '<p class="col-4">Date</p>'+
        '<p class="col-4">Confirm</p>' +
        '</div>';

    axios.get(url + "/api/getUnconfirmedOrders.php")
        .then((result)=>{

        for(let i = 0; i < result.data.length; i++){
            helper += '<div class="row" style="padding:10px;">' +
                '<p class="col-4">'+ result.data[i].userID +'</p>' +
                '<p class="col-4">' + result.data[i].date + '</p>' +
                '<p class="col-4" onclick"confirmOrder()">' +
                '<button style="width:40%;" date="'+ result.data[i].date +'" user="'+ result.data[i].userID +'" onclick="confirmOrder(this)">X</button></p>' +
                '</div>';
        }

        helper += "<a href='./admin.php'><button>Close</button></a>";
        container.innerHTML = helper;

        }).catch((err) => {

    });

};


let confirmOrder = (element) => {

    let params = new URLSearchParams();
    params.append('user',element.getAttribute("user"));
    params.append('date', element.getAttribute("date"));

    axios.post(url + "/api/confirmOrder.php", params)
        .then((result) => {
            confirmPurchases();
            toastr.remove();
            toastr.success("Comanda ta a fost inregistrata!");
        }).catch((err) => {
        toastr.remove();
        toastr.error("A aparut o eroare! Te rugam sa reincerci!");
    })

};


let addProduct = () => {

    let container = document.getElementById("admin-container");

    axios.get(url + "/api/prepareAddProduct.php")
        .then((result) => {

            container.innerHTML = "";

            helper = "<h2>Produs nou</h2>" +
                "<input type='text' id='name' placeholder='Numele Produsului'>" +
                "<input type='text' id='description' placeholder='Descrierea produsului'>" +
                "<input type='text' id='price' placeholder='Pret Produs'>" +
                "<input type='text' id='stock' placeholder='Stoc'>" +
                "<p>Imagine</p>" +
                "<input type='file' id='image'>" +
                "<p><span>Categorie </span><select id='categoryName'>";

            for(let i = 0; i < result.data['categories'].length; i++){
                helper += "<option>" + result.data['categories'][i].name + "</option>";
            }

            helper += "</select></p>";
            helper += "<p><span>Brand </span><select id='brandName'>";

            for(let i = 0; i < result.data['brands'].length; i++){
                helper += "<option>" + result.data['brands'][i].name + "</option>";
            }

            helper += "</select></p>";
            helper += "<button onclick='saveProduct()'>Submit</button>" +
                "<a href='./admin.php'><button>Close</button></a>";

            container.innerHTML = helper;

        }).catch((err)=>{
            toastr.remove();
            toastr.error("A aparut o eroare! Te rugam sa reincerci!");
            console.log(err);
    });

};


let addCategory = () => {


    let container = document.getElementById("admin-container");

    container.innerHTML = "";

    container.innerHTML = "<h2>Categorie nouă</h2>" +
        "<input type='text' id='name' placeholder='Numele Categoriei'>" +
        "<input type='text' id='description' placeholder='Descrierea Categoriei'>" +
        "<p>Imagine</p>" +
        "<input type='file' id='image'>" +
        "<button onclick='saveCategory()'>Submit</button>" +
        "<a href='./admin.php'><button>Close</button></a>";
};


let addBrand = () => {


    let container = document.getElementById("admin-container");

    container.innerHTML = "";

    container.innerHTML = "<h2>Brand nou</h2>" +
        "<input type='text' id='name' placeholder='Numele Brandului'>" +
        "<input type='text' id='originCountry' placeholder='Tara de origine'>" +
        "<p>Imagine</p>" +
        "<input type='file' id='image'>" +
        "<button onclick='saveBrand()'>Submit</button>" +
        "<a href='./admin.php'><button>Close</button></a>";

};


let saveProduct = () => {

    let name = document.getElementById("name");
    let description = document.getElementById("description");
    let stock = document.getElementById("stock");
    let price = document.getElementById("price");
    let categoryName = document.getElementById("categoryName");
    let brandName = document.getElementById("brandName");
    let image = document.getElementById("image");

    let form = new FormData();


    form.append("name", name.value);
    form.append("description", description.value);
    form.append("stock", stock.value);
    form.append("price", price.value);
    form.append("categoryName", categoryName.value);
    form.append("brandName", brandName.value);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addProduct.php", form)
        .then((result) => {
            toastr.remove();
            toastr.success("Produsul a fost adaugat");
            name.value = "";
            description.value="";
            image.value = "";
            brandName.value = "";
            categoryName.value = "";
            stock.value = "";
            price.value = "";
        }).catch((err) => {
        toastr.remove();
        toastr.error("A aparut o eroare! Te rugam sa reincerci!");
    })

};


let saveBrand = () => {

    let name = document.getElementById("name");
    let originCountry = document.getElementById("originCountry");
    let image = document.getElementById("image");

    let form = new FormData();

    form.append("name", name.value);
    form.append("originCountry",originCountry.value);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addBrand.php", form)
        .then((result) => {
            toastr.remove();
            toastr.success("Brand-ul a fost adaugat");
            name.value = "";
            originCountry.value = "";
            image.value = "";
        }).catch((err) => {
        toastr.remove();
        toastr.error("A aparut o eroare! Te rugam sa reincerci!");
    })

};


let saveCategory = () => {

    let name = document.getElementById("name");
    let description = document.getElementById("description");
    let image = document.getElementById("image");

    let form = new FormData();

    form.append("name", name.value);
    form.append("description",description.value);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addCategory.php", form)
        .then((result) => {
            toastr.remove();
            toastr.success("Categoria a fost adaugata");
            name.value = "";
            description.value = "";
            image.value = "";

        }).catch((err) => {
        toastr.remove();
        toastr.error("A aparut o eroare! Te rugam sa reincerci!");
    })

};
