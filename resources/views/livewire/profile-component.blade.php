<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
                            <h3 class=" fw-bold flex-fill mb-0">Thông Tin Cá Nhân</h3>
                            <div class="card mb-3">
                                <div class="col-auto py-2 w-sm-100">
                                    <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#Invoice-list" role="tab">Thông tin cơ bản</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#Invoice-Simple" role="tab">Thông tin gia đình</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#Invoice-Email" role="tab">Thông tin khác</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
        <div class="row g-3" style="margin: 0 auto;">
            <div class="col-xl-10 col-lg-9 col-md-9">
                <div class="card teacher-card  mb-3">
                    <div class="card-body d-flex teacher-fulldeatil">
                        <div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
                            <a href="#">
                                @if ($profile->HINHDAIDIEN)
                                <img src="{{asset('assets/images/Students')}}/{{$profile->HINHDAIDIEN}}" alt="{{$profile->TEN}}" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                               @else
                               <img src="{{asset('assets/images/xs/student.png')}}" alt="{{$profile->TEN}}" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                @endif
                            </a>
                            <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                <h6 class="mb-0 fw-bold d-block fs-6">{{$profile->lopchuyennganh->MALOPCHUYENNGANH}}</h6>
                                <span class="text-muted small">MÃ SỐ : {{$profile->MASV}}</span>
                            </div>
                        </div>
                        <div class="teacher-info border-start ps-xl-4 ps-md-4 ps-sm-4 ps-4 w-100">
                            <h6 class="mb-0 mt-2  fw-bold d-block fs-6">{{$profile->HODEM}} {{$profile->TEN}}</h6>
                            <p class="mt-2 small"></p>
                            <div class="row g-2 pt-2">
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <i class="icofont-children-care"></i>
                                        <span class="ms-2 small">Khoa: {{$profile->khoa->TENKHOA}} </span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <i class="icofont-qr-code"></i>
                                        <span class="ms-2 small">Lớp chuyên ngành: {{$profile->lopchuyennganh->MALOPCHUYENNGANH}} </span>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <i class="icofont-ui-touch-phone"></i>
                                        <span class="ms-2 small">Phone: {{$profile->SODIENTHOAI}} </span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <i class="icofont-email"></i>
                                        <span class="ms-2 small">Email: {{$profile->EMAIL}}</span>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#modalReset"><i class="icofont-ui-password"></i> Cập nhật mật khẩu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row End -->
        <div class="row g-3" style="margin-left: 15px;">
            <div class="col-md-12">
                <div class="col-lg-9 col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="Invoice-list">
                            <div class="row justify-content-center">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Thông tin cơ bản</h6>
                                        <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="icofont-edit text-primary fs-6"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Mã sinh viên</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->MASV}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Họ đệm</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->HODEM}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Tên</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->TEN}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Giới tính</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->PHAI}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Ngày sinh</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NGAYSINH}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Nơi sinh</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NOISINH}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Địa chỉ liên lạc</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->DIACHILIENLAC}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Số hồ sơ nhập học</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->SOHOSO}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Chuyên ngành</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->chuyennganh->MACHUYENNGANH}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Khoa</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->khoa->TENKHOA}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Lớp chuyên ngành</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->lopchuyennganh->MALOPCHUYENNGANH}}</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- Row end  -->
                        </div> <!-- tab end  -->
                        <div class="tab-pane fade" id="Invoice-Simple">
                            <div class="row justify-content-center">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Thông tin gia đình</h6>
                                        <!-- <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#edit1"><i class="icofont-edit text-primary fs-6"></i></button> -->
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Họ tên cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->HOTENCHA}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Số điện thoại cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->SODIENTHOAICHA}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Năm sinh cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NAMSINHCHA}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Nghề nghiệp cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NGHECHA}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Dân tộc cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->DANTOCCHA}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Tôn giáo cha</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->TONGIAOCHA}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Địa chỉ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->DIACHICHAME}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Họ tên mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->HOTENME}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Số điện thoại mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->SODIENTHOAIME}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Năm sinh mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NAMSINHME}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Nghề nghiệp mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->NGHEME}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Dân tộc mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->DANTOCME}}</span>
                                                </div>
                                            </li>

                                            <li class="row flex-wrap mb-3">
                                                <div class="col-3">
                                                    <span class="text-muted">Tôn giáo mẹ</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->TONGIAOME}}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text-muted">Hộ khẩu</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="fw-bold">{{$profile->HOKHAU}}</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- Row end  -->
                            </div>
                        </div> <!-- tab end  -->
                        <div class="tab-pane fade" id="Invoice-Email">
                        <div class="row justify-content-center">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Thông tin khác</h6>
                                        <!-- <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#edit1"><i class="icofont-edit text-primary fs-6"></i></button> -->
                                    </div>
                            <div class="row justify-content-center">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Số tài khoản ngân hàng</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->SOTKNGANHANG}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Số chứng minh thư</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->CMND}}</span>
                                            </div>
                                        </li>
                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Ngày cấp chứng minh thư</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NGAYCAP}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Nơi cấp chứng minh thư</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NOICAP}}</span>
                                            </div>
                                        </li>

                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Email cá nhân</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->EMAIL}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Số điện thoại di động</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->SODIENTHOAI}}</span>
                                            </div>
                                        </li>
                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Số điện thoại phụ</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->SODIENTHOAI2}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Dân tộc</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->DANTOC}}</span>
                                            </div>
                                        </li>


                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Tôn giáo</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->TONGIAO}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Đối tượng ưu tiên</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->DOITUONGUUTIEN}}</span>
                                            </div>
                                        </li>


                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Ngày kết nạp đoàn</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NGAYKETNAPDOAN}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Nơi kết nạp đoàn</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NOIKETNAPDOAN}}</span>
                                            </div>
                                        </li>

                                        <li class="row flex-wrap mb-3">
                                            <div class="col-3">
                                                <span class="text-muted">Ngày kết nạp đảng</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NGAYKETNAPDANG}}</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="text-muted">Nơi kết nạp đảng</span>
                                            </div>
                                            <div class="col-3">
                                                <span class="fw-bold">{{$profile->NOIKETNAPDANG}}</span>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div> <!-- Row end  -->
                        </div> <!-- tab end  -->
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
    </div>
    <!-- Modal-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="edit2Label">Thay đổi thông tin cơ bản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form method="POST" wire:submit.prevent="update_profile">
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput8775" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput8775" wire:model="SODIENTHOAI">
                                    @error('SODIENTHOAI') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput977" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput9775" wire:model="EMAIL">
                                    @error('EMAIL') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput97775" class="form-label">Địa chỉ liên lạc</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput97775" wire:model="DIACHILIENLAC">
                                    @error('DIACHILIENLAC') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput27705" class="form-label">Số CMND</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput27705" wire:model="CMND">
                                    @error('CMND') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <label for="exampleFormControlInput27705" class="form-label">Số TK ngân hàng</label>
                                <input type="text" class="form-control" id="exampleFormControlInput27705" wire:model="SOTKNGANHANG">
                                @error('SOTKNGANHANG') <p class="text-danger">{{ $message }}</p> @enderror
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

    <div class="modal fade" id="modalReset" tabindex="-1" aria-labelledby="modalReset" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="edit2Label">Thay đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" wire:submit.prevent="update_pass">
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    @if (Session::has('message'))
                                    <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                                    @endif
                                    <label for="exampleFormControlInput8775" class="form-label">Mật khẩu cũ</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput8775" wire:model="OLD_PASS">
                                    @error('OLD_PASS') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlInput97775" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput97775" wire:model="password">
                                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput27705" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput27705" name="password_confirmation" wire:model="password_confirmation">
                                    @error('password_confirmtion') <p class="text-danger">{{ $message }}</p> @enderror
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
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        window.addEventListener('Toastr_message_error', event => {
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
            }
            toastr.error(event.detail.message, 'Thất bại');
        });
    });
</script>
@endpush
