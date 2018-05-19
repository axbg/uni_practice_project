
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
            //add toastr here
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

    let name = document.getElementById("name").value;
    let description = document.getElementById("description").value;
    let stock = document.getElementById("stock").value;
    let price = document.getElementById("price").value;
    let categoryName = document.getElementById("categoryName").value;
    let brandName = document.getElementById("brandName").value;
    let image = document.getElementById("image");

    let form = new FormData();


    form.append("name", name);
    form.append("description", description);
    form.append("stock", stock);
    form.append("price", price);
    form.append("categoryName", categoryName);
    form.append("brandName", brandName);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addProduct.php", form)
        .then((result) => {
            //toastr here
            console.log(result);
            //window.location.href("./brands.html");
        }).catch((err) => {
        //toastr here
        console.log(err);
    })


};

let saveBrand = () => {

    let name = document.getElementById("name").value;
    let originCountry = document.getElementById("originCountry").value;
    let image = document.getElementById("image");

    let form = new FormData();

    form.append("name", name);
    form.append("originCountry",originCountry);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addBrand.php", form)
        .then((result) => {
            //toastr here
            window.location.href = "./brands.html";
        }).catch((err) => {
            //toastr here
            console.log(err);
    })

};

let saveCategory = () => {

    let name = document.getElementById("name").value;
    let description = document.getElementById("description").value;
    let image = document.getElementById("image");

    let form = new FormData();

    form.append("name", name);
    form.append("description",description);
    form.append("image",image.files[0]);

    axios.post(url + "/api/addCategory.php", form)
        .then((result) => {
            //toastr here
            console.log(result);
            //window.location.href = "./categories.html";
        }).catch((err) => {
            //toastr here
        console.log(err);
    })

};
