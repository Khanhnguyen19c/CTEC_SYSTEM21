<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Sinh Viên</h3>
                        <div class="col-auto py-2 w-sm-100">
                        <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{route('student_add')}}" class="nav-link"><button type="button" class="btn btn-dark btn-set-task w-sm-100 mr-2"><i class="icofont-plus-circle me-2 fs-6"></i>Thêm Mới</button>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{route('import_student')}}" method="POST" enctype="multipart/form-data" style="text-align: center;">
                                            @csrf
                                        <input class="form-control mt-2 nav-link" type="file" id="formFileMultiple" name="file" accept=".xlsx" required />
                                        <input type="submit" value="Nhập File Excel" name="import_csv" class="btn btn-warning mt-3 text-center">
                                        </form>
                                    </li>
                                    <li class="nav-item " style="margin-right: 5px;">
                                    <button type="button" class="btn btn-dark btn-set-task w-sm-100 mt-2 " wire:click.prevent="export_student()">Xuất Danh Sách Sinh Viên</button>
                                </li>

                                <li>
                                    <a class="btn btn-success mt-2" download="" href="{{asset('assets/pdf/Mau_nhapthongtin_sinhvien.xlsx')}}">DowLoad Mẫu Excel</a>
                                </li>
                        </ul>


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
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" wire:ignore>
                            <table id="myProjectTable"  class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Số hồ sơ</th>
                                        <th>Mã số</th>
                                        <th>Họ tên</th>
                                        <th>Khoa</th>
                                        <th>Lớp chuyên ngành</th>
                                        <th>Phái</th>
                                        <th>Ngày Sinh</th>
                                        <th>Số Phone</th>
                                        <th>Email</th>
                                        <th>CMND</th>
                                        <th>Cảnh báo Học vụ</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($students as $student)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$student->SOHOSO}}</td>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$student->MASV}}</a>
                                        </td>
                                        <td>
                                            @if ($student->HINHDAIDIEN)
                                            <img class="avatar rounded-circle" src="{{asset('assets/images/students')}}/{{$student->HINHDAIDIEN}}" alt="">
                                            @else
                                            <img class="avatar rounded-circle" src="{{asset('assets/images/profile_av.png')}}" alt="">
                                            @endif

                                            <span class="fw-bold ms-1">{{$student->HODEM}} {{$student->TEN}}</span>
                                        </td>
                                        <td>{{$student->nganh->TENNGANH}}</td>
                                        <td>{{$student->lopchuyennganh->MALOPCHUYENNGANH}}</td>
                                        <td> {{ $student->PHAI }}</td>
                                        <td>{{$student->NGAYSINH}}</td>
                                        <td>{{$student->SODIENTHOAI}}</td>
                                        <td>{{$student->EMAIL}}</td>
                                        <td>{{$student->CMND}}</td>
                                        <td>
                                        @if ( $student->CANHBAOHV == 1)
                                        <span class="badge bg-warning">Cảnh Báo</span>
                                        @else
                                        <span class="badge bg-success">Bình Thường</span>
                                        @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{route('student_details',['ID_SINHVIEN'=>$student->ID_SINHVIEN]) }}" class="btn btn-outline-secondary deleterow"><i class="icofont-eye-alt"></i></a>
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
@push('scripts')
<script>
    $(document).ready(function() {
        window.addEventListener('student_message', event => {
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
            }
            toastr.success(event.detail.message, 'Success');
        })
    });
</script>
@endpush
