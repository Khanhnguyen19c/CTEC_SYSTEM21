<div>
    <style>
        .icon {
            font-size: 80px;
        }

        .icon-f {
            color: #fd397a !important;
        }

        .icon-s {
            color: #ffb822 !important;
        }

        .icon-t {
            color: #0abb87 !important;
        }

        .icon-fo {
            color: #18e3e6 !important;
        }

        .text-title {
            font-size: 35px;
        }

        .middle {
            vertical-align: middle;
        }
        .mr-10{
            margin-right: 10px;
        }
        .mt-5{
            margin-top: 5px;
            padding: 15px;
            color: white;
            font-weight: bold;
        }
    </style>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Kết Quả Học Tập: {{auth()->user()->name }} - {{ auth()->user()->sinhvien->lopchuyennganh->MALOPCHUYENNGANH }} </h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-info btn-set-task w-sm-100 mr-10 mt-5" wire:click.prevent="export_HK()">Xuất Bảng Điểm Theo Học Kỳ</button>
                            <button type="button" class="btn btn-success btn-set-task w-sm-100 mr-10 mt-5" wire:click.prevent="export_CTDT()">Xuất Bảng Điểm Theo Chường Trình Đào Tạo</button>
                            <button type="button" class="btn btn-warning btn-set-task w-sm-100 mr-10 mt-5" wire:click.prevent="export_DSHP()">Xuất Bảng Điểm Theo DSHP Đã Học</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4">
                <div class="col">
                    <div class="card bg-primary">
                        <div class="card-body text-white d-flex align-items-center">
                            <i class="icofont-check-circled icon icon-f"></i>
                            <div class="d-flex flex-column ms-3">
                                <h6 class="mb-0 text-title">{{round($points_TN->tichluythang10,2)}}</h6>
                                <span class="text-white">Điểm TB hệ 10</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary">
                        <div class="card-body text-white d-flex align-items-center">
                            <i class="icofont-verification-check icon icon-s"></i>
                            <div class="d-flex flex-column ms-3">
                                <h6 class="mb-0 text-title">{{round($points_TN->tichluythang4,2)}}</h6>
                                <span class="text-white">Điểm TB hệ 4</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary">
                        <div class="card-body text-white d-flex align-items-center">
                            <i class="icofont-trophy icon icon-t"></i>
                            <div class="d-flex flex-column ms-3">
                                <h6 class="mb-0 text-title">{{ $XL_TL_HK1_NK3 }}</h6>
                                <span class="text-white">Xếp loại</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-primary">
                        <div class="card-body text-white d-flex align-items-center">
                            <i class="icofont-user-suited icon icon-fo"></i>
                            <div class="d-flex flex-column ms-3">
                                <h6 class="mb-0 text-title">{{$sv}}</h6>
                                <span class="text-white">SV năm thứ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!!$points_HK1_NK1)

            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">KẾT QUẢ HỌC TẬP HỌC KỲ 1 NĂM HỌC {{ $nienkhoa1 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="text-center middle"><strong>STT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Mã HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Tên HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Số<br>ĐVHT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>GVGD</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTTX</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTĐK</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Vắng</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBM</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Thi</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBHP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Ghi<BR>chú</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>LT</strong></td>
                                        <td class="text-center"><strong>TH</strong></td>
                                        <td class="text-center"><strong>Lần 1</strong></td>
                                        <td class="text-center"><strong>Lần 2</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($points_HK1_NK1 as $scoreboard)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="text-center ">{{$i}}</td>
                                        <td class="text-center ">{{$scoreboard->MAHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->TENHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->SOCHI}}</td>
                                        <td class="text-center ">{{$scoreboard->MAGV}}</td>
                                        <td class="text-center ">{{$scoreboard->HS11}}</td>
                                        <td class="text-center ">{{$scoreboard->HS12}}</td>
                                        <td class="text-center ">{{$scoreboard->HS13}}</td>
                                        <td class="text-center ">{{$scoreboard->HS21}}</td>
                                        <td class="text-center ">{{$scoreboard->HS22}}</td>
                                        <td class="text-center ">{{$scoreboard->HS23}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGLYTHUYET}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGTHUCHANH}}</td>
                                        <td class="text-center "><strong>{{$scoreboard->TBM}}</strong></td>
                                        <td class="text-center ">{{$scoreboard->THILAN1}}</td>
                                        <td class="text-center ">{{$scoreboard->THILAN2}}</td>
                                        <td class="text-center ">
                                            <strong><span id="tb10-178579">{{$scoreboard->TRUNGBINH10}}<br>{{number_format($scoreboard->TRUNGBINH4,1,'.','')}}<br>
                                                    @if ($scoreboard->TRUNGBINH10 >= 9.1)
                                                    A
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 8.5)
                                                    A-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.8)
                                                    B+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.0)
                                                    B
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.5)
                                                    C+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.0)
                                                    C
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.5)
                                                    C-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.0)
                                                    D+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.5)
                                                    D
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.0)
                                                    D-
                                                    @else
                                                    F
                                                    @endif
                                                </span></strong>
                                        </td>
                                        <td class="text-center ">
                                            <strong>
                                                @if ($scoreboard->DAT == 1)
                                                @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc' OR $scoreboard->LOAIHOCPHAN == 'Tự chọn')
                                                <span class="badge bg-success" style="font-size:16px"><i class="icofont-check-circled"></i></span>
                                                @else ($scoreboard->hocphan->LOAIHOCPHAN == 'Điều Kiện')
                                                Đạt
                                                @endif
                                                @else
                                                <span class="badge bg-warning" style="font-size:16px"><i class="icofont-ui-close"></i></span>
                                                @endif
                                            </strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       <table style="margin-bottom: 25px;">
                            <tbody>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp hạng năm đào tạo: </td>
                                    <td><strong>1</strong></td>
                                    <td width="30px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Số TC tích lũy: </td>
                                    <td><strong>{{$TC_TL_HK1_NK1}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC học kỳ: </td>
                                    <td><strong>{{$TBM_HK1_NK1->TINCHI}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC NK: </td>
                                    <td><strong> {{$TC_NK1->TINCHI}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy:</td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK1_NK1,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB học kỳ :</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK1->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa:</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK1->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy: </td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK1_NK1_T4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB tích luỹ: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK1->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK1->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực tích lũy: </td>
                                    <td><strong>
                                            {{ $XL_HK1_NK1 }}
                                        </strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực học kỳ: </td>
                                    <td><strong>{{$XL_HK1_NK1}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{$XL_NK1}}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- Row End -->
            @endif
            @if (!!$points_HK2_NK1)

            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">KẾT QUẢ HỌC TẬP HỌC KỲ 2 NĂM HỌC {{ $nienkhoa1 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="text-center middle"><strong>STT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Mã HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Tên HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Số<br>ĐVHT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>GVGD</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTTX</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTĐK</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Vắng</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBM</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Thi</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBHP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Ghi<BR>chú</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>LT</strong></td>
                                        <td class="text-center"><strong>TH</strong></td>
                                        <td class="text-center"><strong>Lần 1</strong></td>
                                        <td class="text-center"><strong>Lần 2</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($points_HK2_NK1 as $scoreboard)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="text-center ">{{$i}}</td>
                                        <td class="text-center ">{{$scoreboard->MAHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->TENHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->SOCHI}}</td>
                                        <td class="text-center ">{{$scoreboard->MAGV}}</td>
                                        <td class="text-center ">{{$scoreboard->HS11}}</td>
                                        <td class="text-center ">{{$scoreboard->HS12}}</td>
                                        <td class="text-center ">{{$scoreboard->HS13}}</td>
                                        <td class="text-center ">{{$scoreboard->HS21}}</td>
                                        <td class="text-center ">{{$scoreboard->HS22}}</td>
                                        <td class="text-center ">{{$scoreboard->HS23}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGLYTHUYET}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGTHUCHANH}}</td>
                                        <td class="text-center "><strong>{{$scoreboard->TBM}}</strong></td>
                                        <td class="text-center ">{{$scoreboard->THILAN1}}</td>
                                        <td class="text-center ">{{$scoreboard->THILAN2}}</td>
                                        <td class="text-center ">
                                            <strong><span id="tb10-178579">{{$scoreboard->TRUNGBINH10}}<br>{{number_format($scoreboard->TRUNGBINH4,1,'.','')}}<br>
                                                    @if ($scoreboard->TRUNGBINH10 >= 9.1)
                                                    A
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 8.5)
                                                    A-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.8)
                                                    B+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.0)
                                                    B
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.5)
                                                    C+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.0)
                                                    C
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.5)
                                                    C-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.0)
                                                    D+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.5)
                                                    D
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.0)
                                                    D-
                                                    @else
                                                    F
                                                    @endif
                                                </span></strong>
                                        </td>
                                        <td class="text-center ">
                                            <strong>
                                                @if ($scoreboard->DAT == 1)
                                                @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc' OR $scoreboard->LOAIHOCPHAN == 'Tự chọn')
                                                <span class="badge bg-success" style="font-size:16px"><i class="icofont-check-circled"></i></span>
                                                @else ($scoreboard->hocphan->LOAIHOCPHAN == 'Điều Kiện')
                                                Đạt
                                                @endif
                                                @else
                                                <span class="badge bg-warning" style="font-size:16px"><i class="icofont-ui-close"></i></span>
                                                @endif
                                            </strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table style="margin-bottom: 25px;">
                            <tbody>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp hạng năm đào tạo: </td>
                                    <td><strong>1</strong></td>
                                    <td width="30px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Số TC tích lũy: </td>
                                    <td><strong>{{$TC_TL_HK2_NK1}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC học kỳ: </td>
                                    <td><strong>{{$TBM_HK2_NK1->TINCHI }} </strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC NK: </td>
                                    <td><strong> {{$TC_NK1->TINCHI}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy:</td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK2_NK1,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB học kỳ :</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK2_NK1->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa:</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK1->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy: </td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK2_NK1_T4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB tích luỹ: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK2_NK1->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK1->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực tích lũy: </td>
                                    <td><strong>
                                            {{ $XL_TL_HK2_NK1 }}
                                        </strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực học kỳ: </td>
                                    <td><strong>{{$XL_HK1_NK1}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{$XL_NK1}}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div><!-- Row End -->
            @endif
            @if (!!$points_HK1_NK2)

            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">KẾT QUẢ HỌC TẬP HỌC KỲ 1 NĂM HỌC {{ $nienkhoa2 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="text-center middle"><strong>STT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Mã HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Tên HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Số<br>ĐVHT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>GVGD</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTTX</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTĐK</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Vắng</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBM</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Thi</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBHP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Ghi<BR>chú</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>LT</strong></td>
                                        <td class="text-center"><strong>TH</strong></td>
                                        <td class="text-center"><strong>Lần 1</strong></td>
                                        <td class="text-center"><strong>Lần 2</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($points_HK1_NK2 as $scoreboard)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="text-center ">{{$i}}</td>
                                        <td class="text-center ">{{$scoreboard->MAHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->TENHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->SOCHI}}</td>
                                        <td class="text-center ">{{$scoreboard->MAGV}}</td>
                                        <td class="text-center ">{{$scoreboard->HS11}}</td>
                                        <td class="text-center ">{{$scoreboard->HS12}}</td>
                                        <td class="text-center ">{{$scoreboard->HS13}}</td>
                                        <td class="text-center ">{{$scoreboard->HS21}}</td>
                                        <td class="text-center ">{{$scoreboard->HS22}}</td>
                                        <td class="text-center ">{{$scoreboard->HS23}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGLYTHUYET}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGTHUCHANH}}</td>
                                        <td class="text-center "><strong>{{$scoreboard->TBM}}</strong></td>
                                        <td class="text-center ">{{$scoreboard->THILAN1}}</td>
                                        <td class="text-center ">{{$scoreboard->THILAN2}}</td>
                                        <td class="text-center ">
                                            <strong><span id="tb10-178579">{{$scoreboard->TRUNGBINH10}}<br>{{number_format($scoreboard->TRUNGBINH4,1,'.','')}}<br>
                                                    @if ($scoreboard->TRUNGBINH10 >= 9.1)
                                                    A
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 8.5)
                                                    A-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.8)
                                                    B+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.0)
                                                    B
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.5)
                                                    C+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.0)
                                                    C
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.5)
                                                    C-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.0)
                                                    D+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.5)
                                                    D
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.0)
                                                    D-
                                                    @else
                                                    F
                                                    @endif
                                                </span></strong>
                                        </td>
                                        <td class="text-center ">
                                            <strong>
                                                @if ($scoreboard->DAT == 1)
                                                @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc' OR $scoreboard->LOAIHOCPHAN == 'Tự chọn')
                                                <span class="badge bg-success" style="font-size:16px"><i class="icofont-check-circled"></i></span>
                                                @else ($scoreboard->hocphan->LOAIHOCPHAN == 'Điều Kiện')
                                                Đạt
                                                @endif
                                                @else
                                                <span class="badge bg-warning" style="font-size:16px"><i class="icofont-ui-close"></i></span>
                                                @endif
                                            </strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table style="margin-bottom: 25px;">
                            <tbody>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp hạng năm đào tạo: </td>
                                    <td><strong>2</strong></td>
                                    <td width="30px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Số TC tích lũy: </td>
                                    <td><strong>{{$TC_TL_HK1_NK2}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC học kỳ: </td>
                                    <td><strong>{{$TBM_HK1_NK2->TINCHI}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC NK: </td>
                                    <td><strong> {{$TC_NK2->TINCHI}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy:</td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK1_NK2,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB học kỳ :</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK2->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa:</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK2->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy: </td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK1_NK2_T4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB tích luỹ: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK2->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK2->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực tích lũy: </td>
                                    <td><strong>
                                            {{ $XL_TL_HK1_NK2}}
                                        </strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực học kỳ: </td>
                                    <td><strong>{{$XL_HK1_NK2}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{$XL_NK2}}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- Row End -->
            @endif

            @if (!!$points_HK2_NK2)

            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">KẾT QUẢ HỌC TẬP HỌC KỲ 2 NĂM HỌC {{ $nienkhoa2 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="text-center middle"><strong>STT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Mã HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Tên HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Số<br>ĐVHT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>GVGD</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTTX</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTĐK</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Vắng</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBM</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Thi</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBHP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Ghi<BR>chú</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>LT</strong></td>
                                        <td class="text-center"><strong>TH</strong></td>
                                        <td class="text-center"><strong>Lần 1</strong></td>
                                        <td class="text-center"><strong>Lần 2</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($points_HK2_NK2 as $scoreboard)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="text-center ">{{$i}}</td>
                                        <td class="text-center ">{{$scoreboard->MAHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->TENHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->SOCHI}}</td>
                                        <td class="text-center ">{{$scoreboard->MAGV}}</td>
                                        <td class="text-center ">{{$scoreboard->HS11}}</td>
                                        <td class="text-center ">{{$scoreboard->HS12}}</td>
                                        <td class="text-center ">{{$scoreboard->HS13}}</td>
                                        <td class="text-center ">{{$scoreboard->HS21}}</td>
                                        <td class="text-center ">{{$scoreboard->HS22}}</td>
                                        <td class="text-center ">{{$scoreboard->HS23}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGLYTHUYET}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGTHUCHANH}}</td>
                                        <td class="text-center "><strong>{{$scoreboard->TBM}}</strong></td>
                                        <td class="text-center ">{{$scoreboard->THILAN1}}</td>
                                        <td class="text-center ">{{$scoreboard->THILAN2}}</td>
                                        <td class="text-center ">
                                            <strong><span id="tb10-178579">{{$scoreboard->TRUNGBINH10}}<br>{{number_format($scoreboard->TRUNGBINH4,1,'.','')}}<br>
                                                    @if ($scoreboard->TRUNGBINH10 >= 9.1)
                                                    A
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 8.5)
                                                    A-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.8)
                                                    B+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.0)
                                                    B
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.5)
                                                    C+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.0)
                                                    C
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.5)
                                                    C-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.0)
                                                    D+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.5)
                                                    D
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.0)
                                                    D-
                                                    @else
                                                    F
                                                    @endif
                                                </span></strong>
                                        </td>
                                        <td class="text-center ">
                                            <strong>
                                                @if ($scoreboard->DAT == 1)
                                                @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc' OR $scoreboard->LOAIHOCPHAN == 'Tự chọn')
                                                <span class="badge bg-success" style="font-size:16px"><i class="icofont-check-circled"></i></span>
                                                @else ($scoreboard->hocphan->LOAIHOCPHAN == 'Điều Kiện')
                                                Đạt
                                                @endif
                                                @else
                                                <span class="badge bg-warning" style="font-size:16px"><i class="icofont-ui-close"></i></span>
                                                @endif
                                            </strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table style="margin-bottom: 25px;">
                            <tbody>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp hạng năm đào tạo: </td>
                                    <td><strong>2</strong></td>
                                    <td width="30px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Số TC tích lũy: </td>
                                    <td><strong>{{$TC_TL_HK2_NK2}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC học kỳ: </td>
                                    <td><strong>{{$TBM_HK2_NK2->TINCHI}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC NK: </td>
                                    <td><strong> {{$TC_NK2->TINCHI}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy:</td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK2_NK2,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB học kỳ :</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK2_NK2->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa:</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK2->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy: </td>
                                    <td>
                                        <strong>
                                            {{round($TBTL_HK2_NK2_T4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB tích luỹ: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK2_NK2->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK2->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực tích lũy: </td>
                                    <td><strong>
                                            {{ $XL_TL_HK2_NK2 }}
                                        </strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực học kỳ: </td>
                                    <td><strong>{{$XL_HK2_NK2}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{$XL_NK2}}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- Row End -->
            @endif
            @if ($points_HK1_NK3)
            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">KẾT QUẢ HỌC TẬP HỌC KỲ 1 NĂM HỌC {{ $nienkhoa3}}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr>
                                        <td rowspan="2" class="text-center middle"><strong>STT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Mã HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Tên HP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Số<br>ĐVHT</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>GVGD</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTTX</strong></td>
                                        <td colspan="3" class="text-center middle"><strong>Điểm KTĐK</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Vắng</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBM</strong></td>
                                        <td colspan="2" class="text-center middle"><strong>Thi</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>TBHP</strong></td>
                                        <td rowspan="2" class="text-center middle"><strong>Ghi<BR>chú</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>(1)</strong></td>
                                        <td class="text-center"><strong>(2)</strong></td>
                                        <td class="text-center"><strong>(3)</strong></td>
                                        <td class="text-center"><strong>LT</strong></td>
                                        <td class="text-center"><strong>TH</strong></td>
                                        <td class="text-center"><strong>Lần 1</strong></td>
                                        <td class="text-center"><strong>Lần 2</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($points_HK1_NK3 as $scoreboard)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="text-center ">{{$i}}</td>
                                        <td class="text-center ">{{$scoreboard->MAHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->TENHOCPHAN}}</td>
                                        <td class="text-center ">{{$scoreboard->SOCHI}}</td>
                                        <td class="text-center ">{{$scoreboard->MAGV}}</td>
                                        <td class="text-center ">{{$scoreboard->HS11}}</td>
                                        <td class="text-center ">{{$scoreboard->HS12}}</td>
                                        <td class="text-center ">{{$scoreboard->HS13}}</td>
                                        <td class="text-center ">{{$scoreboard->HS21}}</td>
                                        <td class="text-center ">{{$scoreboard->HS22}}</td>
                                        <td class="text-center ">{{$scoreboard->HS23}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGLYTHUYET}}</td>
                                        <td class="text-center ">{{$scoreboard->SOTIETVANGTHUCHANH}}</td>
                                        <td class="text-center "><strong>{{$scoreboard->TBM}}</strong></td>
                                        <td class="text-center ">{{$scoreboard->THILAN1}}</td>
                                        <td class="text-center ">{{$scoreboard->THILAN2}}</td>
                                        <td class="text-center ">
                                            <strong><span id="tb10-178579">{{$scoreboard->TRUNGBINH10}}<br>{{number_format($scoreboard->TRUNGBINH4,1,'.','')}}<br>
                                                    @if ($scoreboard->TRUNGBINH10 >= 9.1)
                                                    A
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 8.5)
                                                    A-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.8)
                                                    B+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 7.0)
                                                    B
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.5)
                                                    C+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 6.0)
                                                    C
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.5)
                                                    C-
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 5.0)
                                                    D+
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.5)
                                                    D
                                                    @elseif ($scoreboard->TRUNGBINH10 >= 4.0)
                                                    D-
                                                    @else
                                                    F
                                                    @endif
                                                </span></strong>
                                        </td>
                                        <td class="text-center ">
                                            <strong>
                                                @if ($scoreboard->DAT == 1)
                                                @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc' OR $scoreboard->LOAIHOCPHAN == 'Tự chọn')
                                                <span class="badge bg-success" style="font-size:16px"><i class="icofont-check-circled"></i></span>
                                                @else ($scoreboard->hocphan->LOAIHOCPHAN == 'Điều Kiện')
                                                Đạt
                                                @endif
                                                @else
                                                <span class="badge bg-warning" style="font-size:16px"><i class="icofont-ui-close"></i></span>
                                                @endif
                                            </strong>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <table style="margin-bottom: 25px;">
                            <tbody>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp hạng năm đào tạo: </td>
                                    <td><strong>3</strong></td>
                                    <td width="30px"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Số TC tích lũy: </td>
                                    <td><strong>{{$points_TN->TINCHI}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC học kỳ: </td>
                                    <td><strong>{{$TBM_HK1_NK3->TINCHI}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Tổng số TC NK: </td>
                                    <td><strong> {{$TC_NK3->TINCHI}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy:</td>
                                    <td>
                                        <strong>
                                            {{round($points_TN->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB học kỳ :</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK3->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa:</td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK3->tichluythang10,2)}}
                                        </strong> ( thang điểm 10)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>TB tích lũy: </td>
                                    <td>
                                        <strong>
                                            {{round($points_TN->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB tích luỹ: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_HK1_NK3->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                    <td width="30px"></td>
                                    <td>TB Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{round($TBM_NK3->tichluythang4,2)}}
                                        </strong> ( thang điểm 4)
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực tích lũy: </td>
                                    <td><strong>
                                            {{ $XL_TL_HK1_NK3 }}
                                        </strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực học kỳ: </td>
                                    <td><strong>{{$XL_HK1_NK3}}</strong></td>
                                    <td width="30px"></td>
                                    <td>Xếp loại học lực Niên khóa: </td>
                                    <td>
                                        <strong>
                                            {{$XL_NK3}}
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- Row End -->
            @endif
        </div>
    </div>
</div>
