function calculateTotal() {
    let total = 0;
    
    const inputs = document.querySelectorAll('.qty-input');
    
    inputs.forEach(input => {
       
        let qty = parseInt(input.value) || 0;
        let price = parseFloat(input.dataset.price);
        total += qty * price;
    });
    
    const displayTotal = document.getElementById('totalPrice');
    if (displayTotal) {
        displayTotal.innerText = 'RM ' + total.toFixed(2);
    }
}

window.onload = calculateTotal;