<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Khoa</h3>
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
                            <table class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã khoa</th>
                                        <th>Tên khoa</th>
                                        <th>Tên viết tắt</th>
                                        <th>Trưởng khoa</th>
                                        <th>Ghi chú</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($Departments as $Department)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$Department->MAKHOA}}</a>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$Department->TENKHOA}}</span>
                                        </td>
                                        <td>{{$Department->TENVIETTAT}}</td>
                                        <td>{{$Department->TRUONGKHOA}}</td>
                                        <td>{{$Department->GHICHU }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-secondary" wire:click.prevent="edit_department({{$Department->ID_KHOA}})">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_department({{$Department->ID_KHOA}})">
                                                    <i class="icofont-ui-delete text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $Departments->links('livewire.livewire-pagination-link') }}
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
                 <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Cập nhật khoa</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
             <form method="POST" wire:submit.prevent="update_department()">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label for="sub" class="form-label">Mã khoa</label>
                         <input type="text" class="form-control" id="depone" wire:model="MAKHOA">
                         @error('MAKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>
                     <div class="col">
                         <label for="depone" class="form-label">Tên khoa</label>
                         <input type="text" class="form-control" id="depone" wire:model="TENKHOA">
                         @error('TENKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>
                     <div class="deadline-form mt-3">
                         <div class="row g-3 mb-3">

                             <div class="col">
                                 <label for="deptwo" class="form-label">Tên viêt tắt</label>
                                 <input type="text" class="form-control" id="deptwo" wire:model="TENVIETTAT">
                                 @error('TENVIETTAT') <p class="text-danger">{{ $message }}</p> @enderror
                             </div>
                             <div class="col">
                                 <label for="deptwo" class="form-label">Trưởng khoa</label>
                                 <select class="form-control" id="" wire:model="TRUONGKHOA">
                                     <option value="">--Chọn giảng viên</option>
                                     @foreach ($teachers as $teacher)
                                     <option value="{{$teacher->TEN}}">{{$teacher->TEN}}</option>
                                     @endforeach
                                 </select>
                                 @error('TRUONGKHOA') <p class="text-danger">{{ $message }}</p> @enderror
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
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true" wire:ignore.self>>
     <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
         <div class="modal-content" style="overflow: scroll;">
             <div class="modal-header">
                 <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Thêm khoa mới</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
             <form method="POST" wire:submit.prevent="add_department()">
             <div class="modal-body">
                     <div class="mb-3">
                         <label for="sub" class="form-label">Mã khoa</label>
                         <input type="text" class="form-control" id="depone" wire:model="MAKHOA">
                         @error('MAKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>
                     <div class="col">
                         <label for="depone" class="form-label">Tên khoa</label>
                         <input type="text" class="form-control" id="depone" wire:model="TENKHOA">
                         @error('TENKHOA') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>
                     <div class="deadline-form mt-3">
                         <div class="row g-3 mb-3">

                             <div class="col">
                                 <label for="deptwo" class="form-label">Tên viêt tắt</label>
                                 <input type="text" class="form-control" id="deptwo" wire:model="TENVIETTAT">
                                 @error('TENVIETTAT') <p class="text-danger">{{ $message }}</p> @enderror
                             </div>
                             <div class="col">
                                 <label for="deptwo" class="form-label">Trưởng khoa</label>
                                 <select class="form-control" id="" wire:model="TRUONGKHOA">
                                     <option value="">--Chọn giảng viên</option>
                                     @foreach ($teachers as $teacher)
                                     <option value="{{$teacher->TEN}}">{{$teacher->TEN}}</option>
                                     @endforeach
                                 </select>
                                 @error('TRUONGKHOA') <p class="text-danger">{{ $message }}</p> @enderror
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

