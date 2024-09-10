<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SLS - Ottalabs</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('adminAssets/node_modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('adminAssets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/css/components.css') }}">
</head>

<body>
    <div id="app">
        @include('sweetalert::alert')
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white d-flex flex-column justify-content-between">
                    <div></div>
                    <div class="p-4 m-3">
                        <img src="{{ asset('adminAssets/img/stisla-fill.svg') }}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">
                            Selamat Datang di
                            <span class="font-weight-bold">Smart Library System</span>
                        </h4>
                        <p class="text-muted">
                            Harap hubungi pihak perpustakaan untuk aktivasi akun
                          </p>
                        <form method="post" action="{{('login')}}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input id="name" type="text" class="form-control" name="email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan masukkan Email anda...
                                </div>
                            </div>
                
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    Silahkan masukkan password..
                                </div>
                            </div>
                
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4" style="border-radius: 6px">
                                    Login
                                </button>
                            </div>
                        </form>
                
                        
                    </div>
                        <div class="text-center mt-5 text-small" style="bottom: 0">
                        Copyright &copy; Smart Library System 2024.
                    </div>
                </div>
                
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="{{asset ('adminAssets/img/unsplash/login-bg.jpg')}}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">Ottalabs High School</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Jl. Soekarno-Hatta No. 177 Kota Malang, Jawa Timur, Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('adminAssets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('adminAssets/js/scripts.js') }}"></script>
    <script src="{{ asset('adminAssets/js/custom.js') }}"></script>
    <!-- Page Specific JS File -->
</body>

</html>
