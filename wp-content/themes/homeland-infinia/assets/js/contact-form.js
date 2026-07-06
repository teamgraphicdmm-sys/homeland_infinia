function hiInitContactForm() {
    const form = document.getElementById('hi-contact-form');
    if (!form) return;

    const alertBox = document.getElementById('hi-form-alert');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const submitBtn = form.querySelector('.submit-btn');
        submitBtn.disabled = true;

        const formData = new FormData(form);
        formData.append('action', 'hi_submit_contact');
        formData.append('nonce', hiContact.nonce);

        try {
            const res = await fetch(hiContact.ajaxUrl, {
                method: 'POST',
                body: formData,
            });
            const data = await res.json();

            alertBox.style.display = 'block';
            if (data.success) {
                alertBox.className = 'alert alert-success';
                alertBox.textContent = data.data.message;
                form.reset();
            } else {
                alertBox.className = 'alert alert-error';
                alertBox.textContent = data.data.message;
            }
        } catch (err) {
            alertBox.style.display = 'block';
            alertBox.className = 'alert alert-error';
            alertBox.textContent = 'Transmission failed. Please try again.';
        } finally {
            submitBtn.disabled = false;
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', hiInitContactForm);
} else {
    hiInitContactForm();
}
