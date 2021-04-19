class Product {
    constructor(id, name, price, srp, discount, quantity, warranty, delivery_fee, availability, image, code) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.srp = srp;
        this.discount = discount;
        this.quantity = quantity;
        this.warranty = warranty;
        this.delivery_fee = delivery_fee;
        this.availability = availability;
        this.image = image;
        this.code = code;
    }

    UserProduct = {
        products: (className) => {
            return `
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3 product-container ${className}">
                    <div class="thumbnail product">
                        <div class="caption product-content">
                            <div class="product-image-container">
                                <img src="/storage/images/product_images/${this.id}/${this.image}" alt="">
                            </div>
                            <h4 class="center">${this.name}</h4>
                            <p>$ ${this.price}.00</p>
                            <p class="center">
                                <a href="/products/view/${this.code}" class="btn btn-default form-control">
                                    View product
                                </a> 
                            </p>
                        </div>
                    </div>
                </div>
            `;
        },
        savedProduct: (savedId) => {
            return `
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3 product-container" id="saved_product_${savedId}">
                    <div class="thumbnail product">
                        <div class="caption product-content">
                            <div class="product-image-container">
                                <img src="/storage/images/product_images/${this.id}/${this.image}" alt="">
                            </div>
                            <h4 class="center">${this.name}</h4>
                            <p>$ ${this.price}.00</p>
                            <p class="center">
                                <a href="/products/view/${this.code}" class="btn btn-default">
                                    View product
                                </a> 
                                <button class="btn btn-default" role="button" onclick="Products.unsave('${savedId}')">Remove</button> 
                            </p>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    UserStoreProduct = {
        productRow: () => {
            return `
                <tr class="store_product store_product_${this.id}"> 
                    <td>${this.name}</td>
                    <td>$ ${this.price}.00</td>
                    <td>$ ${this.srp}.00</td>
                    <td>% ${this.discount}.00</td>
                    <td>${this.quantity} pcs</td>
                    <td>${this.warranty} day/s</td>
                    <td>$ ${this.delivery_fee}.00</td>
                    <td>
                        <a class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="Products.find('${this.id}')">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-default" onclick="Archive.add('${this.id}')">
                            <i class="fa fa-times"></i>
                        </a>
                        <a class="btn btn-default">
                            <i class="fa fa-image"></i>
                        </a>
                    </td>
                </tr> 
            `;
        },
        productTableData: () => {
            return `
                <td>${this.name}</td>
                <td>$ ${this.price}.00</td>
                <td>$ ${this.srp}.00</td>
                <td>% ${this.discount}.00</td>
                <td>${this.quantity} pcs</td>
                <td>${this.warranty} day/s</td>
                <td>$ ${this.delivery_fee}.00</td>
                <td>
                    <a class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="findProduct('${this.id}')">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a class="btn btn-default" onclick="Archive.add('${this.id}')">
                        <i class="fa fa-times"></i>
                    </a>
                    <a class="btn btn-default">
                        <i class="fa fa-image"></i>
                    </a>
                </td>
            `;
        },
        productArchives: () => {
            return `
                <tr class="store_product_${this.id} store_product"> 
                    <td>${this.name}</td>
                    <td>$ ${this.price}.00</td>
                    <td>$ ${this.srp}.00</td>
                    <td>% ${this.discount}.00</td>
                    <td>${this.quantity} pcs</td>
                    <td>${this.warranty} day/s</td>
                    <td>$ ${this.delivery_fee}.00</td>
                    <td>
                        <a class="btn btn-default" onclick="Archive.remove('${this.id}')">
                            <i class="fa fa-times"></i>
                        </a>
                        <a class="btn btn-default" onclick="Products.delete('${this.id}')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr> 
            `;
        },
        searchProductRow: () => {
            return `
                <tr class="searched_product store_product_${this.id}"> 
                    <td>${this.name}</td>
                    <td>$ ${this.price}.00</td>
                    <td>$ ${this.srp}.00</td>
                    <td>% ${this.discount}.00</td>
                    <td>${this.quantity} pcs</td>
                    <td>${this.warranty} day/s</td>
                    <td>$ ${this.delivery_fee}.00</td>
                    <td>
                        <a class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="Products.find('${this.id}')">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-default" onclick="Archive.add('${this.id}')">
                            <i class="fa fa-times"></i>
                        </a>
                        <a class="btn btn-default">
                            <i class="fa fa-image"></i>
                        </a>
                    </td>
                </tr> 
            `;
        },
    }

}