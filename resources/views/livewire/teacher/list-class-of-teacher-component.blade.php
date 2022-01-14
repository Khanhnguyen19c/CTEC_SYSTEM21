<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Danh Sách Sinh Viên Lớp @foreach ($title_class as $title)
                            {{$title->MALOPCHUYENNGANH}}
                            @if (!$loop->last)-
                            @endif
                            @endforeach
                        </h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" wire:click.prevent="export_DS()">Xuất Danh Sách Sinh Viên</button>
                        </div>

                    </div>
                    <div class="col-md-6">
                    <select class="form-control mt-2" wire:model="MALOPCHUYENNGANH">
                        <option value="">--Chọn Lớp</option>
                        @foreach ($title_class as $title)
                        <option value="{{$title->MALOPCHUYENNGANH}}">{{$title->MALOPCHUYENNGANH}}</option>
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
                            <table class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã số</th>
                                        <th>Họ tên</th>
                                        <th>Khoa</th>
                                        <th>Lớp chuyên ngành</th>
                                        <th>Phái</th>
                                        <th>Ngày Sinh</th>
                                        <th>Số Phone</th>
                                        <th>Số hồ sơ</th>
                                        <th>Cảnh báo Học vụ</th>
                                        <!-- <th>Điểm</th> -->
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

                                        <td>
                                            {{$student->SOHOSO}}</a>
                                        </td>
                                        <td>
                                            @if ( $student->CANHBAOHV == 1)
                                            <span class="badge bg-warning">Cảnh Báo</span>
                                            @else
                                            <span class="badge bg-success">Bình Thường</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('scoreOfteacher',['ID_SINHVIEN'=>$student->ID_SINHVIEN] )}}">
                                                <button type="button" class="btn btn-outline-secondary">
                                                    <i class="icofont-look"></i>
                                                </button>
                                            </a>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{route('student_detailsOfteacher',['ID_SINHVIEN'=>$student->ID_SINHVIEN]) }}" class="btn btn-outline-secondary deleterow"><i class="icofont-eye-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $students->links('livewire.livewire-pagination-link') }}
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
