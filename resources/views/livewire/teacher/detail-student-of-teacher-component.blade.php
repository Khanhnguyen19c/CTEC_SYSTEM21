<div>



    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class=" fw-bold flex-fill mb-0">{{$student->HODEM}} {{$student->TEN}}</h3>
                            <div class="col-auto d-flex w-sm-100">

                            </div>


                        </div>

                    </div>
                </div><!-- Row End -->
                <div class="row g-3">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="card teacher-card  mb-3">
                            <div class="card-body  d-flex teacher-fulldeatil">
                                <div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto">
                                    <a href="#">
                                        <img style="max-width:100%" src="{{asset('assets/images/Hoso')}}/{{$student->HINHHOSO}}" alt="{{$student->TEN }}" class="img-fluid">
                                    </a>
                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                        <h6 class="mb-0 fw-bold d-block fs-6">{{$student->MASV}}</h6>
                                        <span class="text-muted small">Tên ngành: {{$student->nganh->TENNGANH}}</span>
                                    </div>
                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6">{{$student->HODEM}} {{$student->TEN}}</h6>
                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">STK: {{$student->SOTKNGANHANG}}</span>
                                    <p class="mt-2 small">Lớp chuyên ngành: {{$student->lopchuyennganh->MALOPCHUYENNGANH}}</p>
                                    <p class="mt-2 small">Bậc đào tạo: {{$student->bacdaotao->TENDAYDU}} - Hệ đào tạo: {{$student->hedaotao->TENDAYDU}}</p>

                                    <div class="row g-2 pt-2">
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-ui-touch-phone"></i>
                                                <span class="ms-2 small">{{$student->SODIENTHOAI}} </span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-email"></i>
                                                <span class="ms-2 small">{{$student->EMAIL}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-birthday-cake"></i>
                                                <span class="ms-2 small">{{$student->NGAYSINH}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">{{$student->DIACHILIENLAC}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">CMND: {{$student->CMND}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">Ngày cấp: {{$student->NGAYCAP}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">Nơi cấp: {{$student->NOICAP}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">Dân tộc: {{$student->DANTOC}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">Tôn giáo: {{$student->TONGIAO}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">Nơi sinh: {{$student->NOISINH}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Thông tin gia đình</h6>

                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Họ tên cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->HOTENCHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Số điện thoại cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->SODIENTHOAICHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Năm sinh cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->NAMSINHCHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Nghề nghiệp cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->NGHECHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Dân tộc cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->DANTOCCHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Tôn giáo cha</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->TONGIAOCHA}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Địa chỉ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->DIACHICHAME}}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Thông tin gia đình</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Họ tên mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->HOTENME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Số điện thoại mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->SODIENTHOAIME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Năm sinh mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->NAMSINHME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Nghề nghiệp mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->NGHEME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Dân tộc mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->DANTOCME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Tôn giáo mẹ</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->TONGIAOME}}</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6">
                                                    <span class="fw-bold">Hộ khẩu</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">{{$student->HOKHAU}}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Thông tin khác</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline-item ti-danger ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">NH</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Ngày nhập học</strong></div>
                                            <span class="d-flex text-muted">{{$student->NGAYVAOTRUONG}}</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-info ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">NH</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Năm nhập học</strong></div>
                                            <span class="d-flex text-muted">{{$student->NAMNHAPHOC}}</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-success ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">DV</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Ngày kết nạp đoàn</strong></div>
                                            <span class="d-flex text-muted">{{$student->NGAYKETNAPDOAN}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-danger ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">DV</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Nơi kết nạp đoàn</strong></div>
                                            <span class="d-flex text-muted">{{$student->NOIKETNAPDOAN}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-info ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">DV</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Ngày kết nạp đảng</strong></div>
                                            <span class="d-flex text-muted">{{$student->NGAYKETNAPDANG}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-danger ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">DV</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Nơi kết nạp đảng</strong></div>
                                            <span class="d-flex text-muted">{{$student->NOIKETNAPDANG}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-success  ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">CT</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Quá trình công tác</strong></div>
                                            <span class="d-flex text-muted">{{$student->QUATRINHCONGTAC}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-info ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">TH</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Bằng tin học</strong></div>
                                            <span class="d-flex text-muted">{{$student->CCATINHOC}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-success ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">AV</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Bằng anh văn</strong></div>
                                            <span class="d-flex text-muted">{{$student->CCAANHVAN}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- timeline item end  -->
                            </div>
                        </div>
                    </div>

                </div><!-- Row End -->
            </div>
        </div>

    </div>
