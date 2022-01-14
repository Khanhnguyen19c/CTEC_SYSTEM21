<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Giảng Viên</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <a href="{{route('teacher_add')}}"> <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm Mới</button></a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" wire:ignore>
                            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã số</th>
                                        <th>Tên</th>
                                        <th>Khoa</th>
                                        <th>Ngày Sinh</th>
                                        <th>Số Phone</th>
                                        <th>Email</th>
                                        <th>Địa Chỉ</th>
                                        <th>Phái</th>
                                        <th>Tên Đăng Nhập</th>
                                        <th>Trạng Thái</th>
                                        <th>Thính Giảng</th>
                                        <th>Văn Bằng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($teachers as $teacher)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                    <td>{{$i}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$teacher->MAGV}}</a>
                                        </td>
                                        <td>
                                            @if ($teacher->HINHHOSO != NULL)
                                            <img class="avatar rounded-circle" src="{{asset('assets/images/Teachers')}}/{{$teacher->HINHHOSO}}" alt="">
                                            @else
                                            <img class="avatar rounded-circle" src="{{asset('assets/images/xs/avatar4.jpg')}}" alt="">
                                            @endif
                                            <span class="fw-bold ms-1">{{$teacher->TEN}}</span>
                                        </td>
                                        <td>{{$teacher->khoa->TENKHOA}}</td>
                                        <td>{{$teacher->NGAYSINH}}</td>
                                        <td>{{$teacher->SODIENTHOAI}}</td>
                                        <td>{{$teacher->EMAIL}}</td>
                                        <td>{{$teacher->DIACHI}}</td>
                                        <td>
                                            @if ($teacher->PHAI == 1)
                                            Nam
                                            @else
                                            Nữ
                                            @endif
                                        </td>
                                        <td>{{$teacher->TENDANGNHAP}}</td>
                                        <td>
                                            @if ($teacher->NGHIVIEC == 1)
                                            <span class="badge bg-warning">Nghỉ Việc</span>
                                            @else
                                            <span class="badge bg-success">Bình Thường</span>
                                            @endif
                                        </td>
                                        <td>{{$teacher->THINHGIANG}}</td>
                                        <td>{{$teacher->VANBANG}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('teacher_resetpass',['ID_GIANGVIEN'=>$teacher->ID_GIANGVIEN]) }}" class="btn btn-outline-secondary deleterow"  onclick="if (confirm('Bạn có chắc muốn cấp lại mật khẩu cho giảng viên này không?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Cấp mật khẩu</a>
                                                <a href="{{route('teacher_edit',['id'=>$teacher->ID_GIANGVIEN]) }}"><button type="button" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></button></button></a>
                                                <a href="{{route('teacher_delete',['id'=>$teacher->ID_GIANGVIEN]) }}" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()"><i class="icofont-ui-delete text-danger"></i></a>
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
</div>

