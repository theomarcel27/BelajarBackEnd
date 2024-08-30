<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control-user {
            border-radius: 0.5rem;
        }
        .btn-user {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body style="background: linear-gradient(135deg, #000000, #ff0000);">
    <div class="container">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form method="POST" class="user" id="loginForm">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <input name="userID" type="text" class="form-control form-control-user" id="userID" aria-describedby="userIDHelp" placeholder="Enter User ID...">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password">
                                    </div>
                                    
                                    <button type="button" onclick="encryptAndSubmit()" class="btn btn-primary btn-block btn-user">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk menangani tekan tombol Enter
            $('#loginForm').on('keypress', function(event) {
                if (event.which === 13) { // 13 adalah kode untuk Enter
                    event.preventDefault(); // Mencegah form dari submit default
                    encryptAndSubmit(); // Memanggil fungsi untuk submit form
                }
            });
        });

        function encryptAndSubmit() {
            // Submit form
            $('#loginForm').submit();
        }
    </script>

</body>

</html>