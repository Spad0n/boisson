const iframe = document.getElementById('htmzIframe');
const input = document.getElementById('search');
const title = document.getElementById('tag_Based_Beverage');
let typingTimeout;

// refresh the index page
title.addEventListener('click', () => {
    //location.reload();
});

function clearInput() {
    const suggestions = document.getElementById('result-container');
    //console.log(suggestions);
    input.value = "";
    suggestions.innerHTML = '';
    suggestions.display = 'none';
}

// replace an element of the page using iframe
iframe.addEventListener('load', () => {
    const contentWindow = iframe.contentWindow;
    const contentDocument = iframe.contentDocument;
    
    // Utiliser setTimeout pour donner le temps au contenu de se charger
    setTimeout(() => {
        // Vérifier si un hash existe dans l'URL de l'iframe
        const hash = contentWindow.location.hash || null;
        
        // Sélectionner l'élément à remplacer
        const targetElement = document.querySelector(hash);
        
        if (targetElement) {
            // Remplacer le contenu de l'élément sélectionné avec le contenu de l'iframe
            targetElement.replaceWith(...contentDocument.body.childNodes);
        }
    });
});

// input for search
input.addEventListener('input', (event) => {
    clearTimeout(typingTimeout);

    const suggestions = document.getElementById('result-container');
    if (input.value === '') {
        suggestions.style.display = 'none';
    }

    typingTimeout = setTimeout(() => {
        if (input.value !== "") {
            const encode = encodeURIComponent(input.value);
            iframe.src = "search/search.php?name=" + encode + "#result-container";
        }
    }, 300);
    //suggestions.style.display = 'block';
});

function updateNumberCart(cart) {
    const cartBadge = document.getElementById('cart-badge');
    let totalQuantity = 0;
    for (const key in cart) {
	if (cart[key].quantity) {
	    totalQuantity += cart[key].quantity;
	}
    }
    cartBadge.textContent = totalQuantity;
}

// Ajout du systeme d'ajout dans le panier
function addToCart() {
    const productID = document.getElementById('title');
    const productName = productID.textContent;

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const productIndex = cart.findIndex(item => item.name === productName);

    if (productIndex !== -1) {
	cart[productIndex].quantity++;
    } else {
	cart.push({ name: productName, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateNumberCart(cart);
}

function sendCartData() {
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    if (cartItems.length === 0) {
	alert("Votre panier est vide");
	return;
    }

    const payload = {
	cart: cartItems,
    };

    fetch('cart.php', {
	method: 'POST',
	headers: {
	    'Content-Type': 'application/json',
	},
	body: JSON.stringify(payload),
    }).then(response => {
	if (!response.ok) {
	    throw new Error("Une erreur est survenue lors de l'envoie des données");
	}
	return response.text();
    }).then(html => {
	const targetDiv = document.getElementById('target');
	targetDiv.innerHTML = html;
    }).catch(error => {
	console.error('Error:', error);
	alert('Erreur lors de l\'envoie des données.');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length > 0) {
	updateNumberCart(cart);
    }

    // display none on suggestions
    const suggestions = document.getElementById('result-container');
    suggestions.style.display = 'none';
});
