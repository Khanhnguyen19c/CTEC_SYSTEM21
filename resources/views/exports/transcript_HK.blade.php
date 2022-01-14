@php
$i=0;
$a=0;
$b=0;
$c=0;
$d=0;
@endphp
<style>
    .td-title {
        text-align: left;
        vertical-align: bottom;
        color: #000000;
    }

    .td-center {
        text-align: center;
        vertical-align: middle;
    }

    .td-text {
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
        border-left: 1px solid #000000;
        border-right: 1px solid #000000;
    }
</style>
<table>

    <tr>
        <td class="td-title"><b>UBND TP CẦN THƠ</b></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td align="center" valign=middle style="font-size: 18px;"><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
    </tr>
    <tr>
        <td align="center" valign=middle>TRƯỜNG CAO ĐẲNG</td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td align="center" valign=middle><u>Độc lập - Tự do - Hạnh phúc</u></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
    </tr>
    <tr>
        <td class="td-title"><b><u>KINH TẾ - KỸ THUẬT CẦN THƠ</u></b></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
        <td align="center" valign=middle><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td height="33" class="td-title"><br></td>
        <td align="center" valign=middle><br></td>
        <td colspan=6 style="font-size: 24px;"><b>KẾT QUẢ HỌC TẬP</b></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td align="center" valign=middle><br></td>
        <td colspan=2 style="font-size: 14px;" align="center" valign=middle><b>Bậc {{ $student->lopchuyennganh->chuyennganh->bacdaotao->TENDAYDU }}</b></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td>Họ và tên sinh viên:{{ $student->HODEM .' '.$student->TEN }}</td>
        <td class="td-title"><br></td>
        <td class="td-title">Mã sinh viên:{{ $student->MASV }}</td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"> Ngày sinh: {{ $student->NGAYSINH }}</td>
        <td class="td-title"><br></td>
        <td class="td-title">Ngành học: {{ $student->lopchuyennganh->chuyennganh->nganh->TENNGANH }}</td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title">Khoá học: {{ $student->lopchuyennganh->NAMNHAPHOC }}-{{ $student->lopchuyennganh->NAMNHAPHOC + 3}}</td>
        <td class="td-title"><br></td>
        <td class="td-title">Hệ đào tạo: {{ $student->lopchuyennganh->chuyennganh->hedaotao->TENDAYDU }}</td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>

    <tr>
    <td colspan=6 height="27" align="left" valign=bottom style="font-size:20;"><b>Năm học: <b>{{ $nienkhoa1 }}</b>;học kỳ 1</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
    <tr>
         <td style="border:1px solid #000000 ;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000 ;"align="center" valign=middle><b>MÃ HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>TÊN HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>SỐ DVHP</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 10</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 4</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM CHỮ</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($points_hk1_nk1 as $score)
    @php
    $i++;
    @endphp
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $i }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->MAHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TENHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->SOCHI }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH10 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH4 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 >= 9.1)
            A
            @elseif ($score->TRUNGBINH10 >= 8.5)
            A-
            @elseif ($score->TRUNGBINH10 >= 7.8)
            B+
            @elseif ($score->TRUNGBINH10 >= 7.0)
            B
            @elseif ($score->TRUNGBINH10 >= 6.5)
            C+
            @elseif ($score->TRUNGBINH10 >= 6.0)
            C
            @elseif ($score->TRUNGBINH10 >= 5.5)
            C-
            @elseif ($score->TRUNGBINH10 >= 5.0)
            D+
            @elseif ($score->TRUNGBINH10 >= 4.5)
            D
            @elseif ($score->TRUNGBINH10 >= 4.0)
            D-
            @else
            F
            @endif
        </td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 <= 4.0)
            <b>Không Đạt</b>
        @elseif($score->LOAIHOCPHAN == 'Bắt Buộc' OR $score->LOAIHOCPHAN == 'Tự Chọn')
            *
        @else
            ĐẠT
        @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td align="left" valign=bottom> -Xếp hạng năm đào tạo: <b>{{$nienkhoa1}}</b></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Tổng số Tín chỉ tích lũy: <b> {{ $TC_TL_HK1_NK1 }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Tổng số Tín chỉ học kỳ: <b>{{ $TBM_HK1_NK1->TINCHI }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBM_HK1_NK1->tichluythang10,2) }}</b> (theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b> {{ round($TBTL_HK1_NK1,2) }} </b>(theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
    <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK1_NK1_T4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b>{{ round($TBM_HK1_NK1->tichluythang4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
		<td align="left" valign=bottom>-Xếp loại học lực tích luỹ: <b>{{$XL_HK1_NK1}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Xếp loại học lực học kỳ: <b>{{$XL_HK1_NK1}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>

<!-- két thúc học kỳ 1 niên khoá 1 -->
<!-- Học kỳ 2 niên khoá 1 -->
<tr>
		<td colspan=6 height="27" align="left" valign=bottom style="font-size:17;"><b>Năm học: <b>{{ $nienkhoa1 }}</b>;học kỳ 2</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>MÃ HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>TÊN HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>SỐ DVHP</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 10</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 4</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM CHỮ</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($points_hk2_nk1 as $score)
    @php
    $a++;
    @endphp
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $a }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->MAHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TENHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->SOCHI }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH10 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH4 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 >= 9.1)
            A
            @elseif ($score->TRUNGBINH10 >= 8.5)
            A-
            @elseif ($score->TRUNGBINH10 >= 7.8)
            B+
            @elseif ($score->TRUNGBINH10 >= 7.0)
            B
            @elseif ($score->TRUNGBINH10 >= 6.5)
            C+
            @elseif ($score->TRUNGBINH10 >= 6.0)
            C
            @elseif ($score->TRUNGBINH10 >= 5.5)
            C-
            @elseif ($score->TRUNGBINH10 >= 5.0)
            D+
            @elseif ($score->TRUNGBINH10 >= 4.5)
            D
            @elseif ($score->TRUNGBINH10 >= 4.0)
            D-
            @else
            F
            @endif
        </td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 <= 4.0)
            <b>Không Đạt</b>
        @elseif($score->LOAIHOCPHAN == 'Bắt Buộc' OR $score->LOAIHOCPHAN == 'Tự Chọn')
            *
        @else
            ĐẠT
        @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td align="left" valign=bottom> -Xếp hạng năm đào tạo: <b>{{$nienkhoa1}}</b></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Tổng số Tín chỉ tích lũy: <b> {{ $TC_TL_HK2_NK1 }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Tổng số Tín chỉ học kỳ: <b>{{ $TBM_HK2_NK1->TINCHI }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK2_NK1,2) }}</b> (theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b> {{ round($TBM_HK2_NK1->tichluythang10,2) }} </b>(theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
    <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK2_NK1_T4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b>{{ round($TBM_HK2_NK1->tichluythang4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
		<td align="left" valign=bottom>-Xếp loại học lực tích luỹ: <b>{{$XL_TL_HK2_NK1}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Xếp loại học lực học kỳ: <b>{{$XL_HK2_NK1}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>

<!-- két thúc học kỳ 2 niên khoá 1 -->
<!-- Học kỳ 1 niên khoá 2 -->
<tr>
		<td colspan=6 height="27" align="left" valign=bottom style="font-size:17;"><b>Năm học: <b>{{ $nienkhoa2 }}</b>;học kỳ 1</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
    <tr>
         <td style="border:1px solid #000000 ;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000 ;"align="center" valign=middle><b>MÃ HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>TÊN HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>SỐ DVHP</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 10</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 4</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM CHỮ</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($points_hk1_nk2 as $score)
    @php
    $b++;
    @endphp
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $b }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->MAHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TENHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->SOCHI }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH10 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH4 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 >= 9.1)
            A
            @elseif ($score->TRUNGBINH10 >= 8.5)
            A-
            @elseif ($score->TRUNGBINH10 >= 7.8)
            B+
            @elseif ($score->TRUNGBINH10 >= 7.0)
            B
            @elseif ($score->TRUNGBINH10 >= 6.5)
            C+
            @elseif ($score->TRUNGBINH10 >= 6.0)
            C
            @elseif ($score->TRUNGBINH10 >= 5.5)
            C-
            @elseif ($score->TRUNGBINH10 >= 5.0)
            D+
            @elseif ($score->TRUNGBINH10 >= 4.5)
            D
            @elseif ($score->TRUNGBINH10 >= 4.0)
            D-
            @else
            F
            @endif
        </td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 <= 4.0)
            <b>Không Đạt</b>
        @elseif($score->LOAIHOCPHAN == 'Bắt Buộc' OR $score->LOAIHOCPHAN == 'Tự Chọn')
            *
        @else
            ĐẠT
        @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td align="left" valign=bottom> -Xếp hạng năm đào tạo: <b>{{$nienkhoa2}}</b></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Tổng số Tín chỉ tích lũy: <b> {{ $TC_TL_HK1_NK2 }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Tổng số Tín chỉ học kỳ: <b>{{ $TBM_HK1_NK2->TINCHI }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK1_NK2,2) }}</b> (theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b> {{ round($TBM_HK1_NK2->tichluythang10,2) }} </b>(theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
    <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK1_NK2_T4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b>{{ round($TBM_HK1_NK2->tichluythang4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
		<td align="left" valign=bottom>-Xếp loại học lực tích luỹ: <b>{{$XL_TL_HK1_NK2}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Xếp loại học lực học kỳ: <b>{{$XL_HK1_NK2}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>


<!-- két thúc học kỳ 1 niên khoá 2 -->
<!-- Học kỳ 2 niên khoá 2 -->

<tr>
		<td colspan=6 height="27" align="left" valign=bottom style="font-size:17;"><b>Năm học: <b>{{ $nienkhoa2 }}</b>;học kỳ 2</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
    <tr>
         <td style="border:1px solid #000000 ;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000 ;"align="center" valign=middle><b>MÃ HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>TÊN HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>SỐ DVHP</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 10</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 4</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM CHỮ</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($points_hk2_nk2 as $score)
    @php
    $c++;
    @endphp
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $c }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->MAHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TENHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->SOCHI }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH10 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH4 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 >= 9.1)
            A
            @elseif ($score->TRUNGBINH10 >= 8.5)
            A-
            @elseif ($score->TRUNGBINH10 >= 7.8)
            B+
            @elseif ($score->TRUNGBINH10 >= 7.0)
            B
            @elseif ($score->TRUNGBINH10 >= 6.5)
            C+
            @elseif ($score->TRUNGBINH10 >= 6.0)
            C
            @elseif ($score->TRUNGBINH10 >= 5.5)
            C-
            @elseif ($score->TRUNGBINH10 >= 5.0)
            D+
            @elseif ($score->TRUNGBINH10 >= 4.5)
            D
            @elseif ($score->TRUNGBINH10 >= 4.0)
            D-
            @else
            F
            @endif
        </td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 <= 4.0)
            <b>Không Đạt</b>
        @elseif($score->LOAIHOCPHAN == 'Bắt Buộc' OR $score->LOAIHOCPHAN == 'Tự Chọn')
            *
        @else
            ĐẠT
        @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td align="left" valign=bottom> -Xếp hạng năm đào tạo: <b>{{$nienkhoa2}}</b></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Tổng số Tín chỉ tích lũy: <b> {{ $TC_TL_HK2_NK2 }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Tổng số Tín chỉ học kỳ: <b>{{ $TBM_HK2_NK2->TINCHI }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK2_NK2,2) }}</b> (theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b> {{ round($TBM_HK2_NK2->tichluythang10,2) }} </b>(theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
    <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK2_NK2_T4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b>{{ round($TBM_HK2_NK2->tichluythang4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
		<td align="left" valign=bottom>-Xếp loại học lực tích luỹ: <b>{{$XL_TL_HK2_NK2}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Xếp loại học lực học kỳ: <b>{{$XL_HK2_NK2}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>

<!-- két thúc học kỳ 2 niên khoá 2 -->
<!-- Học kỳ 1 niên khoá 3 -->

<tr>
		<td colspan=6 height="27" align="left" valign=bottom style="font-size:17;"><b>Năm học: <b>{{ $nienkhoa3}}</b>;học kỳ 1</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
    <tr>
         <td style="border:1px solid #000000 ;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000 ;"align="center" valign=middle><b>MÃ HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>TÊN HỌC PHẦN</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>SỐ DVHP</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 10</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM 4</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>THANG<br>THANG ĐIỂM CHỮ</b></td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($points_hk1_nk3 as $score)
    @php
    $d++;
    @endphp
    <tr>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $d }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->MAHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TENHOCPHAN }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->SOCHI }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH10 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>{{ $score->TRUNGBINH4 }}</td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 >= 9.1)
            A
            @elseif ($score->TRUNGBINH10 >= 8.5)
            A-
            @elseif ($score->TRUNGBINH10 >= 7.8)
            B+
            @elseif ($score->TRUNGBINH10 >= 7.0)
            B
            @elseif ($score->TRUNGBINH10 >= 6.5)
            C+
            @elseif ($score->TRUNGBINH10 >= 6.0)
            C
            @elseif ($score->TRUNGBINH10 >= 5.5)
            C-
            @elseif ($score->TRUNGBINH10 >= 5.0)
            D+
            @elseif ($score->TRUNGBINH10 >= 4.5)
            D
            @elseif ($score->TRUNGBINH10 >= 4.0)
            D-
            @else
            F
            @endif
        </td>
        <td style="border:1px solid #000000 ;" align="center" valign=middle>
            @if ($score->TRUNGBINH10 <= 4.0)
            <b>Không Đạt</b>
        @elseif($score->LOAIHOCPHAN == 'Bắt Buộc' OR $score->LOAIHOCPHAN == 'Tự Chọn')
            *
        @else
            ĐẠT
        @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
        <td class="td-title"><br></td>
    </tr>
    <tr>
        <td align="left" valign=bottom> -Xếp hạng năm đào tạo: <b>{{$nienkhoa3}}</b></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Tổng số Tín chỉ tích lũy: <b> {{ $TC_TL_HK1_NK3}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Tổng số Tín chỉ học kỳ: <b>{{ $TBM_HK1_NK3->TINCHI }}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
        <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK1_NK3,2) }}</b> (theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b> {{ round($TBM_HK1_NK3->tichluythang10,2) }} </b>(theo thang điểm 10)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
    <td align="left" valign=bottom>-Điểm TBC tích lũy: <b>{{ round($TBTL_HK1_NK3_T4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
        <td align="left" valign=bottom>-Điểm TBC học kỳ: <b>{{ round($TBM_HK1_NK3->tichluythang4,2) }}</b> (theo thang điểm 4)</td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
	<tr>
		<td align="left" valign=bottom>-Xếp loại học lực tích luỹ: <b>{{$XL_TL_HK1_NK3}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom>-Xếp loại học lực học kỳ: <b>{{$XL_HK1_NK3}}</b></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
		<td align="left" valign=bottom></td>
	</tr>
<!-- foooter -->
    <tr>
        <td align="left" valign=bottom><i>Ghi chú: Những môn có cột ghi chú là dấu "*" được tính vào điểm tích lũy.</i></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
        <td align="left" valign=bottom></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td colspan=4 align="center" valign=middle>Cần Thơ, ngày
            {{ date("d") }}
            tháng

            {{ date("m") }}
            năm

            {{ date("Y") }}
        </td>
        <td align="center" valign=middle></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td colspan=4 align="center" valign=middle><b>TL. HIỆU TRƯỞNG</b></td>
        <td align="center" valign=middle></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle><b>NGƯỜI LẬP BẢNG</b></td>
        <td align="center" valign=middle></td>
        <td colspan=4 align="center" valign=middle><b>TRƯỞNG PHÒNG QUẢN LÝ ĐÀO TẠO</b></td>
        <td align="center" valign=middle></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle></td>
    </tr>
    <tr>
        <td align="center" valign=middle></td>
        <td align="center" valign=middle><b> ĐINH THẾ AN HUY</b></td>
        <td align="center" valign=middle></td>
        <td colspan=4 align="center" valign=middle><b>PHẠM THANH PHONG</b></td>
        <td align="center" valign=middle></td>
    </tr>

</table>
