<div>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Quản lý điểm học phần</h3>
                        <div class="col-auto py-2 w-sm-100">
                        <ul class="nav nav-tabs tab-body-header rounded invoice-set" role="tablist">
                                    <li class="nav-item">
                                    <a href="{{route('coursescore_add')}}" > <button type="button" class="btn btn-dark btn-set-task w-sm-100" style="margin-top:10px;margin-right:2px;"><i class="icofont-plus-circle me-2 fs-6 " ></i>Thêm Mới</button></a>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{route('import_score')}}" method="POST" enctype="multipart/form-data" style="text-align: center;">
                                            @csrf
                                        <input class="form-control mt-2 nav-link" type="file" id="formFileMultiple" name="file" accept=".xlsx" required />
                                        <input type="submit" value="Nhập File Điểm" name="import_csv" class="btn btn-warning mt-3 text-center" style="color:black">
                                        </form>
                                    </li>
                                <li>
                                    <a class="btn btn-primary mt-2" download="" href="{{asset('assets/pdf/Mau_nhap_diem.xlsx')}}">DowLoad Mẫu Nhập Điểm Excel</a>
                                </li>
                        </ul>


                        </div>
                        <div class="col-auto d-flex w-sm-100">


                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <select class="form-control mt-2" wire:model="ID_LOPHOCPHAN">
                        <option value="">--Chọn Lớp Học Phần</option>
                        @foreach ($title_class as $title)
                        <option value="{{$title->ID_LOPHOCPHAN}}">{{$title->MALOPHOCPHAN}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary mt-2" href="" wire:click.prevent="exportCourseScore()">Xuất File Điểm</a>
                    </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body" >
                            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã lớp học phần</th>
                                        <th>Mã sinh viên</th>
                                        <th>Mã học phần</th>
                                        <th>Hệ số 1</th>
                                        <th>Hê số 1 (cột 2)</th>
                                        <th>Hệ số 1 (Cột 3)</th>
                                        <th>Hệ số 2</th>
                                        <th>Hệ số 2 (Cột 2)</th>
                                        <th>Hệ số 2 (Cột 3)</th>
                                        <th>TBM</th>
                                        <th>Thi lân 1</th>
                                        <th>Thi lần 2</th>
                                        <th>TBHP(10): </th>
                                        <th>TBHP(4): </th>
                                        <th>Số tiết vắng (LT): </th>
                                        <th>Số tiết vắng (TH): </th>
                                        <th>Cấm thi</th>
                                        <th>Đạt</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($course_score as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="#" class="fw-bold text-secondary">{{$i}}</a>
                                        </td>
                                        <td>

                                            <span class="fw-bold ms-1">{{$item->lophocphan->MALOPHOCPHAN}}</span>
                                        </td>
                                        <td>
                                            @if($item->CAMTHI == 1)
                                            <span class="badge bg-warning">{{$item->sinhvien->MASV}}</span>
                                            @else
                                            <span class="badge bg-success">{{$item->sinhvien->MASV}}</span>
                                            @endif
                                        </td>
                                        <td>{{$item->hocphan->MAHOCPHAN}}</td>
                                        <td>{{$item->HS11}}</td>
                                        <td>{{$item->HS12}}</td>
                                        <td>{{$item->HS13}}</td>
                                        <td>{{$item->HS21}}</td>
                                        <td>{{$item->HS22}}</td>
                                        <td>{{$item->HS23}}</td>
                                        <td>{{$item->TBM}}</td>
                                        <td>{{$item->THILAN1}}</td>
                                        <td>{{$item->THILAN2}}</td>
                                        <td>{{$item->TRUNGBINH10}}</td>
                                        <td>{{$item->TRUNGBINH4}}</td>

                                        <td>{{$item->SOTIETVANGLYTHUYET}}</td>
                                        <td>{{$item->SOTIETVANGTHUCHANH}}</td>
                                        <td>
                                            @if($item->CAMTHI == 1)
                                            <span class="badge bg-warning"><i class="icofont-ui-close"></i></span>
                                            @else
                                            <span class="badge bg-success"><i class="icofont-check-circled"></i></span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->DAT == 1)
                                            <span class="badge bg-success"><i class="icofont-check-circled"></i></span>
                                            @else
                                            <span class="badge bg-warning"><i class="icofont-ui-close"></i></span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('coursescore_edit',['ID_SINHVIEN'=>$item->ID_SINHVIEN,'ID_LOPHOCPHAN'=>$item->ID_LOPHOCPHAN]) }}"><button type="button" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></button></button></a>
                                                <a href="{{route('coursescore_delete',['id'=>$item->ID_KETQUAHOCPHAN]) }}" class="btn btn-outline-secondary deleterow" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()"><i class="icofont-ui-delete text-danger"></i></a>
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

