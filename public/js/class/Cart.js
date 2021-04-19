class Cart {
    constructor(cart_id, product_id, product_name, product_price, product_image) {
        this.cart_id = cart_id;
        this.product_id = product_id;
        this.product_name = product_name;
        this.product_price = product_price;
        this.product_image = product_image;
    }

    cartTable() {
        return `
            <tr id="cart-${this.cart_id}"> 
                <td class="cart-image">
                    <img src="/storage/images/product_images/${this.product_id}/${this.product_image}" alt="">
                </td>
                <td>${this.product_name}</td> 
                <td>
                    <div class="form-group text-center">
                        <input type="text" class="form-control" name="quantity" placeholder="Enter quantity" id="quantity_${this.cart_id}" value='1'>
                    </div>
                </td>
                <td>$ ${this.product_price}.00</td>
                <td>$ 1000.00</td>
                <td id="add_to_order_${this.cart_id}">
                    <button class="btn btn-default btn_${this.cart_id}" onclick="addToOrder('${this.cart_id}', '${this.product_id}')">
                        <i class="fa fa-check"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-default" onclick="UserCart.remove('${this.cart_id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>  
        `;
    }
}