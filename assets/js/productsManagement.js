
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
                    '<button number="3" class="btn" onclick="openModal(this);" data-toggle="modal" data-target="#detailsModal">Detalii</button> ' +
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

let addToCart = (element) =>{

    let productId = element.getAttribute("productId");
    let productStock = document.getElementById("stoc-"+productId);

    console.log(productStock.innerText);
    let params = new URLSearchParams();
    params.append('productId',productId);

    axios.post(url+"/api/addToCart.php",params)
        .then((result) => {
            //toastr here
            productStock.innerText = productStock.innerText-1;
            console.log("product added to cart");
        }).catch((err) => {
            //toastr here
    })

};

let deleteFromCart = (element) => {

    let productId = element.getAttribute("productId");
    let productStock = document.getElementById("stoc-"+productId);
    let cartQuantity = document.getElementById("quantity-"+productId);

    console.log(productId);

    let params = new URLSearchParams();
    params.append('productId',productId);

    axios.post(url+"/api/deleteFromCart.php",params)
        .then((result) => {
            //toastr here
            productStock.innerText = Number(productStock.innerText) + 1;
            cartQuantity.innerText = Number(cartQuantity.innerText) - 1;

            if(Number(cartQuantity.innerText) === 0){
                openCartModal();
            }
            console.log("product deleted from cart");
        }).catch((err) => {
        //toastr here
    })

};

