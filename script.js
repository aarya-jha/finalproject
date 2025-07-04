// Form validation for login & register
function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input');
    for (let input of inputs) {
        if (input.value.trim() === '') {
            alert('Please fill out all fields.');
            return false;
        }
    }
    return true;
}

// Add to cart feedback
function addedToCart() {
    alert('Item added to cart!');
}
