// cart.js

function addToCart(productName, price, image) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if product already exists in the cart
    let productIndex = cart.findIndex(item => item.productName === productName);
    if (productIndex === -1) {
        cart.push({ productName, price, image });
        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${productName} has been added to the cart!`);
    } else {
        alert(`${productName} is already in the cart.`);
    }
}

function removeFromCart(productName) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.productName !== productName);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCartItems();
}

function loadCartItems() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');

    cartItemsContainer.innerHTML = '';
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>No items in the cart yet.</p>';
        return;
    }

    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.productName}" class="cart-item-image">
            <p><strong>${item.productName}</strong></p>
            <p>Price: ₹${item.price}</p>
            <button onclick="removeFromCart('${item.productName}')">Remove</button>
        `;
        cartItemsContainer.appendChild(itemElement);
    });
}