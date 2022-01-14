<div>
      <!-- Body: Body -->
      <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col md-4">
                                <h3 class="fw-bold mb-0">Thêm Mới</h3>
                            </div>
                            <div class="col-md-8 text-center">
                                <a href="{{route('teacher_list')}}" class="btn btn-primary">Danh Sách</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" wire:submit.prevent="add_teacher()">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label for="firstname" class="form-label">Mã giảng viên</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="Nhập mã giảng viên" required wire:model="magv">
                                            @error('magv') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">Tên giảng viên</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Nhập tên giảng viên" required wire:model="name">
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Phái</label>
                                            <select name="PHAI" id="" class="form-control" wire:model="sex">
                                                <option value="" selected>-Chọn giới tính</option>
                                                <option value="0">Nữ</option>
                                                <option value="1">Nam</option>
                                            </select>
                                            @error('sex') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Ngày Sinh</label>
                                            <input type="date" class="form-control" id="admitdate" required wire:model="date">
                                            @error('date') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Số Điện Thoại</label>
                                            <input type="number" class="form-control" id="admitdate" placeholder="Nhập số điện thoại" required wire:model="phone">
                                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="emailaddress" placeholder="Nhập Email" required wire:model="email">
                                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Tên Đăng Nhập</label>
                                            <input type="text" class="form-control" id="emailaddress" placeholder="Tên đăng nhập" required wire:model="username">
                                            @error('username') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Mật Khẩu</label>
                                            <input type="password" class="form-control" id="emailaddress" placeholder="*****************" required wire:model="password">
                                            @error('password') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Thỉnh Giảng</label>
                                            <input type="text" class="form-control" id="emailaddress"  wire:model="thinhgiang">
                                            @error('thinhgiang') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Văn Bằng</label>
                                            <input type="text" class="form-control" id="emailaddress"  wire:model="vanbang">
                                            @error('vanbang') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFileMultiple" class="form-label"> Tải Ảnh Lên</label>
                                            <input class="form-control" type="file" id="formFileMultiple"  wire:model="image">
                                            <div wire:loading wire:target="image"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div>
                                            @error('image') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>

                                        <div class="col-md-6 text-center">
                                        @if ($image)
                                            <img src="{{$image->temporaryUrl() }}" width="250">
                                        @endif
                                         </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Khoa</label>
                                            <select name="PHAI" id="" class="form-control" wire:model="department">
                                                <option value="" selected>-Chọn Khoa</option>
                                                    @foreach ($departments as $department)
                                                    <option value="{{$department->ID_KHOA}}">{{$department->TENKHOA}}</option>
                                                    @endforeach
                                            </select>
                                            @error('department') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-12">
                                            <label for="emailaddress" class="form-label">Địa Chỉ</label>
                                            <input type="text" class="form-control" id="emailaddress" placeholder="Nhập địa chỉ" required wire:model="address">
                                            @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Thêm Mới</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end  -->

            </div>
        </div>
</div>
