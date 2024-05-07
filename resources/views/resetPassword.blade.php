<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #F0F0F0;">

    <div class="content">
        <div class="container">
            <div class="container mt-5 bg-light rounded-3 p-4 text-center">
                <!-- <img src="lock.png" alt="Lock Icon" class="mb-4"> -->
                <!-- <i class="fa-solid fa-lock fa-circle-check fa-2xl mb-4"></i> -->
                <i class="fa-solid fa-lock fa-2xl "></i>

                <p class="mt-3">masukan password baru yang anda inginkan</p>
                <form action="{{ url('/inputEmail/verifyResetPassword').'/'. $pass_key }}" method="post" class="mt-3">
                    @csrf
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required maxlength="10">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/098cbe1db3.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>

</html>