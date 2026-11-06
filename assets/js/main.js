/* ---------- Donation: preselect method when clicking a payment card ---------- */
document.querySelectorAll('.payment-choose').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var method = btn.getAttribute('data-method');
        var methodInput = document.getElementById('d_payment_method');
        var selectedPayment = document.getElementById('selected-payment');
        if (methodInput) methodInput.value = method;
        if (selectedPayment) {
            selectedPayment.textContent = 'Selected payment method: ' + btn.getAttribute('data-method-label');
        }
        document.querySelectorAll('.payment-choose').forEach(function (option) {
            var selected = option === btn;
            option.setAttribute('aria-pressed', selected ? 'true' : 'false');
            option.closest('.payment-card').classList.toggle('is-selected', selected);
        });
        var target = document.getElementById('declare');
        if (target) target.scrollIntoView({ behavior: 'smooth' });
        // Focus first field
        var name = document.getElementById('d_payer_name');
        if (name) setTimeout(function () { name.focus(); }, 400);
    });
});

var donationForm = document.getElementById('donationForm');
if (donationForm) {
    donationForm.addEventListener('submit', function (event) {
        var methodInput = document.getElementById('d_payment_method');
        if (methodInput && !methodInput.value) {
            event.preventDefault();
            var selectedPayment = document.getElementById('selected-payment');
            if (selectedPayment) {
                selectedPayment.textContent = 'Choose a payment method above before confirming your donation.';
                selectedPayment.focus();
            }
        }
    });
}

/* ---------- Quick amount chips ---------- */
document