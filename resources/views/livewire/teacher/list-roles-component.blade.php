<div>
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
                                        <th>Mã quyền</th>
                                        <th>Diễn giải</th>
                                        <th>Tên giảng viên quản lý</th>
                                        <th>Ghi chú</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($roles as $role)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$role->MA_QUYEN}}</a>
                                        </td>
                                        <td>
                                            <span class="fw-bold ms-1">{{$role->DIENGIAI}}</span>
                                        </td>
                                        <td>{{$role->giangvien->TEN}}</td>
                                        <td>{{$role->GHICHU }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-secondary" wire:click.prevent="edit_roles({{$role->ID_QUYEN}})">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="delete_roles({{$role->ID_QUYEN}})">
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
                 <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Cập nhật Quyền</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_roles()">
             <div class="modal-body">
                     <div class="mb-3">
                         <label for="sub" class="form-label">Mã quyền</label>
                         <input type="text" class="form-control" id="depone" wire:model="MAQUYEN">
                         @error('MAQUYEN') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>

                     <div class="deadline-form mt-3">
                         <div class="row g-3 mb-3">

                             <div class="col">
                                 <label for="deptwo" class="form-label">Diễn giải</label>
                                 <input type="text" class="form-control" id="deptwo" wire:model="DIENGIAI">
                                 @error('DIENGIAI') <p class="text-danger">{{ $message }}</p> @enderror
                             </div>
                             <div class="col">
                                 <label for="deptwo" class="form-label">Giảng viên</label>
                                 <select class="form-control" id="" wire:model="GIANGVIEN">
                                     <option value="">--Chọn giảng viên</option>
                                     @foreach ($teachers as $teacher)
                                     <option value="{{$teacher->ID_GIANGVIEN}}">{{$teacher->TEN}}</option>
                                     @endforeach
                                 </select>
                                 @error('GIANGVIEN') <p class="text-danger">{{ $message }}</p> @enderror
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
                 <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Thêm quyền mới</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
             <form method="POST" wire:submit.prevent="add_roles()">
             <div class="modal-body">
                     <div class="mb-3">
                         <label for="sub" class="form-label">Mã quyền</label>
                         <input type="text" class="form-control" id="depone" wire:model="MAQUYEN">
                         @error('MAQUYEN') <p class="text-danger">{{ $message }}</p> @enderror
                     </div>

                     <div class="deadline-form mt-3">
                         <div class="row g-3 mb-3">

                             <div class="col">
                                 <label for="deptwo" class="form-label">Diễn giải</label>
                                 <input type="text" class="form-control" id="deptwo" wire:model="DIENGIAI">
                                 @error('DIENGIAI') <p class="text-danger">{{ $message }}</p> @enderror
                             </div>
                             <div class="col">
                                 <label for="deptwo" class="form-label">Giảng viên</label>
                                 <select class="form-control" id="" wire:model="GIANGVIEN">
                                     <option value="">--Chọn giảng viên</option>
                                     @foreach ($teachers as $teacher)
                                     <option value="{{$teacher->ID_GIANGVIEN}}">{{$teacher->TEN}}</option>
                                     @endforeach
                                 </select>
                                 @error('GIANGVIEN') <p class="text-danger">{{ $message }}</p> @enderror
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

