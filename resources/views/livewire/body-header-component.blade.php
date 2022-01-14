
<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl">
            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">

                <div class="dropdown notifications zindex-popover">
                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="icofont-alarm fs-5"></i>
                        <div class="icon-count">
                            {{ $count }}

                        </div>
                        <span class="pulse-ring"></span>
                    </a>
                    <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                        <div class="card border-0 w380">
                            <div class="card-header border-0 p-3">
                                <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                    <span>Thông Báo</span>
                                    <span class="badge text-white"></span>
                                </h5>
                            </div>
                            <div class="tab-content card-body">
                                <div class="tab-pane fade show active">
                                    <ul class="list-unstyled list mb-0">
                                        @foreach ($event as $event)
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">{{$event->title}}</span> <small>{{substr($event->start,10,6)}}</small></p>
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold"></span> <small>{{substr($event->end,10,6)}}</small></p>
                                                    <span class=""><span class="badge bg-success" style="margin-right:3px;">Event</span> {{substr($event->start,0,10)}} Đến {{substr($event->end,0,10)}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        @foreach ($chat_group as $chat)
                                        @php
                                        $name = App\Models\User::find($chat->user_id);
                                        @endphp
                                        <li class="py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                @if ($name->HINHDAIDEN)
                                                <img class="avatar rounded-circle" src="{{asset('assets/images/Students')}}/{{$name->HINHDAIDEN}}" alt="">
                                                @else
                                                <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="">
                                                @endif
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">
                                                            {{ $name->name }}
                                                        </span></p>
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold"></span> <small>{{$chat->created_at->format("d/m/y h:i")}}</small></p>
                                                    <small class="">{{$chat->messages}}</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <a class="card-footer text-center border-top-0" href="{{route('chatapp')}}">Xem tất cả tin nhắn</a>
                        </div>
                    </div>
                </div>
                @if (Route::has('login'))
                @auth
                <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                    <div class="u-info me-2">

                        <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
                        <small>{{ Auth::user()->utype }}</small>
                    </div>
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                        @if (Auth::user()->utype == 'Teacher')
                        @if($profile_teacher->HINHHOSO != NULL)
                        <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('assets/images/Teachers')}}/{{$profile_teacher->HINHHOSO}}" alt="{{$profile_teacher->TEN}}">
                        @else
                        <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="{{$profile_teacher->TEN}}">
                        @endif
                        @else
                        @if($profile->HINHDAIDIEN != NULL)
                        <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('assets/images/Students')}}/{{$profile->HINHDAIDIEN}}" alt="{{$profile->TEN}}">
                        @else
                        <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="{{$profile->TEN}}">
                        @endif
                        @endif
                    </a>
                    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    @if (Auth::user()->utype == 'Teacher')
                                    @if($profile_teacher->HINHHOSO != NULL)
                                    <img class="avatar rounded-circle" src="{{asset('assets/images/Teachers')}}/{{$profile_teacher->HINHHOSO}}" alt="{{$profile_teacher->TEN}}">
                                    @else
                                    <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="{{$profile_teacher->TEN}}">
                                    @endif
                                    @else
                                    @if($profile->HINHDAIDIEN != NULL)
                                    <img class="avatar rounded-circle" src="{{asset('assets/images/Students')}}/{{$profile->HINHDAIDIEN}}" alt="{{$profile->TEN}}">
                                    @else
                                    <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="{{$profile->TEN}}">
                                    @endif
                                    @endif
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
                                        <small class="">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                                <div>

                                    <hr class="dropdown-divider border-dark">
                                </div>
                                @if (Auth::user()->utype == 'Teacher')
                                <a class="list-group-item list-group-item-action border-0" data-bs-toggle="modal" data-bs-target="#modalReset"><i class="icofont-ui-password"></i> Cập nhật mật khẩu</a>
                                @endif
                            </div>
                            <div class="list-group m-2 ">
                                @if (Auth::user()->utype == 'Student')
                                <a href="{{route('profile')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-tasks fs-5 me-3"></i>Thông tin cá nhân</a>
                                @endif
                                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action border-0 " onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><i class="icofont-logout fs-6 me-3"></i>Đăng Xuất</a>
                                <form id="form-logout" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                                <div>
                                    <hr class="dropdown-divider border-dark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endauth
            @endif
            <!-- menu toggler -->
            <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                <span class="fa fa-bars"></span>
            </button>

            <!-- main menu Search-->
            <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

            </div>

        </div>
    </nav>
    @if (Auth::user()->utype == 'Teacher')
    <div class="modal fade" id="modalReset" tabindex="-1" aria-labelledby="modalReset" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="edit2Label">Thay đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="change_pass">
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    @if (Session::has('message'))
                                    <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                                    @endif
                                    <label for="exampleFormControlInput8775" class="form-label">Mật khẩu cũ</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput8775" wire:model="OLD_PASS">
                                    @error('OLD_PASS') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput97775" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput97775" wire:model="password">
                                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput27705" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput27705" name="password_confirmation" wire:model="password_confirmation">
                                    @error('password_confirmtion') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
