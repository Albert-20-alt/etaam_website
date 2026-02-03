$(document).ready(function () {
    $('.footer-widget__newsletter-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const emailInput = form.find('input[name="email"]');
        const email = emailInput.val();

        if (!email) {
            alert('Veuillez entrer une adresse email.');
            return;
        }

        // Disable button to prevent double submit
        const btn = form.find('button');
        const originalBtnContent = btn.html();
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: 'api/subscribe_newsletter.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ email: email }),
            success: function (response) {
                if (response.success) {
                    // Using SweetAlert2 if available, otherwise alert
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscription réussie !',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false,
                            background: '#1a1b21',
                            color: '#fff'
                        });
                    } else {
                        alert(response.message);
                    }
                    form[0].reset();
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oups...',
                            text: response.message,
                            background: '#1a1b21',
                            color: '#fff'
                        });
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function () {
                alert('Une erreur est survenue. Veuillez réessayer.');
            },
            complete: function () {
                btn.prop('disabled', false).html(originalBtnContent);
            }
        });
    });
});
