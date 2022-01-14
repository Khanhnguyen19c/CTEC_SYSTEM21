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
                        <h3 class="fw-bold mb-0">Danh Sách Sinh viên lớp: {{$tile->MALOPHOCPHAN}}</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <a href="{{route('classmodule_list')}}"> <button type="button" class="btn btn-dark btn-set-task w-sm-100" style="margin-right: 10px;">Danh lớp học phần</button></a>
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="show_studentclass">
                                <i class="icofont-plus-circle"></i> Thêm Sinh Viên
                            </button>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-6 d-flex w-sm-100 align-items-center">
                                    <label for="">Chọn số mẫu tin: </label>
                                    <select class="form-control" wire:model="pageSize" style="width:75px;">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
                                    </select>
                                </div>
                                <div class="col-md-6 d-flex w-sm-100 m-auto align-items-center">
                                <label for="">Tìm kiếm: </label>
                                    <input type="text" placeholder="Tìm kiếm...." class="form-control" wire:model="search" style="width:250px;">
                                </div>
                            </div>
                            <table id="" class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã sinh viên</th>
                                        <th>Tên sinh viên</th>
                                        <th>Lớp chuyên ngành</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($students as $student)
                                    @php
                                        $i++
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$i}}</a>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$student->sinhvien->MASV}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$student->sinhvien->HODEM}} {{$student->sinhvien->TEN}}</span>
                                        </td>
                                        <td>{{$student->lopchuyennganh->MALOPCHUYENNGANH}}</td>
                                        <td>

                                        <!-- <button type="button" class="btn btn-outline-secondary" wire:click.prevent="edit_classModule({{$student->ID}})">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                        </a> -->
                                        <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_student({{$student->ID}})">
                                                    <i class="icofont-ui-delete text-danger"></i>
                                        </button>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $students->links('livewire.livewire-pagination-link') }}
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>
    <!-- @if ($showEditModal)
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Cập nhật sinh viên lớp học phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_classModule()">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="mb-3">
                                <label for="sub" class="form-label">Lớp chuyên ngành</label>
                                <select class="form-control" id="" wire:model="selectedlopchuyennganh">
                                    <option value="" selected>--Chọn lớp chuyên ngành</option>
                                    @foreach ($class as $class)
                                    <option value="{{$class->ID_LOPCHUYENNGANH}}">{{$class->MALOPCHUYENNGANH}}</option>
                                    @endforeach
                                </select>
                                @error('selectedlopchuyennganh') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            @if ($sinhvien)
                            <div class="mb-3" style="display: block;" id="checkboxes">
                                <input type="checkbox"  wire:model="checkall" style="margin-left: 5x ;margin-top: 13px" />
                                <span for="one" class="form-label" style="font-size:24px;padding-left:40px">
                                    CheckAll
                                </span>
                                <i class="icofont-hand-up" style="font-size: 30px;position:absolute;margin-left:-5px;"></i>
                                @foreach ($sinhvien as $sinhvien)

                                    <span for="one" class="form-label" style="font-size:24px">
                                    <input type="checkbox" id="one" value="{{$sinhvien->ID_SINHVIEN}}" wire:model="ID_SINHVIEN" />
                                        {{ $sinhvien->MASV }} - {{$sinhvien->HODEM}} {{$sinhvien->TEN}}
                                    </span>
                                    @endforeach
                            </div>
                            @endif
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
    @else -->
    <div class="modal fade" id="modalAddStudent" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Thêm sinh viên lớp học phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="add_studentclass()">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="mb-3">
                                <label for="sub" class="form-label">Lớp chuyên ngành</label>
                                <select class="form-control" id="" wire:model="selectedlopchuyennganh">
                                    <option value="" selected>--Chọn lớp chuyên ngành</option>
                                    @foreach ($class as $class)
                                    <option value="{{$class->ID_LOPCHUYENNGANH}}">{{$class->MALOPCHUYENNGANH}}</option>
                                    @endforeach
                                </select>
                                @error('selectedlopchuyennganh') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            @if ($sinhvien)
                            <div class="mb-3" style="display: block;" id="checkboxes">
                                <input type="checkbox"  wire:model="checkall" style="margin-left: 5x ;margin-top: 13px" />
                                <span for="one" class="form-label" style="font-size:24px;padding-left:40px">
                                    CheckAll
                                </span>
                                <i class="icofont-hand-up" style="font-size: 30px;position:absolute;margin-left:-5px;"></i>
                                @foreach ($sinhvien as $sinhvien)

                                    <span for="one" class="form-label" style="font-size:24px">
                                    <input type="checkbox" id="one" value="{{$sinhvien->ID_SINHVIEN}}" wire:model="ID_SINHVIEN" />
                                        {{ $sinhvien->MASV }} - {{$sinhvien->HODEM}} {{$sinhvien->TEN}}
                                    </span>
                                    @endforeach
                            </div>
                            @endif
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
    <!-- @endif -->
</div>
