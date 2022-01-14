<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Lớp Chuyên Ngành</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="showForm()"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm mới</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <select class="form-control mt-2" wire:model="NGANH_ID">
                        <option value="">--Chọn Chuyên Ngành</option>
                        @foreach ($chuyennganh as $ng)
                        <option value="{{$ng->ID_CHUYENNGANH}}">{{$ng->MACHUYENNGANH}}</option>
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
                                        <th>ID lớp</th>
                                        <th>Tên chuyên ngành</th>
                                        <th>Mã lớp</th>
                                        <th>Năm nhập học</th>
                                        <th>Sỉ số</th>
                                        <th>Giáo viên hướng dẫn</th>
                                        <th>Ghi chú</th>
                                        <th>Bậc đào tạo</th>
                                        <th>Hệ đào tạo</th>
                                        <th>Cơ sở</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($class as $clas)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$i}}</a>
                                        </td>
                                        <td>
                                            {{$clas->chuyennganh->TENVIETTAT}}
                                            <span class="fw-bold ms-1"></span>
                                        </td>
                                        <td>{{$clas->MALOPCHUYENNGANH}}</td>
                                        <td>{{$clas->NAMNHAPHOC}}</td>
                                        <td>{{$clas->SISO}}</td>
                                        <td>
                                            {{ $clas->giangvien->TEN }}
                                        </td>

                                        <td>
                                            {{ $clas->GHICHU }}
                                        </td>
                                        <td>
                                            {{ $clas->bacdaotao->TENDAYDU }}
                                        </td>
                                        <td>
                                            {{ $clas->hedaotao->TENDAYDU }}
                                        </td>
                                        <td>{{$clas->CS}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a wire:click.prevent="edit_class({{$clas->ID_LOPCHUYENNGANH}})">
                                                        <button type="button" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i>
                                                        </button>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_class({{$clas->ID_LOPCHUYENNGANH}})"><i class="icofont-ui-delete text-danger"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $class->links('livewire.livewire-pagination-link') }}
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>
    <!-- MODAL -->
    @if ($showEditModal)
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content" style="overflow: scroll;">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Cập nhật lớp chuyên ngành</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_class()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sub" class="form-label">Mã lớp chuyên ngành</label>
                            <input type="text" class="form-control" wire:model="MALOPCHUYENNGANH">
                            @error('MALOPCHUYENNGANH') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="depone" class="form-label">Chuyên ngành</label>
                            <select class="form-control" id="" wire:model="selectedchuyennganh">
                                <option value="">--Chọn chuyên ngành</option>
                                @foreach ($chuyennganh as $item_nganh)
                                <option value="{{$item_nganh->ID_CHUYENNGANH}}">{{$item_nganh->TENVIETTAT}}</option>
                                @endforeach
                            </select>
                            @error('ID_CHUYENNGANH') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Giáo viên</label>
                                    <select class="form-control" id="" wire:model="GVCN">
                                        <option value="">--Chọn giáo viên</option>
                                        @foreach ($giaovien as $giaovien)
                                        <option value="{{$giaovien->ID_GIANGVIEN}}">{{$giaovien->TEN}}</option>
                                        @endforeach
                                    </select>
                                    @error('GVCN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Năm nhập học</label>
                                    <input type="number" min="2010" max="2099" value="2020" class="form-control" id="deptwo" wire:model="NAMNHAPHOC">
                                    @error('NAMNHAPHOC') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Sỉ số lớp</label>
                                    <input type="number" class="form-control" id="deptwo" wire:model="SISOLOP">
                                    @error('SISOLOP') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Cơ sở</label>
                                    <select class="form-control" id="" wire:model="CS">
                                        <option value="">--Chọn cơ sở</option>
                                        <option value="1">Cơ sở 1</option>
                                        <option value="2">Cơ sở 2</option>
                                    </select>
                                    @error('CS') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc đào tạo</option>
                                        @foreach ($bacdaotao as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotao as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
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
                    <h5 class="modal-title  fw-bold" id="leaveaddLabel">Thêm lớp chuyên ngành</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="add_class()">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="sub" class="form-label">Mã lớp chuyên ngành</label>
                            <input type="text" class="form-control" wire:model="MALOPCHUYENNGANH">
                            @error('MALOPCHUYENNGANH') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="depone" class="form-label">Chuyên ngành</label>
                            <select class="form-control" id="" wire:model="selectedchuyennganh">
                                <option value="">--Chọn chuyên ngành</option>
                                @foreach ($chuyennganh as $item_nganh)
                                <option value="{{$item_nganh->ID_CHUYENNGANH}}">{{$item_nganh->TENVIETTAT}}</option>
                                @endforeach
                            </select>
                            @error('ID_CHUYENNGANH') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Giáo viên</label>
                                    <select class="form-control" id="" wire:model="GVCN">
                                        <option value="">--Chọn giáo viên</option>
                                        @foreach ($giaovien as $giaovien)
                                        <option value="{{$giaovien->ID_GIANGVIEN}}">{{$giaovien->TEN}}</option>
                                        @endforeach
                                    </select>
                                    @error('GVCN') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Năm nhập học</label>
                                    <input type="number" min="2010" max="2099" value="2020" class="form-control" id="deptwo" wire:model="NAMNHAPHOC">
                                    @error('NAMNHAPHOC') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="deptwo" class="form-label">Sỉ số lớp</label>
                                    <input type="number" class="form-control" id="deptwo" wire:model="SISOLOP">
                                    @error('SISOLOP') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="depone" class="form-label">Cơ sở</label>
                                    <select class="form-control" id="" wire:model="CS">
                                        <option value="">--Chọn cơ sở</option>
                                        <option value="1">Cơ sở 1</option>
                                        <option value="2">Cơ sở 2</option>
                                    </select>
                                    @error('CS') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Bậc đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_BACDAOTAO">
                                        <option value="">--Chọn bậc đào tạo</option>
                                        @foreach ($bacdaotao as $bacdaotao)
                                        <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_BACDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="depone" class="form-label">Hệ đào tạo</label>
                                    <select class="form-control" id="" wire:model="ID_HEDAOTAO">
                                        <option value="">--Chọn hệ đào tạo</option>
                                        @foreach ($hedaotao as $hedaotao)
                                        <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                        @endforeach
                                    </select>
                                    @error('ID_HEDAOTAO') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
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
                        <button type="submit" class="btn btn-primary">Thêm Mới</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endif
</div>
