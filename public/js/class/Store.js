class Store {
    constructor(storeId, storeName, storeEmail, storeContact, storeAddress, storeStatus, storeDescription, storeImage) {
        this.storeId = storeId;
        this.storeName = storeName;
        this.storeEmail = storeEmail;
        this.storeContact = storeContact;
        this.storeAddress = storeAddress;
        this.storeStatus = storeStatus;
        this.storeDescription = storeDescription;
        this.storeImage = storeImage;
    }

    UserStore = {
        savedStores: (savedStoreId) => {
            return `
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 product-container followed_store_${savedStoreId}">
                    <div class="thumbnail product">
                        <div class="caption product-content">
                            <div class="store_image_container">
                                <img src="/storage/images/store_images/${this.storeId}/${this.storeImage}" alt="">
                            </div>
                            <h4 class="center">${this.storeName}</h4>
                            <p class="center">
                                <a href="/stores/view/id=${this.storeId}" class="btn btn-default" role="button">Visit store</a> 
                                <button class="btn btn-default" role="button" onclick="UserStore.unfollow('${savedStoreId}')">Unfollow store</button> 
                            </p>
                        </div>
                    </div>
                </div>
            `
        },
        details: () => {
            return `
                <ul class="list-group store_details">
                    <li class="list-group-item"><h2>${this.storeName}</h2></li>
                    <li class="list-group-item"><b>Email:</b> ${this.storeEmail}</li>
                    <li class="list-group-item"><b>Contact:</b> #${this.storeContact}</li>
                    <li class="list-group-item"><b>Address:</b> ${this.storeAddress}</li>
                    <li class="list-group-item"><b>Description:</b> ${this.storeDescription}</li>
                    <li class="list-group-item">
                        <button class="btn btn-default form-control" data-toggle="modal" data-target="#edit_store_modal">
                            Update store
                        </button>
                    </li>
                </ul>
            `;
        },
        orders: () => {
            return `
                <tr id="order-1"> 
                    <td class="cart-image">
                        <img src="images/1.jpg" alt="">
                    </td>
                    <td>Sample Product name</td> 
                    <td><span class="badge">4 pcs</span></td>
                    <td>$ 1000.00</td>
                    <td>
                    On shipping
                    </td>
                    <td>
                    <button class="btn btn-default form-control">
                        <i class="fa fa-times"></i> Cancel order 
                    </button>
                    </td>
                </tr>
            `;
        }
    }

    storeDetails(followers, products, following) {
        return `
            <ul class="list-group store_details">
                <li class="list-group-item"><h2>${this.storeName}</h2></li>
                <li class="list-group-item">Followers ${followers}</li>
                <li class="list-group-item"><b>Email:</b> ${this.storeEmail}</li>
                <li class="list-group-item"><b>Contact:</b> #${this.storeContact}</li>
                <li class="list-group-item"><b>Address:</b> ${this.storeAddress}</li>
                <li class="list-group-item"><b>Number of products:</b> ${products} products</li>
                <li class="list-group-item"><b>Description:</b> ${this.storeDescription}</li>
                <li class="list-group-item" id="follow_store_btn_container">
                    ${followStoreButton(this.storeId, following)}
                </li>
            </ul>
        `;
    }

    stores() {
        return `
            <div class="col-lg-4">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="store_image_container">
                            <img src="/storage/images/store_images/${this.storeId}/${this.storeImage}" alt="" style="width:100%">
                        </div>
                        <h4 class="center">${this.storeName}</h4>
                        <p>${this.storeEmail}</p>
                        <p class="center">
                            <a href="/stores/view/id=${this.storeId}" class="btn btn-default form-control" role="button">Visit Store</a> 
                        </p>
                    </div>
                </div>
            </div>
        `;
    }  
}

class StoreProduct {
    constructor(productID, productName, productPrice, productImage, productCode) {
        this.productID = productID;
        this.productName = productName;
        this.productPrice = productPrice;
        this.productImage = productImage;
        this.productCode = productCode;
    }

    products() {
        return `
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 product-container">
                <div class="thumbnail product">
                    <div class="caption product-content">
                        <div class="product-image-container">
                            <img src="/storage/images/product_images/${this.productID}/${this.productImage}" alt="">
                        </div>
                        <h4 class="center">${this.productName}</h4>
                        <p>$ ${this.productPrice}.00</p>
                        <p class="center">
                            <a href="/products/view/${this.productCode}" class="btn btn-default form-control">
                                View product
                            </a> 
                        </p>
                    </div>
                </div>
            </div>
        `;
    }

    orders(quantity, total_price, status, tracking_number, payment_type, order_id) {
        return `
            <tr id="order-1"> 
                <td>${tracking_number}</td> 
                <td>${this.productName}</td> 
                <td>$ ${this.productPrice}.00</td>
                <td><span class="badge">${quantity} pcs</span></td>
                <td>$ ${total_price}.00</td>
                <td>${payment_type}</td>
                <td>${status}</td>
                <td>
                  <button class="btn btn-default form-control" onclick="checkOrder(${order_id})">
                    Check order
                  </button>
                </td>
            </tr>
        `;
    }
}

function followStoreButton(id ,following) {
    if(following === true) {
        return `
            <button class="btn btn-default form-control" id="unfollow_btn" onclick="UserStore.removeFollow('${id}')">
                Unfollow
            </button>
        `;
    } else {
        return `
            <button class="btn btn-default form-control" id="follow_btn" onclick="UserStore.follow('${id}')">
                Follow store
            </button>
        `;
    }
}

// let storeProdcuct = new StoreProduct();