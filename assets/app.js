(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            const passw = form.querySelector('#newPassword')
            const confirm_passw = form.querySelector('#confirmPassword')

            form.addEventListener(
                "input",
                (event) => {
                    if (event.target.getAttribute('type') === 'password') {
                        confirm_passw.setCustomValidity( confirm_passw.value != passw.value ? "Passwords do not match." : "")
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
               '<div class="icon-success"></div>'
           let success_el = document.createElement('div')
           success_el.classList.add('success-register')
           success_el.innerHTML = success_content
           document.querySelector('.form-signin .card').prepend(success_el)
           document.querySelector('.content-form').classList.add('opacity-0')
       } else {
           let alert_content = ''
           let alert_el = document.createElement('div')
           alert_el.classList.add('alert','alert-danger', 'alert-dismissible', 'fade', 'show')

           if (data.error['user_aviable']) {
              alert_content = 'User with this email is already registered !!!' +
                  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
              alert_el.innerHTML = alert_content
           } else if (data.error['passws_not_match']) {
               alert_content = 'User Password and Password Confirm is not missmatch !!!' +
                   '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
               alert_el.innerHTML = alert_content
           }

            document.querySelector('.form-signin').prepend(alert_el)

       }
    }
})()
