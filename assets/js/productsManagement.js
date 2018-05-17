
let getProducts = () => {

    let productsContainer = document.getElementById("content-row");
    productsContainer.innerHTML = "";

    axios.get(url+"/api/getProducts.php")
        .then((result) => {

            for(let i = 0; i < result.data.length; i++){
                let product = '<div class="col-lg-4 col-md-6 mb-4"> ' +
                    '<div class="card"> ' +
                    '<a href="#"><img class="card-img-top" src="' + result.data[i]['image'] + '" alt=""></a> ' +
                    '<div class="card-body"> ' +
                    '<h4 class="card-title"> ' +
                    '<a id="card-title-3" href="#">' + result.data[i]['name'] + '</a> ' +
                    '</h4> ' +
                    '<h5>' + result.data[i]['price'] + '</h5> ' +
                    '<p id="card-text-3" class="card-text">' + result.data[i]['description'] + '</p> ' +
                    '<span>Stoc: </span>' +
                    '<span id="stoc-'+ result.data[i]['productId'] +'" class="card-text">' + result.data[i]['stock'] + '</span>' +
                    '</div> ' +
                    '<div class="card-footer"> ' +
                    '<a href="./product.html?productId='+ result.data[i]['productId'] + '"><button number="3" class="btn">Info</button></a> ' +
                    '<button class="btn" productId="'+ result.data[i]['productId'] + '" onclick="addToCart(this);">Adaugă</button> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div>';

                productsContainer.innerHTML += product;
            }

        }).catch((ex) => {
            console.log(ex);
    })

};

let addToCart = (element) =>{

    let productId = element.getAttribute("productId");
    let productStock = document.getElementById("stoc-"+productId);

    console.log(productStock);

    let params = new URLSearchParams();
    params.append('productId',productId);

    axios.post(url+"/api/addToCart.php",params)
        .then((result) => {
            //toastr here
            productStock.innerText = Number(productStock.innerText) - 1;
            console.log("product added to cart");
        }).catch((err) => {
            //toastr here
    })

};

let deleteFromCart = (element) => {

    let productId = element.getAttribute("productId");

    try {
        let productStock = document.getElementById("stoc-" + productId);
    }
    catch(err){

    }
    let productStock = document.getElementById("stoc-" + productId);
    let cartQuantity = document.getElementById("quantity-"+productId);


    let params = new URLSearchParams();
    params.append('productId',productId);

    axios.post(url+"/api/deleteFromCart.php",params)
        .then((result) => {
            //toastr here


            try {
                productStock.innerText = Number(productStock.innerText) + 1;
            }catch(err){

            }

            cartQuantity.innerText = Number(cartQuantity.innerText) - 1;

            if(Number(cartQuantity.innerText) === 0){
                openCartModal();
            }
            console.log("product deleted from cart");
        }).catch((err) => {
        //toastr here
    })

};

let getIndividualProduct = () => {

    let urlCrawl = new URL(window.location.href);

    let productId = urlCrawl.searchParams.get("productId");

    let productContainer = document.getElementById("individual-container");

    axios.get(url + "/api/getProduct.php?productId="+productId)
        .then((result)=> {
            productContainer.innerHTML = "<div id='product-info' class='col-sm-5 card' style='padding-top:5%;display:inline-block;'>" +
                "<p>Denumire: " + result.data['name'] + "</p>"+
                "<p>Descriere: " + result.data['description'] + "</p><p>Pret: "+ result.data['price']+"</p>"+
                "<p>Stoc: <span id='stoc-"+ result.data['productId'] + "'>"+ result.data['stock'] +"</span></p>" +
                "<button productId='"+ result.data['productId'] +"' onclick='addToCart(this)'>Cumpără</button></div>" +
                "<img class='col-sm-7 card' width=250 height=250 src='"+ result.data['image'] +"'>";
        })
        .catch((err) => {
            console.log(err);
        })

};

let getCategories = () => {

    let categoryContainer = document.getElementById("categories-container");

    axios.get(url+"/api/getCategories.php")
        .then((result) => {
            for(let i = 0; i < result.data.length; i++){
                let category = '<div class="col-lg-4 col-md-6 mb-4"> ' +
                    '<div class="card"> ' +
                    '<a href="#"><img class="card-img-top" src="' + result.data[i]['image'] + '" alt=""></a> ' +
                    '<div class="card-body"> ' +
                    '<h4 class="card-title"> ' +
                    '<a id="card-title-3" href="#">' + result.data[i]['name'] + '</a> ' +
                    '</h4> ' +
                    '</div> ' +
                    '<div class="card-footer"> ' +
                    '<a href="./category.html?categoryId='+ result.data[i]['categoryId'] +'" target="_self"><button class="btn" categoryId="'+ result.data[i]['categoryId'] + '">Deschide</button></a>' +
                    '</div> ' +
                    '</div> ' +
                    '</div>';

                categoryContainer.innerHTML += category;
            }
        }).catch((err) => {
        console.log(err.message);
    });
};

let getCategory = () => {

    let productsContainer = document.getElementById("content-row");

    productsContainer.innerHTML = "";

    let urlCrawl = new URL(window.location.href);

    let categoryId = urlCrawl.searchParams.get("categoryId");

    axios.get(url+"/api/getCategory.php?categoryId="+categoryId)
        .then((result) => {

            for(let i = 0; i < result.data.length; i++){

                let product = '<div class="col-lg-4 col-md-6 mb-4"> ' +
                    '<div class="card"> ' +
                    '<a href="#"><img class="card-img-top" src="' + result.data[i]['image'] + '" alt=""></a> ' +
                    '<div class="card-body"> ' +
                    '<h4 class="card-title"> ' +
                    '<a id="card-title-3" href="#">' + result.data[i]['name'] + '</a> ' +
                    '</h4> ' +
                    '<h5>' + result.data[i]['price'] + '</h5> ' +
                    '<p id="card-text-3" class="card-text">' + result.data[i]['description'] + '</p> ' +
                    '<span>Stoc: </span>' +
                    '<span id="stoc-'+ result.data[i]['productId'] +'" class="card-text">' + result.data[i]['stock'] + '</span>' +
                    '</div> ' +
                    '<div class="card-footer"> ' +
                    '<a href="./product.html?productId='+ result.data[i]['productId'] + '"><button number="3" class="btn">Detalii</button></a> ' +
                    '<button class="btn" productId="'+ result.data[i]['productId'] + '" onclick="addToCart(this);">Cumpără</button> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div>';

                productsContainer.innerHTML += product;
            }


        }).catch((ex) => {
        console.log(ex);
    })

};

let getBrands = () => {

    let brandsContainer = document.getElementById("brands-container");

    axios.get(url+"/api/getBrands.php")
        .then((result) => {
            for(let i = 0; i < result.data.length; i++){

                let brand = '<div class="col-lg-4 col-md-6 mb-4"> ' +
                    '<div class="card"> ' +
                    '<a href="#"><img class="card-img-top" src="' + result.data[i]['image'] + '" alt=""></a> ' +
                    '<div class="card-body"> ' +
                    '<h4 class="card-title"> ' +
                    '<a id="card-title-3" href="#">' + result.data[i]['name'] + '</a> ' +
                    '</h4> ' +
                    '</div> ' +
                    '<div class="card-footer"> ' +
                    '<a href="./brand.html?brandId='+ result.data[i]['brandId'] +'" target="_self"><button class="btn" categoryId="'+ result.data[i]['categoryId'] + '">Deschide</button></a>' +
                    '</div> ' +
                    '</div> ' +
                    '</div>';

                brandsContainer.innerHTML += brand;
            }
        }).catch((err) => {
        console.log(err.message);
    });
};

let getBrand = () => {

    let productsContainer = document.getElementById("content-row");

    productsContainer.innerHTML = "";

    let urlCrawl = new URL(window.location.href);

    let brandId = urlCrawl.searchParams.get("brandId");

    axios.get(url+"/api/getBrand.php?brandId="+brandId)
        .then((result) => {

            for(let i = 0; i < result.data.length; i++){

                let product = '<div class="col-lg-4 col-md-6 mb-4"> ' +
                    '<div class="card"> ' +
                    '<a href="#"><img class="card-img-top" src="' + result.data[i]['image'] + '" alt=""></a> ' +
                    '<div class="card-body"> ' +
                    '<h4 class="card-title"> ' +
                    '<a id="card-title-3" href="#">' + result.data[i]['name'] + '</a> ' +
                    '</h4> ' +
                    '<h5>' + result.data[i]['price'] + '</h5> ' +
                    '<p id="card-text-3" class="card-text">' + result.data[i]['description'] + '</p> ' +
                    '<span>Stoc: </span>' +
                    '<span id="stoc-'+ result.data[i]['productId'] +'" class="card-text">' + result.data[i]['stock'] + '</span>' +
                    '</div> ' +
                    '<div class="card-footer"> ' +
                    '<a href="./product.html?productId='+ result.data[i]['productId'] + '"><button number="3" class="btn">Detalii</button></a> ' +
                    '<button class="btn" productId="'+ result.data[i]['productId'] + '" onclick="addToCart(this);">Cumpără</button> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div>';

                productsContainer.innerHTML += product;
            }

        }).catch((ex) => {
        console.log(ex);
    })
};
