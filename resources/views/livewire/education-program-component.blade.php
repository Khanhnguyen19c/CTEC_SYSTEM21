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

        .mr-10 {
            margin-right: 10px;
        }

        .mt-5 {
            margin-top: 5px;
            padding: 15px;

            font-weight: bold;
        }

    </style>
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-2">Kết Quả Tích Luỹ: {{auth()->user()->name }} </h3>
                        <h4 class="fw-bold mb-0">Lớp Chuyên Ngành {{ auth()->user()->sinhvien->lopchuyennganh->MALOPCHUYENNGANH }}</h4>
                        <div class="col-auto d-flex w-sm-100">
                            <div class="alert alert-primary mr-10 mt-5" role="alert">Số Tín chỉ tích lũy đã đạt: {{$points_TN->TINCHI}}</div>
                            <div class="alert alert-success  mr-10 mt-5" role="alert">Số Tín chỉ tốt nghiệp phải đạt: 68</div>
                            <div class="alert alert-primary mr-10 mt-5" role="alert">TB tích lũy đã đạt: {{ round($points_TN->tichluythang4,2) }} (theo thang điểm 4)</div>
                            <div class="alert alert-success  mr-10 mt-5" role="alert">TB xét tốt nghiệp phải đạt: 2.00</div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->


            @if (!!$points_HK1_NK1)

            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">HỌC KỲ 1 NĂM HỌC {{ $nienkhoa1 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr class="success" style="font-weight:bold; color:#697264; vertical-align: middle">
                                        <td rowspan="2" class="text-center middle">STT</td>
                                        <td rowspan="2" class="text-center middle">Mã HP</td>
                                        <td rowspan="2" class="text-center middle">Tên HP</td>
                                        <td rowspan="2" class="text-center middle">Số
                                            TC
                                        </td>
                                        <td colspan="3" class="text-center middle">
                                            Số Tín chỉ
                                        </td>
                                        <td rowspan="2" class="text-center middle">TB4 HP</td>
                                        <td rowspan="2" class="text-center middle">Kết quả</td>
                                    </tr>
                                    <tr class="success" style="font-weight:bold; text-align:center; color:#697264; vertical-align: middle">
                                        <td class="text-center middle">Bắt buộc</td>
                                        <td class="text-center middle">Điều kiện</td>
                                        <td class="text-center middle">Tự chọn</td>
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

                                        <td class="text-center ">
                                            <strong>
                                            @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-center ">
                                            @if ($scoreboard->LOAIHOCPHAN == 'Điều Kiện')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center ">
                                            @if ($scoreboard->LOAIHOCPHAN == 'Tự Chọn')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center ">
                                            {{number_format($scoreboard->TRUNGBINH4,1,'.','')}}
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
                                <h6 class="mb-0 fw-bold ">HỌC KỲ 2 NĂM HỌC {{ $nienkhoa1 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr class="success" style="font-weight:bold; color:#697264; vertical-align: middle">
                                        <td rowspan="2" class="text-center middle">STT</td>
                                        <td rowspan="2" class="text-center middle">Mã HP</td>
                                        <td rowspan="2" class="text-center middle">Tên HP</td>
                                        <td rowspan="2" class="text-center middle">Số
                                            TC
                                        </td>
                                        <td colspan="3" class="text-center middle">
                                            Số Tín chỉ
                                        </td>
                                        <td rowspan="2" class="text-center middle">TB4 HP</td>
                                        <td rowspan="2" class="text-center middle">Kết quả</td>
                                    </tr>
                                    <tr class="success" style="font-weight:bold; text-align:center; color:#697264; vertical-align: middle">
                                        <td class="text-center middle">Bắt buộc</td>
                                        <td class="text-center middle">Điều kiện</td>
                                        <td class="text-center middle">Tự chọn</td>
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

                                        <td class="text-center ">
                                            <strong>
                                            @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc')
                                                <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Điều Kiện')
                                        <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Tự Chọn')
                                            <span >{{$scoreboard->SOCHI}}</span>
                                        @endif
                                        </td>
                                        <td class="text-center ">
                                            {{number_format($scoreboard->TRUNGBINH4,1,'.','')}}
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
                                <h6 class="mb-0 fw-bold ">HỌC KỲ 1 NĂM HỌC {{ $nienkhoa2 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr class="success" style="font-weight:bold; color:#697264; vertical-align: middle">
                                        <td rowspan="2" class="text-center middle">STT</td>
                                        <td rowspan="2" class="text-center middle">Mã HP</td>
                                        <td rowspan="2" class="text-center middle">Tên HP</td>
                                        <td rowspan="2" class="text-center middle">Số
                                            TC
                                        </td>
                                        <td colspan="3" class="text-center middle">
                                            Số Tín chỉ
                                        </td>
                                        <td rowspan="2" class="text-center middle">TB4 HP</td>
                                        <td rowspan="2" class="text-center middle">Kết quả</td>
                                    </tr>
                                    <tr class="success" style="font-weight:bold; text-align:center; color:#697264; vertical-align: middle">
                                        <td class="text-center middle">Bắt buộc</td>
                                        <td class="text-center middle">Điều kiện</td>
                                        <td class="text-center middle">Tự chọn</td>
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

                                        <td class="text-center ">
                                            <strong>
                                            @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc')
                                                <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Điều Kiện')
                                        <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Tự Chọn')
                                            <span >{{$scoreboard->SOCHI}}</span>
                                        @endif
                                        </td>
                                        <td class="text-center ">
                                            {{number_format($scoreboard->TRUNGBINH4,1,'.','')}}
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
                                <h6 class="mb-0 fw-bold ">HỌC KỲ 2 NĂM HỌC {{ $nienkhoa2 }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr class="success" style="font-weight:bold; color:#697264; vertical-align: middle">
                                        <td rowspan="2" class="text-center middle">STT</td>
                                        <td rowspan="2" class="text-center middle">Mã HP</td>
                                        <td rowspan="2" class="text-center middle">Tên HP</td>
                                        <td rowspan="2" class="text-center middle">Số
                                            TC
                                        </td>
                                        <td colspan="3" class="text-center middle">
                                            Số Tín chỉ
                                        </td>
                                        <td rowspan="2" class="text-center middle">TB4 HP</td>
                                        <td rowspan="2" class="text-center middle">Kết quả</td>
                                    </tr>
                                    <tr class="success" style="font-weight:bold; text-align:center; color:#697264; vertical-align: middle">
                                        <td class="text-center middle">Bắt buộc</td>
                                        <td class="text-center middle">Điều kiện</td>
                                        <td class="text-center middle">Tự chọn</td>
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

                                        <td class="text-center ">
                                            <strong>
                                            @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-center ">
                                            @if ($scoreboard->LOAIHOCPHAN == 'Điều Kiện')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center ">
                                            @if ($scoreboard->LOAIHOCPHAN == 'Tự Chọn')
                                            <span>{{$scoreboard->SOCHI}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center ">
                                            {{number_format($scoreboard->TRUNGBINH4,1,'.','')}}
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

                    </div>
                </div>

            </div><!-- Row End -->
            @endif
            @if (!!$points_HK1_NK3)
            <div class="row g-3 mb-3 row-deck">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="info-header">
                                <h6 class="mb-0 fw-bold ">HỌC KỲ 1 NĂM HỌC {{ $nienkhoa3}}</h6>
                            </div>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover align-middle mb-0" style="max-width:100%">
                                <thead>
                                    <tr class="success" style="font-weight:bold; color:#697264; vertical-align: middle">
                                        <td rowspan="2" class="text-center middle">STT</td>
                                        <td rowspan="2" class="text-center middle">Mã HP</td>
                                        <td rowspan="2" class="text-center middle">Tên HP</td>
                                        <td rowspan="2" class="text-center middle">Số
                                            TC
                                        </td>
                                        <td colspan="3" class="text-center middle">
                                            Số Tín chỉ
                                        </td>
                                        <td rowspan="2" class="text-center middle">TB4 HP</td>
                                        <td rowspan="2" class="text-center middle">Kết quả</td>
                                    </tr>
                                    <tr class="success" style="font-weight:bold; text-align:center; color:#697264; vertical-align: middle">
                                        <td class="text-center middle">Bắt buộc</td>
                                        <td class="text-center middle">Điều kiện</td>
                                        <td class="text-center middle">Tự chọn</td>
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

                                        <td class="text-center ">
                                            <strong>
                                            @if ($scoreboard->LOAIHOCPHAN == 'Bắt Buộc')
                                                <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                            </strong>
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Điều Kiện')
                                        <span >{{$scoreboard->SOCHI}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center ">
                                        @if ($scoreboard->LOAIHOCPHAN == 'Tự Chọn')
                                            <span >{{$scoreboard->SOCHI}}</span>
                                        @endif
                                        </td>
                                        <td class="text-center ">
                                            {{number_format($scoreboard->TRUNGBINH4,1,'.','')}}
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

                    </div>
                </div>

            </div><!-- Row End -->
            @endif
        </div>
    </div>
</div>
