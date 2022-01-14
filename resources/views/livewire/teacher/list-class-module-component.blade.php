<div>

    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Lớp học phần</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="show_add"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm mới</button>
                        </div>
                    </div>

                        <div class="col-md-6">
                        <select class="form-control mt-2" wire:model="KHOA_ID">
                            <option value="">--Chọn Khoa</option>
                            @foreach ($khoa as $k)
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
                                    <select class="form-control" wire:model="pageSize" style="width:75px;">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
                                    </select>
                                </div>
                                <div class="col-md-6 d-flex w-sm-100 m-auto align-items-center">
                                <label for="">Tìm kiếm: </label>
                                    <input type="text" placeholder="Tìm kiếm...." class="form-control" wire:model="Search" style="width:250px;">
                                </div>
                            </div>

                            <table  class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã học phần</th>
                                        <th>Tên giáo viên</th>
                                        <th>Học kỳ</th>
                                        <th>Niên khoá</th>
                                        <th>Mã lớp học phần</th>
                                        <th>Tên lớp học phần</th>
                                        <th>Sỉ số</th>
                                        <th>Bậc đào tạo</th>
                                        <th>Hệ đào tạo</th>
                                        <th>Hành Động</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($classModules as $classModule)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$classModule->hocphan->MAHOCPHAN}}</a>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->giaovien->TEN}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->HOCKY}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->NIENKHOA}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->MALOPHOCPHAN}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->TENLOPHOCPHAN}}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$classModule->SISO}}</span>
                                        </td>

                                        <td>{{$classModule->bacdaotao->TENDAYDU}}</td>
                                        <td>{{$classModule->hedaotao->TENDAYDU }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{ route('detail_classmodule',['id'=> $classModule->ID_LOPHOCPHAN ]) }}"><button type="button" class="btn btn-outline-secondary">
                                                        <i class="icofont-look"></i>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn btn-outline-secondary" wire:click.prevent="edit_classmodule({{$classModule->ID_LOPHOCPHAN}})">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_classmodule({{$classModule->ID_LOPHOCPHAN}})">
                                                    <i class="icofont-ui-delete text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>{{$classModule->GHICHU}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $classModules->links('livewire.livewire-pagination-link') }}
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>

    @if ($showEditModal)
    <!-- Edit Tickit-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Cập nhật lớp học phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form method="POST" wire:submit.prevent="update_classmodule()">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="mb-3">
                                <label for="sub" class="form-label">Mã học phần</label>
                                <select class="form-control" id="" wire:model="ID_HOCPHAN">
                                    <option value="">--Chọn học phần</option>
                                    @foreach ($module as $module)
                                    <option value="{{$module->ID_HOCPHAN}}">{{$module->MAHOCPHAN}} - {{$module->TENHOCPHAN}}</option>
                                    @endforeach
                                </select>
                                @error('MAHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col">
                                <label for="deptwo" class="form-label">Khoa</label>
                                <select class="form-control" id="" wire:model="selecetedkhoa">
                                    <option value="">--Chọn khoa</option>
                                    @foreach ($khoa as $khoa)
                                    <option value="{{$khoa->ID_KHOA}}">{{$khoa->TENKHOA}}</option>
                                    @endforeach
                                </select>
                                @error('Seleceted_khoa') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>


                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="deptwo" class="form-label">Học kỳ</label>
                                <input type="number" class="form-control" id="deptwo" wire:model="HOCKY">
                                @error('HOCKY') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col">
                                <label for="deptwo" class="form-label">Niên khoá</label>
                                <input type="text" class="form-control" id="deptwo" wire:model="NIENKHOA">
                                @error('NIENKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="deadline-form mt-3">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="deptwo" class="form-label">Mã lớp học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="MALOPHOCPHAN">
                                    @error('MALOPHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Tên lớp học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="TENLOPHOCPHAN">
                                    @error('TENLOPHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Giáo viên</label>
                                    <select class="form-control" id="" wire:model="selecetedgiangvien">
                                        <option value="">--Chọn giáo viên</option>
                                        @foreach ($giangvien as $giangvien)
                                        <option value="{{$giangvien->ID_GIANGVIEN}}">{{$giangvien->TEN}}</option>
                                        @endforeach
                                    </select>
                                    @error('selecetedgiangvien') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc</option>
                                        @foreach ($bacdaotaos as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotaos as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label">Ghi chú</label>
                            <input type="text" class="form-control" id="deptwo" wire:model="GHICHU">
                            @error('GHICHU') <p class="text-danger">{{ $message }}</p> @enderror
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
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Thêm lớp học phần mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="add_classmodule()">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="mb-3">
                                <label for="sub" class="form-label">Mã học phần</label>
                                <select class="form-control" id="" wire:model="ID_HOCPHAN">
                                    <option value="">--Chọn học phần</option>
                                    @foreach ($module as $module)
                                    <option value="{{$module->ID_HOCPHAN}}">{{$module->MAHOCPHAN}} - {{$module->TENHOCPHAN}}</option>
                                    @endforeach
                                </select>
                                @error('MAHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col">
                                <label for="deptwo" class="form-label">Khoa</label>
                                <select class="form-control" id="" wire:model="selecetedkhoa">
                                    <option value="">--Chọn khoa</option>
                                    @foreach ($khoa as $khoa)
                                    <option value="{{$khoa->ID_KHOA}}">{{$khoa->TENKHOA}}</option>
                                    @endforeach
                                </select>
                                @error('Seleceted_khoa') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="deptwo" class="form-label">Học kỳ</label>
                                <input type="number" class="form-control" id="deptwo" wire:model="HOCKY">
                                @error('HOCKY') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="col">
                                <label for="deptwo" class="form-label">Niên khoá</label>
                                <input type="text" class="form-control" id="deptwo" wire:model="NIENKHOA">
                                @error('NIENKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="deadline-form mt-3">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="deptwo" class="form-label">Mã lớp học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="MALOPHOCPHAN">
                                    @error('MALOPHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Tên lớp học phần</label>
                                    <input type="text" class="form-control" id="deptwo" wire:model="TENLOPHOCPHAN">
                                    @error('TENLOPHOCPHAN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Giáo viên</label>
                                    <select class="form-control" id="" wire:model="selecetedgiangvien">
                                        <option value="">--Chọn giáo viên</option>
                                        @foreach ($giangvien as $giangvien)
                                        <option value="{{$giangvien->ID_GIANGVIEN}}">{{$giangvien->TEN}}</option>
                                        @endforeach
                                    </select>
                                    @error('selecetedgiangvien') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc</option>
                                        @foreach ($bacdaotaos as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="deptwo" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotaos as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="mb-3 mt-3">
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
