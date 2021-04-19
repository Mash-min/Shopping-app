class Order {
    constructor(order_id, cart_id, product_id, quantity, total_price, status) {
        this.order_id = order_id;
        this.cart_id = cart_id;
        this.product_id = product_id;
        this.quantity = quantity;
        this.total_price = total_price;
        this.status = status;
    }

    orderProduct(product_name, product_price, image) {
        return `
            <tr id="order-${this.order_id}"> 
                <td class="cart-image">
                    <img src="/storage/images/product_images/${this.product_id}/${image}" alt="">
                </td>
                <td>${product_name}</td> 
                <td>$ ${product_price}.00</td> 
                <td><span class="badge">${this.quantity} pcs</span></td>
                <td>$ ${this.quantity}.00</td>
                <td>${this.status}</td>
                <td>
                    <button class="btn btn-default form-control" onclick="deleteOrder('${this.order_id}')">
                        <i class="fa fa-times"></i> Cancel order 
                    </button>
                </td>
            </tr> 
        `;
    }

}