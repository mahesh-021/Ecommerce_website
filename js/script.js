document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productName = this.getAttribute('data-name');
            alert(productName + " has been added to your cart!");
        });
    });

    const removeFromCartButtons = document.querySelectorAll('.remove-from-cart');
    removeFromCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const itemName = this.getAttribute('data-name');
            if (!confirm("Are you sure you want to remove " + itemName + " from the cart?")) {
                event.preventDefault();
            }
        });
    });
});