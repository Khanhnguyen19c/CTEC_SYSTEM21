<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CTEC 404 Page</title>
    <link rel="icon" href="{{asset('assets/images/logo/icon_ctec.png')}}" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/css/my-task.style.min.css') }}">
</head>

<body>
<style>
    #mytask-layout{
        background-image: url("{{asset('assets/images/logo/ctec.jpg')}}");
        background-size: cover;
    }
        #mytask-layout::before{
        background-color: #09090947;
        content: '';
        display: block;
        height: 100%;
        position: absolute;
        width: 100%;
    }
</style>
<div id="mytask-layout" class="theme-indigo">

    <!-- main body area -->
    <div class="main p-2 py-3 p-xl-5">

        <!-- Body: Body -->
        <div class="body d-flex p-0 p-xl-5">
            <div class="container-xxl">

                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">

                    </div>

                    <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                            <!-- Form -->
                            <form class="row g-1 p-3 p-md-4">
                                <div class="col-12 text-center mb-1 mb-lg-5">
                                    <img src="{{asset('assets/images/not_found.svg')}}" class="w240 mb-4" alt="" />
                                    <h5>OOP! PAGE NOT FOUND</h5>
                                    <span class="text-light">Xin lỗi, trang bạn đang tìm không tồn tại. nếu bạn cho rằng một cái gì đó là lỗi, hãy báo cáo sự cố.</span>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{route('home')}}" title="" class="btn btn-lg btn-block btn-light lift text-uppercase" style="color: #000;">Về Trang Chủ</a>
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
<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>

</body>
</html>
