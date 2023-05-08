
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <div class="card p-4">
            <div class="content-form">
                <h1 class="mb-5 fw-normal">Please register</h1>

                <form class="row g-4 form-registration needs-validation" novalidate>

                    <div class="col-sm-6">
                        <input type="text"
                               name="first_name"
                               class="p-3 form-control"
                               id="firstName"
                               placeholder="First name *"
                               minlength="3"
                               maxlength="65"
                               value="" required>
                        <div class="invalid-feedback" data-default-err-msg="Valid First Name is required.">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="text"
                               name="last_name"
                               class="p-3 form-control"
                               id="lastName"
                               placeholder="Last name *"
                               minlength="3"
                               maxlength="65"
                               value="" required>
                        <div class="invalid-feedback" data-default-err-msg="Valid Last Name is required.">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="email" name="email" class="p-3 form-control" id="userEmail" placeholder="Your email *" required>
                        <div class="invalid-feedback" data-default-err-msg="Please enter a valid email address for registration.">
                            Please enter a valid email address for registration.
                        </div>
                    </div>

                    <div class="col-12">

                        <input type="password" name="passw" class="p-3 form-control" id="newPassword" placeholder="Password *" required>
                        <div class="invalid-feedback" data-default-err-msg="Password is required">
                            Please enter password.
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="password" name="cpassw" class="p-3 form-control" id="confirmPassword" placeholder="Password Confirm *" required>
                        <div class="invalid-feedback" data-default-err-msg="Password not a match">
                            Password Confirm not a match
                        </div>
                    </div>

                    <button id="submitFormBtn" class="w-100 mt-5 btn btn-lg btn-primary" type="submit">Register</button>

                </form>
            </div>



        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="/assets/app.js"></script>

</body>
</html>

<script>

</script>
