document.addEventListener('DOMContentLoaded', () => {
    const productList = document.querySelector('.product-list');

    // Function to display products
    function displayProducts(products) {
        productList.innerHTML = '';
        products.forEach(product => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('product');
            productDiv.innerHTML = `
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <span class="price">$${product.price}</span>
            `;
            productList.appendChild(productDiv);
        });
    }

    // Function to filter products
    function filterProducts(priceRange) {
        const url = `server.php?action=filter&priceRange=${priceRange}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                displayProducts(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to filter products. Please try again.');
            });
    }

    // Event listener for price filter
    document.getElementById('price-range').addEventListener('change', function() {
        const priceRange = this.value;
        filterProducts(priceRange);
    });

    // Initial load of products
    filterProducts('0-20');
});
