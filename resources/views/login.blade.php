

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <title>Authentication Login &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-override.css">


</head>

<body>

    <section class="container h-100">
        <div class="row justify-content-sm-center h-100 align-items-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h1 class="fs-4 text-center fw-bold mb-4">Login</h1>
                        <!-- Tambahkan ID pada form -->
                        <form id="loginForm" class="needs-validation">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                @error('api_error')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="input-group input-group-join mb-3">
                                    <input id="email" type="email" placeholder="Enter Email" class="form-control"
                                        name="email" required>
                                    <span class="input-group-text rounded-end">
                                        &nbsp<i class="fa fa-envelope"></i>&nbsp
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-join mb-3">
                                    <input type="password" id="password" class="form-control"
                                        placeholder="Your password" name="password" required>
                                    <span class="input-group-text rounded-end password cursor-pointer">
                                        &nbsp<i class="fa fa-eye"></i>&nbsp
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <!-- Ubah type ke "button" -->
                                <button type="button" id="submit" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').off('click').on('click', function (e) {
                e.preventDefault(); // Hindari reload halaman

                // Ambil data input
                var formData = {
                    email: $('#email').val(),
                    password: $('#password').val()
                };

                // Kirim permintaan AJAX ke API
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/auth/login', // Endpoint API
                    type: 'POST',
                    data: JSON.stringify(formData), // Kirim data sebagai JSON
                    contentType: 'application/json', // Format JSON
                    headers: {
                        'Authorization': 'Bearer <your-token>', // Jika API membutuhkan token
                    },
                    success: function (response) {
                        console.log('Request berhasil:', response);

                        // Lakukan tindakan setelah login berhasil, misalnya redirect
                        window.location.href = '/dashboard';
                    },
                    error: function (xhr, status, error) {
                        console.error('Request gagal:', xhr.responseText);

                        // Tampilkan pesan kesalahan ke pengguna
                        alert('Login gagal: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan.'));
                    }
                });
            });
        });
    </script>

</body>

</html>





    {{-- <form>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="button" id="submit">Login</button>
    </form> --}}



