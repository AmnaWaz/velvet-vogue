function displayAuthMessage(message, type = 'red') {
    const authMessageElement = document.getElementById('authMessage');
    if (authMessageElement) {
        authMessageElement.textContent = message;
        authMessageElement.style.color = type; 
    }
}

async function addToCart(product, price) {
    try {
        const response = await fetch('add_to_cart_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product: product, price: price, quantity: 1 })
        });

        const data = await response.json();

        if (data.success) {
            const tempMessageDiv = document.createElement('div');
            tempMessageDiv.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background-color: #d4edda;
                color: #155724;
                padding: 10px 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                z-index: 1000;
            `;
            tempMessageDiv.textContent = data.message;
            document.body.appendChild(tempMessageDiv);
            setTimeout(() => tempMessageDiv.remove(), 3000); 

            if (document.getElementById('cart')) {
                fetchAndDisplayCartItems();
            }
        } else {
            const tempMessageDiv = document.createElement('div');
            tempMessageDiv.style.cssText = `
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background-color: #f8d7da;
                color: #721c24;
                padding: 10px 20px;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                z-index: 1000;
            `;
            tempMessageDiv.textContent = data.message;
            document.body.appendChild(tempMessageDiv);
            setTimeout(() => tempMessageDiv.remove(), 5000); 
        }
    } catch (error) {
        console.error('Error adding to cart:', error);
        const tempMessageDiv = document.createElement('div');
        tempMessageDiv.style.cssText = `
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
        `;
        tempMessageDiv.textContent = "Network error adding to cart. Please try again.";
        document.body.appendChild(tempMessageDiv);
        setTimeout(() => tempMessageDiv.remove(), 5000);
    }
}

let currentCartTotal = 0;

async function fetchAndDisplayCartItems() {
    const cartDiv = document.getElementById("cart");
    const checkoutMessageDiv = document.getElementById("checkoutMessage"); 
    if (!cartDiv) return;

    cartDiv.innerHTML = "<p style='text-align: center;'>Loading cart items...</p>"; 
    if (checkoutMessageDiv) {
        checkoutMessageDiv.textContent = ''; 
    }

    try {
        const response = await fetch('get_cart_items.php');
        const data = await response.json();

        if (data.success) {
            cartDiv.innerHTML = "<h3>Your Cart Items:</h3>";
            currentCartTotal = 0; 
            if (data.cart_items.length === 0) {
                cartDiv.innerHTML += "<p style='text-align: center;'>Your cart is empty.</p>";
                const checkoutButton = document.getElementById('checkoutButton');
                if (checkoutButton) checkoutButton.style.display = 'none';
            } else {
                data.cart_items.forEach(item => {
                    cartDiv.innerHTML += `<p>${item.product_name} - $${parseFloat(item.price).toFixed(2)} (Qty: ${item.quantity})</p>`;
                    currentCartTotal += parseFloat(item.price) * parseInt(item.quantity);
                });
                cartDiv.innerHTML += `<h4 style="text-align: right; margin-top: 20px;">Total: $${currentCartTotal.toFixed(2)}</h4>`;

                const checkoutButton = document.getElementById('checkoutButton');
                if (checkoutButton) checkoutButton.style.display = 'block'; 
            }
        } else {
            cartDiv.innerHTML = `<p style='text-align: center; color: red;'>Error loading cart: ${data.message}</p>`;
            const checkoutButton = document.getElementById('checkoutButton');
            if (checkoutButton) checkoutButton.style.display = 'none';
        }
    } catch (error) {
        console.error('Error fetching cart items:', error);
        cartDiv.innerHTML = `<p style='text-align: center; color: red;'>Network error loading cart. Please try again.</p>`;
        const checkoutButton = document.getElementById('checkoutButton');
        if (checkoutButton) checkoutButton.style.display = 'none'; 
    }
}

async function checkoutCart() {
    const checkoutMessageDiv = document.getElementById("checkoutMessage");
    if (!checkoutMessageDiv) return;

    checkoutMessageDiv.textContent = "Processing checkout...";
    checkoutMessageDiv.style.color = 'blue';

    try {
        const response = await fetch('checkout_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ total_amount: currentCartTotal })
        });

        const data = await response.json();

        if (data.success) {
            checkoutMessageDiv.textContent = data.message;
            checkoutMessageDiv.style.color = 'green';
            document.getElementById('cart').innerHTML = "<p style='text-align: center;'>Your cart is now empty.</p>";
            const checkoutButton = document.getElementById('checkoutButton');
            if (checkoutButton) checkoutButton.style.display = 'none';
            currentCartTotal = 0; 
        } else {
            checkoutMessageDiv.textContent = `Checkout failed: ${data.message}`;
            checkoutMessageDiv.style.color = 'red';
        }
    } catch (error) {
        console.error('Error during checkout fetch:', error);
        checkoutMessageDiv.textContent = "Network error during checkout. Please try again.";
        checkoutMessageDiv.style.color = 'red';
    }
}



async function registerUser(username, password) {
    displayAuthMessage("Registering...", 'blue'); 

    try {
        const response = await fetch('register_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: username, password: password })
        });

        const data = await response.json();

        if (data.success) {
            displayAuthMessage(data.message, 'green');
            document.getElementById('authUsername').value = '';
            document.getElementById('authPassword').value = '';
        } else {
            displayAuthMessage(data.message, 'red');
        }
    } catch (error) {
        console.error('Error during registration fetch:', error);
        displayAuthMessage("Network error or server issue during registration. Please try again.", 'red');
    }
}

async function loginUser(username, password) {
    displayAuthMessage("Logging in...", 'blue'); 

    try {
        const response = await fetch('login_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: username, password: password })
        });

        const data = await response.json();

        if (data.success) {
            displayAuthMessage(data.message, 'green');
            setTimeout(() => {
                window.location.href = 'index.php'; 
            }, 500);
        } else {
            displayAuthMessage(data.message, 'red');
        }
    } catch (error) {
        console.error('Error during login fetch:', error);
        displayAuthMessage("Network error or server issue during login. Please try again.", 'red');
    }
}

function applyFilters() {
    const selectedPriceRange = document.getElementById('priceFilter').value;
    const selectedCategory = document.getElementById('categoryFilter').value;

    const productCategoryContainers = document.querySelectorAll('.products[data-category]');

    productCategoryContainers.forEach(container => {
        const containerCategory = container.getAttribute('data-category');
        let productsVisibleInContainer = 0; 

        const products = container.querySelectorAll('.product');

        products.forEach(product => {
            const productPrice = parseFloat(product.getAttribute('data-price'));
            let showProduct = true;

            if (selectedPriceRange !== 'all') {
                const [min, max] = selectedPriceRange.split('-').map(Number);
                if (productPrice < min || productPrice > max) {
                    showProduct = false;
                }
            }

            if (selectedCategory !== 'all' && selectedCategory !== containerCategory) {
                showProduct = false;
            }

            if (showProduct) {
                product.style.display = 'block'; 
                productsVisibleInContainer++;
            } else {
                product.style.display = 'none'; 
            }
        });

        if (productsVisibleInContainer > 0) {
            container.style.display = 'flex'; 
        } else {
            container.style.display = 'none';
        }

        const categoryHeading = container.previousElementSibling; 
        if (categoryHeading && categoryHeading.tagName === 'H6') {
            if (productsVisibleInContainer > 0) {
                categoryHeading.style.display = 'block';
            } else {
                categoryHeading.style.display = 'none';
            }
        }
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const authUsernameInput = document.getElementById('authUsername');
    const authPasswordInput = document.getElementById('authPassword');
    const authMessageElement = document.getElementById('authMessage');

    if (loginButton && authUsernameInput && authPasswordInput && authMessageElement) {
        loginButton.addEventListener('click', () => {
            authMessageElement.textContent = ''; 
            loginUser(authUsernameInput.value.trim(), authPasswordInput.value.trim());
        });

        registerButton.addEventListener('click', () => {
            authMessageElement.textContent = ''; 
            registerUser(authUsernameInput.value.trim(), authPasswordInput.value.trim());
        });
    }

    const cartDiv = document.getElementById('cart');
    const userCartIdSpan = document.getElementById('userCartId');
    const checkoutButton = document.getElementById('checkoutButton');

    if (cartDiv && userCartIdSpan) { 
        fetchAndDisplayCartItems(); 
        if (checkoutButton) {
            checkoutButton.addEventListener('click', checkoutCart);
        }
    }

    const priceFilter = document.getElementById('priceFilter');
    const categoryFilter = document.getElementById('categoryFilter');

    if (priceFilter && categoryFilter) { 
        priceFilter.addEventListener('change', applyFilters);
        categoryFilter.addEventListener('change', applyFilters);

        applyFilters(); 
    }


    const contactForm = document.getElementById('contactForm');
    const contactMessageStatus = document.getElementById('contactMessageStatus');

    if (contactForm && contactMessageStatus) {
        contactForm.addEventListener('submit', async (event) => {
            event.preventDefault(); 

            contactMessageStatus.textContent = 'Sending message...';
            contactMessageStatus.style.color = 'blue';

            const formData = new FormData(contactForm);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            try {
                const response = await fetch('contact_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    contactMessageStatus.textContent = result.message;
                    contactMessageStatus.style.color = 'green';
                    contactForm.reset(); 
                } else {
                    contactMessageStatus.textContent = `Error: ${result.message}`;
                    contactMessageStatus.style.color = 'red';
                }
            } catch (error) {
                console.error('Error submitting contact form:', error);
                contactMessageStatus.textContent = 'Network error. Please try again.';
                contactMessageStatus.style.color = 'red';
            }
        });
    }
});
