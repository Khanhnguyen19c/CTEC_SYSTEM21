<x-guest-layout>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CTEC LOGIN</title>
    <link rel="icon" href="{{ asset('favicon.ico')}}" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/css/my-task.style.min.css')}}">
</head>
<style>
    .background{
        background-image: url("{{asset('assets/images/logo/ctec.jpg')}}");
        background-size: cover;
    }
   .background::before{
    background-color: #09090947;
    content: '';
    display: block;
    height: 100%;
    position: absolute;
    width: 100%;
    }

</style>
<body>
<div class="background">
<div id="mytask-layout" class="theme-indigo">
    <!-- main body area -->
    <div class="main p-2 py-3 p-xl-5 ">
        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-xxl">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">

                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                            <!-- Form -->
                            <!-- <div class="">
                                <img src="{{asset('assets/images/login-img.svg')}}" alt="login-img" style="max-width:50%">
                            </div> -->
                            <form class="row g-1 p-3 p-md-4" method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="col-12 text-center mb-1 mb-lg-5">
                                    <h3>Đăng Nhập Vào Hệ Thống</h3>
                                    <img style="margin: auto;" src="{{ asset('assets/images/logo/ctec_logo.png')}}" alt="">

                                </div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                          <strong> {{ $error }} </strong>
                                            @endforeach
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Mã Số </label>
                                        <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Mã số đăng nhập" :value="old('email')" required autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <div class="form-label">
                                            <span class="d-flex justify-content-between align-items-center">
                                                Mật Khẩu
                                            </span>
                                        </div>
                                        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="************" required autocomplete="current-password">
                                    </div>
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" atl="signin">Đăng Nhập</button>
                                </div>

                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div> <!-- End Row -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>

</body>
</html>

</x-guest-layout>
