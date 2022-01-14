<div>
<style>
        #checkboxes {
            display: BLOCK;
            margin-top: 7px;
        }

        #checkboxes span {
            display: block;
            font-size: 24px;
            padding-left: 50px;

        }
        #checkboxes span:hover {
            background-color: #1e90ff;
        }

        input[type=checkbox] {
            transform: scale(1.5);
            margin-right: 10px;
            float: left;
            margin-top: 12px;
        }
        #one{
            margin-left: 20px;
        }
        .icofont-hand-up{
            animation: bounceTop 5s ease-in-out infinite;
        }@keyframes bounceTop{

        0%,100%{

            transform: translateY(-15px);

        }

        50%{

            transform: translateY(0px);

        }

        }
    </style>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Quyền</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="show_add"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm mới</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên giảng viên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Quyền</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($roles_list as $roles)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$roles->giangvien->TEN}}</a>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$roles->giangvien->EMAIL}}<i class="mdi mdi-email-lock:"></i></span>
                                        </td>
                                        <td>{{$roles->giangvien->SODIENTHOAI}}</td>
                                        <td>
                                            @foreach ($roles->quyen as $role)
                                            {{$role->DIENGIAI}}
                                            @if (!$loop->last),
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-secondary" wire:click.prevent="edit_roles({{$roles->ID_GVQUYEN}})">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_roles({{$roles->ID_GVQUYEN}})">
                                                    <i class="icofont-ui-delete text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>
    @if ($showEditModal)
    <!-- Edit Tickit-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Cập nhật Vai trò</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_roles()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sub" class="form-label">Vai trò</label>
                            <select class="form-control" id="" wire:model="ID_QUYEN">
                                <option value="">--Chọn vai trò</option>
                                @foreach ($quyen as $roles)
                                <option value="{{$roles->ID_QUYEN}}">{{$roles->MA_QUYEN}}</option>
                                @endforeach
                            </select>
                            @error('ID_QUYEN') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="deadline-form mt-3">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="deptwo" class="form-label">Giảng viên</label>
                                    <select class="form-control" id="" wire:model="ID_GIANGVIEN">
                                        <option value="">--Chọn giảng viên</option>
                                        @foreach ($teachers as $teacher)
                                        <option value="{{$teacher->ID_GIANGVIEN}}">{{$teacher->TEN}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_GIAOVIEN') <p class="text-danger">{{ $message }}</p> @enderror
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
    @else
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true" wire:ignore.self>>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Thêm vai trò giảng viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="add_roles()">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="mb-3">
                            <label for="sub" class="form-label">Vai trò</label>
                            <select class="form-control" id="" wire:model="ID_QUYEN">
                                <option value="">--Chọn vai trò</option>
                                @foreach ($quyen as $roles)
                                <option value="{{$roles->ID_QUYEN}}">{{$roles->MA_QUYEN}}</option>
                                @endforeach
                            </select>
                            @error('ID_QUYEN') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                            <div class="mb-3" style="display: block;" id="checkboxes">
                                <input type="checkbox"  wire:model="checkall" style="margin-left: 5x ;margin-top: 13px" />
                                <span for="one" class="form-label" style="font-size:24px;padding-left:40px">
                                    CheckAll
                                </span>
                                <i class="icofont-hand-up" style="font-size: 30px;position:absolute;margin-left:-5px;"></i>
                                @foreach ($teachers as $teacher)
                                    <span for="one" class="form-label" style="font-size:24px">
                                    <input type="checkbox" id="one" value="{{$teacher->ID_GIANGVIEN}}" wire:model="ID_GIANGVIEN" />
                                       {{$teacher->TEN}} - {{$teacher->khoa->TENKHOA}}
                                    </span>
                                    @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endif
