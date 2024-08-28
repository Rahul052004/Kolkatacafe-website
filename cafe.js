document.getElementById('myButton').addEventListener('click', function() {
    window.location.href = 'menu.html';
});

let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(item, price, image) {
    cart.push({ item, price, image });
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(item + " added to cart!");
}

function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}

function displayCart() {
    const cartItems = document.getElementById('cartItems');
    const totalAmountElem = document.getElementById('totalAmount');

    cartItems.innerHTML = '';
    let totalAmount = 0; // Reset totalAmount to 0 before iterating

    cart.forEach((cartItem, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            <img src="${cartItem.image}" alt="${cartItem.item}">
            <span>${cartItem.item} - Rs.${cartItem.price}</span>
            <button class="remove" onclick="removeFromCart(${index})">Remove</button>
        `;
        cartItems.appendChild(li);
        totalAmount += cartItem.price;
    });

    totalAmountElem.textContent = totalAmount.toFixed(2);
}

window.addEventListener('load', displayCart);
