@php
$i=0;
$class='';
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
    .tr-table{
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
        <td colspan=6 align="center" valign=middle style="font-size: 24px;"><b>DANH SÁCH SINH VIÊN LỚP {{$TITLE->MALOPCHUYENNGANH}}</b></td>
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
        <td style="border:1px solid #000000;" align="center" valign=middle height="60"><b>STT</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>MÃ SINH VIÊN</b></td>
        <td style="border:1px solid #000000;" colspan="2" align="center" valign=middle><b>HỌ VÀ TÊN</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>NGÀY SINH</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>GIỚI TÍNH</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>HỘ KHẨU</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>SỐ HỒ SƠ</b></td>
        <td style="border:1px solid #000000;" align="center" valign=middle><b>GHI CHÚ</b></td>
    </tr>
    @foreach($students as $student)
    @php
    $i++;
    @endphp

    <tr>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $i }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->MASV }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->HODEM }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->TEN }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->NGAYSINH }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->PHAI }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->HOKHAU }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->SOHOSO }}</td>
        <td style="border:1px solid #000000;" align="center" valign=middle>{{ $student->GHICHU }}</td>
        <td align="center" valign=middle>
    </tr>

    @endforeach
</table>
