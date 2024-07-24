<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Mockup</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        .form-container {
            background-color: #f0f0f0;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3 class="text-center">Login</h3>
        <form id="login">
            <div class="form-group">
                <label for="input2">Username</label>
                <input type="text" class="form-control" id="username" placeholder="masukan username">
                <span id="error-username" class="text-danger text-sm italic"></span>
            </div>

            <div class="form-group">
                <label for="input4">Password</label>
                <input type="password" class="form-control" id="password" placeholder="masukan password">
                <span id="error-password" class="text-danger text-sm italic"></span>

            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="register" class="btn btn-primary btn-block mt-2">Register</a>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('form#login').submit(function(e) {
                e.preventDefault();
                let nama = $('#nama').val();
                let username = $('#username').val();
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    url: 'api/login',
                    method: 'post',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Login Berhasil',
                            text: response.message,
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        //save token to local storage
                        localStorage.setItem('token', response.token);
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.username) {
                            $('#error-username').text(errors.username[0]);
                        } else {
                            $('#error-username').text('');
                        }

                        if (errors.password) {
                            $('#error-password').text(errors.password[0]);
                        } else {
                            $('#error-password').text('');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
