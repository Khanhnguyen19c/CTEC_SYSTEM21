<div>
   
    <!-- main body area -->
    <div class="main">
        <!-- Body: Body -->
        <div class="body d-flex">
            <div class="container-xxl p-0">
                <div class="row g-0">
                    <div class="col-12 d-flex">
                        <!-- Card: -->
                        <div class="card card-chat border-right border-top-0 border-bottom-0  w380">
                            <div class="px-4 py-3 py-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control mb-1" placeholder="Search..." wire:model="Search">
                                </div>

                                <div class="nav nav-pills justify-content-between text-center" role="tablist">
                                    <!-- <a class="flex-fill rounded border-0 nav-link active" data-bs-toggle="tab" href="#chat-recent" role="tab" aria-selected="true">Chat</a> -->
                                    <a class="flex-fill rounded border-0 nav-link" data-bs-toggle="tab" href="#chat-contact" role="tab" aria-selected="true">Liên Lạc</a>
                                    <!-- <a class="flex-fill rounded border-0 nav-link" data-bs-toggle="tab" href="#chat-groups" role="tab" aria-selected="false" > Groups</a> -->

                                </div>
                            </div>

                            <div class="tab-content border-top">

                                <div class="tab-pane fade show active" id="chat-contact" role="tabpanel">
                                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                        <!-- Teacher -->
                                        @foreach ($class as $clas)
                                        <li class="list-group-item px-md-4 py-3 py-md-4">
                                            <a wire:click="getGroup({{$clas->ID_LOPCHUYENNGANH}})" href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ asset('assets/images/xs/class.png') }}" alt="">
                                                <div class="flex-fill ms-3 text-truncate">
                                                    <div class="d-flex justify-content-between mb-0">
                                                        <h6 class="mb-0">Lớp {{$clas->MALOPCHUYENNGANH}}</h6>
                                                    </div>
                                                    <span class="text-muted">Khoá {{$clas->NAMNHAPHOC}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        @if (isset($Teacher))
                                        <li class="list-group-item px-md-4 py-3 py-md-4">
                                            <a wire:click="getUser({{$Teacher->id}})" href="javascript:void(0);" class="d-flex">
                                                @if ($Teacher->HINHHOSO != NULL)
                                                <img class="avatar rounded-circle" src="{{asset('assets/images/Teachers')}}/{{$Teacher->HINHHOSO}}" alt="">
                                                @else
                                                <img class="avatar rounded-circle" src="{{ asset('assets/images/xs/student.PNG') }}" alt="">
                                                @endif
                                                <div class="flex-fill ms-3 text-truncate">
                                                    <div class="d-flex justify-content-between mb-0">
                                                        <h6 class="mb-0">{{$Teacher->TEN}}</h6>
                                                        <div class="text-muted">
                                                            @if($Teacher->is_online==true)
                                                            <i class="fa fa-circle text-success online-icon"></i>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <span class="text-muted">{{$Teacher->email}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endif

                                        @foreach($users as $user)
                                        @php
                                        $not_seen= App\Models\ChatGroup::where('user_id',$user->id)->where('receiver_id',auth()->id())->where('is_seen',false)->get() ?? null
                                        @endphp
                                        <li class="list-group-item px-md-4 py-3 py-md-4">
                                            <a wire:click="getUser({{$user->id}})" href="javascript:void(0);" class="d-flex">
                                                @if ($user->HINHDAIDIEN != NULL)
                                                <img class="avatar rounded-circle" src="{{asset('assets/images/Students')}}/{{$user->HINHDAIDIEN}}" alt="">
                                                @else
                                                <img class="avatar rounded-circle" src="{{ asset('assets/images/profile_av.PNG') }}" alt="">
                                                @endif
                                                <div class="flex-fill ms-3 text-truncate">
                                                    <div class="d-flex justify-content-between mb-0">
                                                        <h6 class="mb-0">{{$user->name}}</h6>
                                                        <div class="text-muted">
                                                            @if($user->is_online==true)
                                                            <i class="fa fa-circle text-success online-icon"></i>
                                                            @endif
                                                        </div>
                                                        @if(filled($not_seen))
                                                        <div class="badge badge-success rounded"> {{ $not_seen->count()}} </div>
                                                        @endif
                                                    </div>
                                                    <span class="text-muted">{{$user->email}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Card: -->
                        <div class="card card-chat-body border-0  w-100 px-4 px-md-5 py-3 py-md-4" wire:poll.visible="mountdata" style="height: 790px !important;">
                            <!-- Chat: Header -->
                            <div class="chat-header d-flex justify-content-between align-items-center border-bottom pb-3">
                                <div class="d-flex align-items-center">

                                    <a href="javascript:void(0);" title="">
                                        @if (isset($Teacher) && $Teacher->HINHHOSO != NULL)
                                        <img class="avatar sm rounded-circle me-1" src="{{ asset('assets/images/Teachers') }}/{{$Teacher->HINHHOSO}}" alt="avatar">
                                        @elseif(isset($sender) && $sender->sinhvien->HINHDAIDIEN != NULL)
                                        <img class="avatar rounded" src="{{ asset('assets/images/Students') }}/{{$sender->sinhvien->HINHDAIDIEN}}" alt="avatar">
                                        @elseif(isset($Group))
                                        <img class="avatar rounded" src="{{ asset('assets/images/xs/class.png') }}" alt="avatar">
                                        @else
                                        <img class="avatar rounded" src="{{ asset('assets/images/profile_av.PNG') }}" alt="avatar">
                                        @endif
                                    </a>
                                    <div class="ms-3">
                                        <h6 class="mb-0">
                                            @if(isset($sender))
                                            {{$sender->name}}
                                            @elseif(isset($Group))
                                            Lớp {{ $Group->MALOPCHUYENNGANH }}
                                            @elseif (isset($Teacher))
                                            {{ $Teacher->TEN }}
                                            @endif
                                        </h6>
                                        <small class="text-muted">
                                            @if(isset($sender) && $sender->is_online == 1)
                                            <i class="fa fa-circle text-success online-icon"></i>
                                            Online
                                            @elseif(isset($sender) )
                                            Truy cập: {{$sender->last_activity}}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="nav nav-pills justify-content-between text-center" role="tablist">
                                    <a class="nav-link py-2 px-3 text-muted d-none d-lg-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                                    <a class="nav-link py-2 px-3 text-muted d-none d-lg-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                                    <a class="nav-link py-2 px-3 text-muted d-none d-lg-block" href="javascript:void(0);"><i class="fa fa-gear"></i></a>
                                    <a class="nav-link py-2 px-3 text-muted d-none d-lg-block" href="javascript:void(0);"><i class="fa fa-info-circle"></i></a>
                                    <a class="nav-link py-2 px-3 d-block d-lg-none chatlist-toggle" data-bs-toggle="tab" href="#chat-contact" role="tab" aria-selected="true"><i class="fa fa-bars"></i></a>
                                    <!-- Mobile menu -->
                                    <div class="nav-item list-inline-item d-block d-xl-none">
                                        <div class="dropdown">
                                            <a class="nav-link text-muted px-0" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </a>
                                            <ul class="dropdown-menu shadow border-0">
                                                <li><a class="dropdown-item" href="#"><i class="fa fa-camera"></i> Share Images</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa fa-video-camera"></i> Video Call</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fa fa-info-circle"></i> Info</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat: body -->
                            <ul class="chat-history list-unstyled mb-0 py-lg-5 py-md-4 py-3 flex-grow-1">
                            @if(filled($allmessages))
                                @foreach($allmessages as $mgs)
                                @php
                                $name = App\Models\User::find($mgs->user_id);
                                @endphp
                                <li class="mb-5 d-flex align-items-end mess @if($mgs->user_id == auth()->id()) flex-row-reverse @else flex-row @endif">
                                    <div class="max-width-70 @if($mgs->user_id == auth()->id()) text-right @else @endif" style="margin-bottom:5px;">
                                        <div class="user-info mb-1">
                                            <span class="text-muted small" style="font-size:12px !important">{{ $name->name }}</span>
                                        </div>
                                        <div class="card border-0 p-3
                                        @if($mgs->user_id == auth()->id() && $mgs->status == 1) bg-primary
                                        @elseif ($mgs->status == 2) restore
                                        @else
                                         @endif">
                                            <div class="message">
                                                {{ $mgs->messages}}
                                            </div>
                                        </div>

                                        <style>
                                            .mess {
                                                position: relative;
                                            }

                                            .max-width-70:hover .seen {
                                                display: block;
                                            }

                                            .flex-row-reverse .seen {
                                                display: none;
                                                position: absolute;
                                                right: 2px !important;
                                                font-size: 12px;
                                                bottom: -35px;
                                            }

                                            .flex-row .seen {
                                                display: none;
                                                position: absolute;
                                                left: 2px;
                                                font-size: 12px;
                                                bottom: -35px;
                                            }
                                        </style>
                                        @if ($mgs->is_seen == 1)
                                        <p class="text-right seen"><i class="fas fa-check-circle"></i> Đã xem {{ $mgs->updated_at->format('h:i m-d ') }}</p>
                                        @else
                                        <p class="text-right seen"><i class="fas fa-check-circle"></i> Đã gửi {{ $mgs->created_at->format('h:i m-d ') }}</p>
                                        @endif
                                    </div>

                                    <!-- More option -->
                                    <div class="btn-group" wire:ignore>
                                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                                        @if($mgs->user_id == auth()->id())
                                        <ul class="dropdown-menu border-0 shadow">
                                            @if ($mgs->status == 1)
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'restore')">Thu Hồi</a></li>
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'delete')">Xoá</a></li>
                                            @else
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'delete_at')">Xoá</a></li>
                                            @endif
                                        </ul>
                                        @endif


                                    </div>
                                </li>
                                @endforeach
                            @elseif(filled($messages_group))
                                @foreach($messages_group as $mgs)
                                @php
                                $name = App\Models\User::find($mgs->user_id);
                                @endphp
                                <li class="mb-5 d-flex align-items-end mess @if($mgs->user_id == auth()->id()) flex-row-reverse @else flex-row @endif">
                                    <div class="max-width-70 @if($mgs->user_id == auth()->id()) text-right @else @endif" style="margin-bottom:5px;">
                                        <div class="user-info mb-1">
                                            @if($name)
                                            <span class="text-muted small" style="font-size:12px !important">{{ $name->name }}</span>
                                            @endif
                                        </div>
                                        <div class="card border-0 p-3
                                        @if($mgs->user_id == auth()->id() && $mgs->status == 1) bg-primary
                                        @elseif ($mgs->status == 2) restore
                                        @else
                                         @endif">
                                            <div class="message">
                                                {{ $mgs->messages}}
                                            </div>
                                        </div>

                                        <style>
                                            .mess {
                                                position: relative;
                                            }

                                            .max-width-70:hover .seen {
                                                display: block;
                                            }

                                            .flex-row-reverse .seen {
                                                display: none;
                                                position: absolute;
                                                right: 2px !important;
                                                font-size: 12px;
                                                bottom: -35px;
                                            }

                                            .flex-row .seen {
                                                display: none;
                                                position: absolute;
                                                left: 2px;
                                                font-size: 12px;
                                                bottom: -35px;
                                            }
                                        </style>

                                        @if ($mgs->updated_at !=null)
                                        @if ($mgs->is_seen == 1)
                                        <p class="text-right seen"><i class="fas fa-check-circle"></i> Đã xem {{ $mgs->updated_at->format('m-d h:i') }}</p>
                                        @else
                                        <p class="text-right seen"><i class="fas fa-check-circle"></i> Đã gửi {{ $mgs->created_at->format('m-d h:i') }}</p>
                                        @endif
                                        @endif
                                    </div>

                                    <!-- More option -->
                                    <div class="btn-group" wire:ignore>
                                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                                        @if($mgs->user_id == auth()->id())
                                        <ul class="dropdown-menu border-0 shadow">
                                            @if ($mgs->status == 1)
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'restore')">Thu Hồi</a></li>
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'delete')">Xoá</a></li>
                                            @else
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="restore({{$mgs->id}},'delete_at')">Xoá</a></li>
                                            @endif
                                        </ul>
                                        @endif


                                    </div>
                                </li>
                                @endforeach

                            @else
                            <h1 class="chat-body">Welcome Chat App CTEC</h1>
                            @endif

                            </ul>

                            <!-- Chat: Footer -->
                            <div class="chat-message">
                                <form wire:submit.prevent="SendMessage">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input wire:model="message" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary d-inline-block w-100"><i class="far fa-paper-plane"></i> Send</button>
                                        </div>

                                    </div>
                            </div>
                        </div> <!-- row end -->
                    </div>
                </div>
            </div>
        </div>
