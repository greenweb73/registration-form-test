(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            const passw = form.querySelector('#newPassword')
            const confirm_passw = form.querySelector('#confirmPassword')
            const email = form.querySelector('#userEmail')

            form.addEventListener(
                "input",
                (event) => {
                    if (event.target.getAttribute('type') === 'password') {
                        confirm_passw.setCustomValidity( confirm_passw.value != passw.value ? "Password and Password Confirm do not match." : "")
                    }
                    if (event.target.getAttribute('type') === 'email') {
                        email.setCustomValidity(emailValidation(event.target))
                    }
                }
            );

            form.addEventListener('submit', async (event) => {
                if (!form.checkValidity()) {

                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')

                } else {

                    event.preventDefault()
                    const formData = new FormData(form);

                    fetch('/controller/register.php', {
                        method: 'POST',
                        body: formData,
                    }).then(response => response.json())
                        .then((data) => {
                            hundlerResponse(data)
                            form.classList.remove("was-validated");
                        })
                }

            }, false)
        })
    function hundlerResponse(data) {
       if (data.success === 'ok') {
           let success_content = '<div class="title">Congratulations, your account has been successfully created.</div>' +
               '<div class="icon-success"><img src="/assets/image/success-green-check-mark-icon.svg" alt=""></div>'
           let success_el = document.createElement('div')
           success_el.classList.add('success-register')
           success_el.innerHTML = success_content
           document.querySelector('.form-signin .card').prepend(success_el)
           document.querySelector('.content-form').classList.add('opacity-0')
           setTimeout(() => {
               location.reload()
           }, 3000)
       } else {
           let alert_content = ''
           let alert_el = document.createElement('div')
           alert_el.classList.add('alert','alert-danger', 'alert-dismissible', 'fade', 'show')

           if (data.error['user_available']) {
              alert_content = 'User with this email is already registered !!!' +
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
              alert_el.innerHTML = alert_content
           } else if (data.error['passws_not_match']) {
               alert_content = 'User Password and Password Confirm is not missmatch !!!' +
                   '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
               alert_el.innerHTML = alert_content
           } else if (data.error['email_is_no_correct']) {
               alert_content = 'User Email is not valid !!!' +
                   '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
               alert_el.innerHTML = alert_content
           }

            document.querySelector('.form-signin').prepend(alert_el)

       }
    }

    function emailValidation(el) {
        const emailRegex = /\S+@\S+\.\S+/;
        const email = el.value.trim();

        if (email === '') {
            return 'Email is required';
        } else if (!emailRegex.test(email)) {
            return 'Please enter a valid email address';
        } else {
            return '';
        }
    }

})()
