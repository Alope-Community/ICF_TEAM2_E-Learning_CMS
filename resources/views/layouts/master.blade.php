<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/perfect-scrollbar/css/perfect-scrollbar.css">

    <!-- CSS for this page only -->
    @stack('css')
    <!-- End CSS  -->

    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="{{ asset('') }}assets/css/dark.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/izitoast/css/iziToast.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
</head>

<body>
    <div id="app">
        @include('layouts.setting')
        @include('layouts.header')
        @include('layouts.navigation')

        <div class="main-content">
            @yield('content')
        </div>
        <footer>
            Copyright © 2024 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1">
                Mulai Dari Null </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="{{ asset('') }}vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('') }}vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- js for this page only -->

    <!-- ======= -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/izitoast/js/iziToast.js') }}"></script>
    <script src="{{ asset('vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/myJs.js') }}"></script>
    <script>
        Main.init()
    </script>
    <script>
        const setActiveMenu = () => {
            let isFoundLink = false;
            let path = [];
            window.location.pathname.split("/").forEach(item => {
                if (item !== "") path.push(item);
            })
            let lengthPath = path.length;
            let lengthUse = lengthPath;
            let origin = window.location.origin;

            while (lengthUse >= 1) {
                let link = '';
                for (let i = 0; i < lengthUse; i++) {
                    link += `/${path[i]}`;
                }
                $.each($('#nav').find('a'), (i, elem) => {
                    if ($(elem).attr('href') == `${origin}${link}`) {
                        $(elem).parent(' ').addClass('active')
                        $(elem).parents('li').addClass('active').addClass('submenu')
                        $(elem).parents('li').find(`.collapse`).addClass('show')
                    }
                })

                if (isFoundLink) break;
                lengthUse--;
            }
        }


        setActiveMenu();

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#logout').off('click').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/auth/logout', // Endpoint API
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('pesan error:', xhr.responseText);
                    }

                })
            })

        })
    </script>
    @yield('scripts')
</body>

</html>
