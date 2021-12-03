// aplication app.js
'use strict';


function rating(stars){
    let result = '';

    for (let i = 0; i < stars; i++){
        result +='<li class="m-0 list-inline-item"><i class="fas fa-star small text-warning"></i></li>';
    }

    for (let i = 0; i < 5 - stars; i++){
        result += '<li class="m-0 list-inline-item"><i class="far fa-star small text-muted"></i></li>;'
    }

    return result;
}
// console.log(rating(3));

let productTemplate = (product) =>`<!-- product -->
    <div class="pb-5 product-wrapper">
        <article class="mb-4 product">
            <span class="badge rounded-0 bg-${product.badge.type}">${product.badge.title}</span>
            <a href="detail.html">
                <img src="${product.cover}" class="img-fluid" alt="${product.description}" />
            </a>
            <div class="shadow btn-block d-inline-block" data-id="${product.id}"  data-price="${product.price}">
                    <span class="product-btn wish-this" href=""><i class="fas fa-heart"></i></span>
                    <span class="product-btn detail"><i class="fas fa-expand"></i></span>
                    <span class="product-btn add-to-cart"><i class="fas fa-dolly-flatbed"></i></span>
            </div>
            <h6 class="text-center"><a class="reset-anchor" href="detail.html">${product.name}</a></h6>
            <p class="text-center text-muted font-weight-bold">$${product.price}</p>
        </article>
    </div><!-- /product -->`;
// 
let modalTemplate = (product) =>`<!--  Modal -->

    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="border-0 modal-content rounded-0">
            <div class="p-0 overflow-hidden shadow modal-body">
                <!-- row -->
                <div class="row align-items-stretch">

                    <div class="col-lg-6 p-lg-0">
                        <div class="bg-center bg-cover product-view d-block h-100" style="background: url(${product.cover}">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <a href="#" title="Close" class="p-4 border-0 close modal-close"><i class="fas fa-times"></i></a>
                        <div class="p-5 my-md-4">
                            <ul class="mb-2 list-inline">
                               ${rating(product.stars)}
                            </ul>

                            <h2 class="h5 text-uppercase">${product.name}</h2>
                            <p class="text-muted">$${product.price}</p>
                            <p class="mb-4 text-small">${product.description}</p>

                            <ul class="mb-4 list-inline">
                                <li class="list-inline-item me-3"><strong>Quantity</strong></li>
                                <li class="list-inline-item">
                                    <div class="p-1 border d-flex align-items-center justify-content-between">
                                        <div class="py-0 quantity">
                                            <button class="p-0 dec-btn"><i class="fas fa-caret-left"></i></button>
                                            <input class="p-0 border-0 form-control shadow-0 quantity-result" type="text" value="1">
                                            <button class="p-0 inc-btn"><i class="fas fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item"><a class="btn btn-primary add-to-cart" href="#" data-id="${product.id}" data-price="${product.price}">
                                    Add to cart</a></li>
                            </ul>
                            <a class="p-0 reset-anchor" href="#">
                                <i class="far fa-heart me-2"></i>Add to wish list
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>`;

// 


function populateProducts(products){
    let result = '';
    const badges = [
        {'title':'', 'type':'none'}, {'type':'info','title':'new'},{ 'type':'danger','title':'sale'}, {'type':'warning','title':'action'}
    ];


    products.forEach(product=>{
        let badge
        
        product = {...product, badge:{'title':badges[product.badge].title, 'type':badges[product.badge].type}}
        console.log(product)
        result += productTemplate(product);
    });
    return result;
}

function categoryTemplate(category){
    return `<li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><a href="#" class="category-item" data-category="${category.name}">${category.name}</a></div>
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>`;
}

function populateCategories(categories){
    let result = '';
    categories.forEach(item=>{
        result += categoryTemplate(item);
    });
    return result;
}


function distinctCategories(products){
    let mapped = [...products.map(item => item.category)];
    
    let distinct = []
    
    for(let i=0; i<mapped.length; i++){
        if(!(mapped[i].id in distinct)){
            distinct.push(mapped[i])
         }
    }
    // console.log(distinct)
    return distinct
}

function getDistinctCategories(categories, products){
    let distinct = [];

    for (let i=0; i<categories.length; i++){
        for(let j=0; j<products.length; j++){
            if(products[j].category.name === categories[i].name){
                distinct.push({...categories[i], image:products[j].image});
                break;
            }
        }
    }
    return distinct;
}



function renderCategory(selector, products){
    const categoryItems = document.querySelectorAll(selector);
    categoryItems.forEach(item => item.addEventListener('click', function(e){
        e.preventDefault();
        if (e.target.classList.contains('category-item')){
            const category = e.target.dataset.category;
            const categoryFilter = items => items.filter(item => item.category.name.includes(category));
            productsWrapper.innerHTML = populateProducts(categoryFilter(products));
        }else{
            productsWrapper.innerHTML = populateProducts(products);
        }
        addToCartButton()
        detailButton(products)
    }))
}

const modalWindow = document.querySelector('.modal-window');

function renderModal(){
    let addToCart = modalWindow.querySelector('.add-to-cart');

    modalWindow.querySelector('.inc-btn').addEventListener('click', e => {
        let val = e.target.previousElementSibling.value;
        val++;
        e.target.previousElementSibling.value = val;
    });

    modalWindow.querySelector('.dec-btn').addEventListener('click', e => {
        let val = e.target.nextElementSibling.value;
        if(val > 1){
            val--;
        }
        e.target.nextElementSibling.value = val;
    });
    
    let quantityResult = modalWindow.querySelector('.quantity-result');

    addToCart.addEventListener('click', event => {
        let productId = event.target.dataset.id;
        let price = event.target.dataset.price;
        addProductToCart({id:productId, price:price}, +quantityResult.value);
    })
}

function toggleModal(param, product={}){
   if(modalWindow.innerHTML==''){
    modalWindow.innerHTML =  modalTemplate(product);
    renderModal();
   }else{
    modalWindow.innerHTML = '';
   }
    modalWindow.style.display = param;
}



let productsWrapper = document.querySelector('.products-wrapper');

let listGroupNumbered = document.querySelector('.list-group-numbered');

function getStorageItem(key){
    return JSON.parse(localStorage.getItem(key));
}
function setStorageItem(key, item){
    localStorage.setItem(key, JSON.stringify(item));
}
function initStorage(key){
    let basket = []
    try{  
        basket = localStorage.getItem(key) ? 
        getStorageItem(key)
        :setStorageItem(key, []);
    }catch(err){
        if(err==QUOTA_EXCEEDED_ERR){
            console.log("Local Storage Limited is exceeded");
        }
    }
    return basket;
}

function saveCart(cart){
    setStorageItem('basket', cart);
}

// console.log(initStorage('basket'));
let cart = initStorage('basket');


function addProductToCart(product, amount = 1){
    let inCart = cart.some(element => element.id === product.id);
    if (inCart){
        cart.forEach(item=>{
            if(item.id === product.id){
                item.amount += amount;
            }
        })
    }else{
        let cartItem = {...product, amount: amount};
        cart = [...cart, cartItem];
    }
    
    saveCart(cart);
    amountItems(cart);
}

function renderCartItem(item, products){
    let product = products.find(product => product.id == item.id);
    return `<tr class="cart-item" id="id${product.id}">
    <th class="p-3  border-0" scope="row">
      <div class="d-flex align-items-center"><a class="reset-anchor d-block" href="detail.html"><img src="${product.image}" alt="${product.name}" width="70"></a>
        <div class="ms-3"><strong class="h6"><a class="reset-anchor" href="detail.html">${product.name}</a></strong></div>
      </div>
    </th>
    <td class="p-3 align-middle border-0">
      <p class="mb-0 small">$${product.price}</p>
    </td>
    <td class="p-3 align-middle border-0">
      <div class="border d-inline-block px-2">
        <div class="quantity">
          <button class="dec-btn p-0" data-id="${product.id}"><i class="fas fa-caret-left"></i></button>
          <input class="form-control border-0 shadow-0 p-0 quantity-result" type="text" value="${item.amount}">
          <button class="inc-btn p-0" data-id="${product.id}"><i class="fas fa-caret-right"></i></button>
        </div>
      </div>
    </td>
    <td class="p-3 align-middle border-0">
      <p class="mb-0 small">$<span class="product-subtotal"></span></p>
    </td>
    <td class="p-3 align-middle border-0"><a class="reset-anchor" href="#"><i class="fas fa-trash-alt small text-muted" data-id="${product.id}"></i></a></td>
  </tr>`;
}
function populateShoppingCart(cart, products){
    let res = '';
    cart.forEach(item => res+=renderCartItem(item, products));
    return res;
}

const shoppingCart = document.querySelector('.shopping-cart');

const filterItem = (cart, id) => cart.filter(item => item.id != id);
const findItem = (cart, id) => cart.find(item => item.id == id);

function setCartTotal(cart){
    let tmpTotal = 0;
    cart.map(item => {
        tmpTotal = item.price * item.amount;
        shoppingCart.querySelector(`#id${item.id} .product-subtotal`).textContent = parseFloat(tmpTotal.toFixed(2));
    });
    document.querySelector('.cart-total').textContent = parseFloat(cart.reduce((previous, current) => previous + current.price * current.amount,0).toFixed(2));
}

const amountItemsInCart = document.querySelector('.amount-items-in-cart');

function amountItems(cart){
    amountItemsInCart.textContent = cart.reduce((prev, cur) => prev + cur.amount, 0); 
}

function renderCart(){
    shoppingCart.addEventListener('click', event => {
        if(event.target.classList.contains('fa-trash-alt')){
            cart = filterItem(cart, event.target.dataset.id);
            setCartTotal(cart);
            saveCart(cart);
            amountItems(cart);
            event.target.closest('.cart-item').remove();

        } else if(event.target.classList.contains('inc-btn')){
            let tempItem = findItem(cart, event.target.dataset.id);
            tempItem.amount += 1;

            event.target.previousElementSibling.value = tempItem.amount;
            setCartTotal(cart);
            saveCart(cart);
            amountItems(cart);
        } else if(event.target.classList.contains('dec-btn')){
            let tempItem = findItem(cart, event.target.dataset.id);
            if(tempItem !== undefined && tempItem.amount > 1){
                tempItem.amount -= 1;
                event.target.nextElementSibling.value = tempItem.amount;
            } else{
                cart = filterItem(cart, event.target.dataset.id);
                event.target.closest('.cart-item').remove();
            }
            setCartTotal(cart);
            saveCart(cart);
            amountItems(cart);
        }
    })
}

const carouselItem = data => `<div class="carousel-item">
<a class="category-item" href="#" data-category="${data.name}">
    <img src="${data.image}" alt="${data.name}" height="100" with="250" class="category-item">
    <strong class="category-item category-item-title" data-category="${data.name}">${data.name}</strong>
</a>
</div>`;

function makeCarousel(categories){
    let result = '';
    categories.forEach(item => {
        result += carouselItem(item);
    });
    result += result;
    document.querySelector('.carousel-track').innerHTML = result;
}


function fetchProducts(url){
    return fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(response => {
        if(response.status >= 400){
            return response.json().then(err => {
                const error = new Error('Something went weong!')
                error.data = err
                throw error
            })
        }
        return response.json()
    })
}

function addToCartButton(){
     // add-to-cart
     let addToCartButtons = document.querySelectorAll('.add-to-cart');
     addToCartButtons.forEach(button => {
         button.addEventListener('click', (event) => {
             let productId = event.target.closest('.btn-block').dataset.id;
             let price = event.target.closest('.btn-block').dataset.price;
             addProductToCart({id: productId, price: price});
         
         })
     })

}

function detailButton(products){
    
        // detail
        let detailButtons = document.querySelectorAll('.detail');

        detailButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                let productId = event.target.closest('.btn-block').dataset.id;
                let product = products.find(product => product.id == productId);
               
                toggleModal('block', product);
                modalWindow.querySelector('.close')
                .addEventListener('click', (event) => {
                    event.preventDefault();
                    toggleModal('none');
                })
            })
        });
}


function fetchResource(url){
    return fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(response => {
        if(response.status >= 400){
            return response.json().then(err => {
                const error = new Error('Something went weong!')
                error.data = err
                throw error
            })
        }
        return response.json()
    })
}

const carouselTrack = data => `<div class="carousel-item">
<a class="category-item" href="#" data-category="${data.id}">
    <img src="${data.cover}" alt="${data.name}" height="100" with="250" class="category-item">
    <strong class="category-item category-item-title" data-category="${data.id}">${data.name}</strong>
</a>
</div>`;

function buildCarousel(categories){
    let result = '';
    categories.forEach(item => {
        result += carouselTrack(item);
    });
    result += result;
    document.querySelector('.carousel-track').innerHTML = result;
}

document.addEventListener('DOMContentLoaded', () => {
    amountItems(cart);

    fetchResource('/api/categories')
    .then(categories=>{
        document.body.style.setProperty("--categories-length", categories.length);

        if (document.querySelector('.carousel')){
            buildCarousel(categories);

            fetchResource('/api/products')
            .then(products=>{
                productsWrapper.innerHTML = populateProducts(products);
                addToCartButton()
                detailButton(products)
       
            })

            const categoryItems = document.querySelectorAll('.category-item');
            categoryItems.forEach(item => item.addEventListener('click', function(e){
                e.preventDefault();
                if (e.target.classList.contains('category-item')){
                    const categoryId = e.target.dataset.category;
                    fetchResource(`/api/products/${categoryId}`)
                    .then(products=>{
                        productsWrapper.innerHTML = populateProducts(products);
                        addToCartButton()
                        detailButton(products)
               
                    })
                    
                }else{
                    fetchResource('/api/products')
                    .then(products=>{
                        productsWrapper.innerHTML = populateProducts(products);
                        addToCartButton()
                        detailButton(products)
               
                    })
                   
                }
               
            }))
            
        }
    })
 
    
        function sorted(key, order='acs'){
            return (a, b) => {
                if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)){
                    return 0
                }
                const A = (typeof a[key] === 'string')
                ? a[key].toUpperCase() : a[key];
                const B = (typeof b[key] === 'string')
                ? b[key].toUpperCase() : b[key];

                let compare = 0;
                if(A>B){
                    compare = 1;
                }else if(A<B){
                    compare = -1;
                }
                return (
                    (order === 'desc')?(compare*-1):compare
                );
            };
        }

        let selectpicker = document.querySelector('.selectpicker');
        if(selectpicker){
        
            selectpicker.addEventListener('change', function() {
                switch(this.value){
                    case 'low-high':
                        productsWrapper.innerHTML = populateProducts(products.sort(sorted('price', 'asc')))
                        break;
                    case 'high-low':
                        productsWrapper.innerHTML = populateProducts(products.sort(sorted('price', 'desc')))
                        break;
                    case 'popularity':
                        productsWrapper.innerHTML = populateProducts(products.sort(sorted('stars', 'asc')))
                        break;
                    default:
                        productsWrapper.innerHTML = populateProducts(products.sort(sorted('id', 'asc')))
                }
                
            })
        }

        // addToCartButton()
        // detailButton(products)
       

        

        if(shoppingCart){
            shoppingCart.innerHTML = populateShoppingCart(cart, products);
            setCartTotal(cart);
            renderCart();
        }
    // end promuce
// })

});