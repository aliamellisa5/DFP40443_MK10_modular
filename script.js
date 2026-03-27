function calculateTotal() {
    let total = 0;

    document.querySelectorAll('.qty-input').forEach(input => {
        let qty = parseInt(input.value) || 0;
        let price = parseFloat(input.dataset.price);
        total += qty * price;
    });

    document.getElementById('totalPrice').innerText = 'RM ' + total.toFixed(2);
}

document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', calculateTotal);
});