<div>
    <style>
        .modal-dialog-scrollable{
            max-width: 590px;
        }
    </style>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Học Phần</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="show_add()"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm mới</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <select class="form-control mt-2" wire:model="KHOA_ID">
                        <option value="">--Chọn Khoa</option>
                        @foreach ($khoas as $k)
                        <option value="{{$k->ID_KHOA}}">{{$k->TENKHOA}}</option>
                        @endforeach
                    </select>
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
                                    <select class="form-control" wire:model="pageSize" style="width:75px;text-align:center">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
                                    </select>
                                </div>
                                <div class="col-md-6 w-sm-100 m-auto">
                                    <input type="text" placeholder="Tìm kiếm...." class="form-control" wire:model="search" style="width:250px;">
                                </div>
                            </div>
                            <table class="table table-hover align-middle mb-0" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khoa</th>
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Loại học phần</th>
                                        <th>Số chỉ</th>
                                        <th>Lý thuyết</th>
                                        <th>Thực hành</th>
                                        <th>Bậc đào tạo</th>
                                        <th>Hệ đào tạo</th>
                                        <th>Quy chế đào tạo</th>
                                        <th>Ghi chú</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($modules as $module)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$i}}</a>
                                        </td>
                                        <td>
                                            {{$module->khoa->TENKHOA}}
                                            <span class="fw-bold ms-1"></span>
                                        </td>
                                        <td>{{$module->MAHOCPHAN}}</td>
                                        <td>{{$module->TENHOCPHAN}}</td>
                                        <td>{{$module->LOAIHOCPHAN}}</td>
                                        <td>{{$module->SOCHI}}</td>
                                        <td>{{$module->LYTHUYET}}</td>
                                        <td>{{$module->THUCHANH}}</td>
                                        <td>
                                            {{ $module->bacdaotao->TENDAYDU }}
                                        </td>
                                        <td>
                                            {{ $module->hedaotao->TENDAYDU }}
                                        </td>
                                        <td>{{$module->ID_QUYCHEDAOTAO}}</td>

                                        <td>{{$module->GHICHU}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a wire:click.prevent="edit_module({{$module->ID_HOCPHAN}})">
                                                        <button type="button" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i>
                                                        </button>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_module({{$module->ID_HOCPHAN}})"><i class="icofont-ui-delete text-danger"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $modules->links('livewire.livewire-pagination-link') }}
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>
    @if ($showEditModal)
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Cập nhật học phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_module()">
                    <div class="modal-body">
                        <div class="mb-3" >
                            <label for="depone" class="form-label">Khoa</label>
                            <select class="form-control" id="" wire:model="ID_KHOA">
                                <option value="">--Chọn khoa</option>
                                @foreach ($khoas as $khoa)
                                <option value="{{$khoa->ID_KHOA}}">{{$khoa->TENKHOA}}</option>
                                @endforeach
                            </select>
                            @error('ID_KHOA') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3" >
                            <div class="row g-3 mb-3">
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Mã học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="MAHOCPHAN">
                                    @error('MAHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Tên học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="TENHOCPHAN">
                                    @error('TENHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Loại học phần</label>
                                    <select class="form-control" id="" wire:model="LOAIHOCPHAN">
                                        <option value="">--Chọn loại học phần</option>
                                        <option value="Bắt Buộc">Bắt Buộc</option>
                                        <option value="Điều Kiện">Điều Kiện</option>
                                        <option value="Tự Chọn">Tự Chọn</option>
                                    </select>
                                    @error('LOAIHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Số chỉ</label>
                                    <input type="number" min="0" max="50" class="form-control" id="deptwo" wire:model="SOCHI">
                                    @error('SOCHI') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Số chỉ lý thuyết</label>
                                    <input type="number" min="0" max="50" class="form-control" id="deptwo" wire:model="LYTHUYET">
                                    @error('LYTHUYET') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Số chỉ thực hành</label>
                                    <input type="number" min="0" max="50" class="form-control" id="deptwo" wire:model="THUCHANH">
                                    @error('THUCHANH') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                            <div class="col mb-3">
                                    <label for="depone" class="form-label">Quy chế đào tạo</label>
                                    <input type="number" value="22" class="form-control" wire:model='ID_QUYCHEDAOTAO' />
                                    @error('ID_QUYCHEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc đào tạo</option>
                                        @foreach ($bacdaotaos as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotaos as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <input type="text" class="form-control" id="deptwo" wire:model="GHICHU">
                            @error('GHICHU') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Thêm học phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="add_module()">
                <div class="modal-body">
                        <div class="mb-3" >
                            <label for="depone" class="form-label">Khoa</label>
                            <select class="form-control" id="" wire:model="ID_KHOA">
                                <option value="">--Chọn khoa</option>
                                @foreach ($khoas as $khoa)
                                <option value="{{$khoa->ID_KHOA}}">{{$khoa->TENKHOA}}</option>
                                @endforeach
                            </select>
                            @error('ID_KHOA') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3" >
                            <div class="row g-3 mb-3">
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Mã học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="MAHOCPHAN">
                                    @error('MAHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Tên học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="TENHOCPHAN">
                                    @error('TENHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Loại học phần</label>
                                    <select class="form-control" id="" wire:model="LOAIHOCPHAN">
                                        <option value="">--Chọn loại học phần</option>
                                        <option value="Bắt Buộc">Bắt Buộc</option>
                                        <option value="Điều Kiện">Điều Kiện</option>
                                        <option value="Tự Chọn">Tự Chọn</option>
                                    </select>
                                    @error('LOAIHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Số chỉ</label>
                                    <input type="number" min="1" max="50" class="form-control" id="deptwo" wire:model="SOCHI">
                                    @error('SOCHI') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Số chỉ lý thuyết</label>
                                    <input type="number" min="0" max="50" class="form-control" id="deptwo" wire:model="LYTHUYET">
                                    @error('LYTHUYET') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Số chỉ thực hành</label>
                                    <input type="number" min="0" max="50" class="form-control" id="deptwo" wire:model="THUCHANH">
                                    @error('THUCHANH') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                            <div class="col mb-3">
                                    <label for="depone" class="form-label">Quy chế đào tạo</label>
                                    <input type="number" value="22" class="form-control" wire:model='ID_QUYCHEDAOTAO' />
                                    @error('ID_QUYCHEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc đào tạo</option>
                                        @foreach ($bacdaotaos as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotaos as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <input type="text" class="form-control" id="deptwo" wire:model="GHICHU">
                            @error('GHICHU') <p class="text-danger">{{ $message }}</p> @enderror
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
</div>


