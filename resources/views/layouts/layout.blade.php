<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'CTEC MANAGE' }}</title>
    <link rel="icon" href="{{asset('assets/images/logo/icon_ctec.png')}}" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{asset('assets/plugin/fullcalendar/main.min.css')}}">
    <!-- project css file  -->
    <link rel="stylesheet" href="{{asset('assets/css/my-task.style.min.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{asset('assets/plugin/nestable/jquery-nestable.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugin/datatables/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugin/datatables/dataTables.bootstrap5.min.css')}}">
    <!-- <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    @livewireStyles
</head>

<body>
    <div id="mytask-layout" class="theme-indigo">
        <!-- sidebar -->
        <div class="sidebar px-4 py-4 py-md-5 me-0">
            <div class="d-flex flex-column h-100">
                <a href="{{route('home')}}" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <img class="img-thumbnail" src="{{ asset('assets/images/logo/ctec_logo.png')}}" alt="">
                    </span>
                    <span class="logo-text">CTEC MANAGE</span>
                </a>

                @if (Route::has('login'))
                @auth
                @if(Auth::user()->utype === 'Student')
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li class="collapsed">
                        <a class="m-link" href="{{route('home')}}">
                            <i class="icofont-home fs-5"></i> <span>Trang Ch???</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" href="{{route('profile')}}">
                        <i class="icofont-graduate-alt"></i><span>Th??ng Tin C?? Nh??n</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-diem" href=""><i class="icofont-paper"></i> <span>Qu???n l?? K???t Qu???</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <ul class="sub-menu collapse" id="menu-diem">
                            <li><a class="ms-link" href="{{route('scoreboard_list')}}"><span><i class="icofont-long-arrow-right"></i> B???ng ??i???m theo h???c k???</span> </a></li>
                            <li><a class="ms-link" href="{{route('allscoreboard_list')}}"><span><i class="icofont-long-arrow-right"></i> K???t qu??? h???c t???p</span> </a></li>
                            <li><a class="ms-link" href="{{route('education_program')}}"><span><i class="icofont-long-arrow-right"></i> Ch????ng Tr??nh ????o T???o</span> </a></li>
                        </ul>
                    </li>


                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#app-Components" href="#">
                            <i class="icofont-contrast"></i> <span>App</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <ul class="sub-menu collapse" id="app-Components">
                            <li> <a class="ms-link active" href="{{route('chatapp')}}"><span><i class="icofont-long-arrow-right"></i> Chat App</span></a></li>
                        </ul>
                    </li>

                    <li><a class="m-link" href="{{route('contact')}}"><i class="icofont-university"></i> <span>Li??n H???</span></a></li>
                </ul>
                @elseif (Auth::user()->utype === 'Teacher')
                <ul class="menu-list flex-grow-1 mt-3">
                    <li class="collapsed">
                        <a class="m-link" href="{{route('home')}}">
                            <i class="icofont-home fs-5"></i> <span>Trang Ch???</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentsone" href="#"><i class="icofont-read-book-alt"></i> <span>Qu???n L?? L???p</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-Componentsone">
                            <li> <a class="ms-link" href="{{route('classOfteacher')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch sinh vi??n</span></a></li>

                        </ul>
                    </li>
                    @can('QLDT')
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-hoso" href="#"><i class="icofont-graduate-alt"></i> <span>Qu???n L?? H??? S??</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-hoso">
                            <li> <a class="ms-link" href="{{route('teacher_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch gi???ng vi??n</span></a></li>
                            <li> <a class="ms-link" href="{{route('student_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch sinh vi??n</span> </a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-class" href="#"><i class="icofont-read-book"></i> <span>Qu???n L?? Danh S??ch</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-class">
                            <li> <a class="ms-link" href="{{route('class_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch l???p</span> </a></li>
                            <li> <a class="ms-link" href="{{route('specialized_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch chuy??n ng??nh</span> </a></li>
                            <li> <a class="ms-link" href="{{route('branch_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch ng??nh</span> </a></li>
                            <li> <a class="ms-link" href="{{route('department_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch khoa</span> </a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#"><i class="icofont-university"></i> <span>Qu???n l?? h???c ph???n</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <ul class="sub-menu collapse" id="tikit-Components">
                            <li> <a class="ms-link" href="{{route('module_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch h???c ph???n</span></a></li>
                            <li> <a class="ms-link" href="{{route('classmodule_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch l???p h???c ph???n</span> </a></li>
                        </ul>
                    </li>
                    @endcan

                    <li class="collapsed">
                        <a class="m-link" href="#" data-bs-toggle="collapse" data-bs-target="#scorce-Components"><i class="icofont-certificate-alt-2"></i> <span>Qu???n L?? ??i???m S???</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <ul class="sub-menu collapse" id="scorce-Components">
                            <li> <a class="ms-link" href="{{route('coursescore_list')}}"><span><i class="icofont-long-arrow-right"></i> Danh s??ch ??i???m h???c ph???n</span></a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#app-Components" href="#">
                            <i class="icofont-contrast"></i> <span>App</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <ul class="sub-menu collapse" id="app-Components">
                            <li> <a class="ms-link active" href="{{route('chatapp')}}"><span><i class="icofont-long-arrow-right"></i> Chat App</span></a></li>
                        </ul>
                    </li>
                    @can('QLDT')
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentsone2" href="#"><i class="icofont-teacher"></i> <span>Qu???n l?? quy???n </span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-Componentsone2">
                            <li><a class="ms-link" href="{{route('roles_list')}}"><span><i class="icofont-long-arrow-right"></i> Qu???n l?? quy???n</span> </a></li>
                            <li> <a class="ms-link" href="{{route('Teacherroles_list')}}"><span><i class="icofont-long-arrow-right"></i> Ch???nh s???a quy???n gi??o vi??n</span> </a></li>
                        </ul>
                    </li>
                    @endcan

                    <li><a class="m-link"  href="{{route('contact')}}"><i class="icofont-university"></i> <span>Li??n H???</span></a></li>
                </ul>
                @endauth
                @endif
                @endif


                <!-- Theme: Switch Theme -->
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-center">
                        <div class="form-check form-switch theme-switch">
                            <input class="form-check-input" type="checkbox" id="theme-switch">
                            <label class="form-check-label" for="theme-switch">Ch??? ????? ban ????m</label>
                        </div>
                    </li>
                    <!-- <li class="d-flex align-items-center justify-content-center">
                        <div class="form-check form-switch theme-rtl">
                            <input class="form-check-input" type="checkbox" id="theme-rtl">
                            <label class="form-check-label" for="theme-rtl">Chuy???n Menu!</label>
                        </div>
                    </li> -->
                </ul>
                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
            </div>
        </div>
        <!-- main body area -->
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Body: Header -->
            @livewire('body-header-component')
            <!-- main body area -->
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <!-- Jquery Core Js -->
    <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>

    <!-- Plugin Js-->
    <script src="{{asset('assets/plugin/fullcalendar/main.min.js')}}"></script>

    <!-- Plugin Js-->
    <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>

    <!-- Jquery Page Js -->
    <script src="{{asset('js/template.js')}}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Day -->
    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script>
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
        });
    </script>
    <script>
        $(document).ready(function() {
            window.addEventListener('Toastr_message', event => {
                toastr.options = {
                    "positionClass": "toast-bottom-right",
                    "progressBar": true,
                }
                toastr.success(event.detail.message, 'Success');
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            window.addEventListener('Toastr_message_error', event => {
                toastr.options = {
                    "positionClass": "toast-bottom-right",
                    "progressBar": true,
                }
                toastr.error(event.detail.message, 'Error');
            });
        });
    </script>
    <script>
        window.addEventListener('show-form-add', event => {
            $('#modalAdd').modal('show');
        });
        window.addEventListener('show-form-edit', event => {
            $('#modalEdit').modal('show');
        });
        window.addEventListener('show-form-addclass', event => {
            $('#modalAddStudent').modal('show');
        });
        window.addEventListener('hide-form', event => {
            $('#modalAdd').modal('hide');
            $('#modalEdit').modal('hide');
            $('#modalReset').modal('hide');
            $('#modalAddStudent').modal('hide');
        });
    </script>
    @stack('scripts')

</body>

</html>
