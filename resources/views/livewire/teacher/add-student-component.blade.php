<div>
      <!-- Body: Body -->
      <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <div class="col md-4">
                                <h3 class="fw-bold mb-0">Thêm Mới</h3>
                            </div>
                            <div class="col-md-8 text-center">
                                <a href="{{route('student_list')}}" class="btn btn-primary">Danh Sách</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" wire:submit.prevent="save_student()">
                                    <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <label for="lastname" class="form-label">Số hồ sơ</label>
                                            <input type="text" class="form-control" id="lastname" require wire:model="sohoso">
                                            @error('sohoso') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="firstname" class="form-label">Mã sinh viên</label>
                                            <input type="text" class="form-control" id="firstname" required wire:model="masv">
                                            @error('magv') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">Họ sinh viên</label>
                                            <input type="text" class="form-control" id="lastname" required wire:model="hodem">
                                            @error('ho') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">Tên sinh viên</label>
                                            <input type="text" class="form-control" id="lastname" required wire:model="ten">
                                            @error('ten') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Khoa</label>
                                            <select  id="" class="form-control" wire:model="selectedkhoa">
                                                <option value="" selected>-Chọn khoa</option>
                                                @foreach ($khoa as $item_khoa)
                                                <option value="{{$item_khoa->ID_KHOA}}">{{$item_khoa->TENKHOA}}</option>
                                                @endforeach
                                            </select>
                                            @error('department') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Ngành đào tạo</label>
                                            <select  id="" class="form-control" wire:model="selectednganh">
                                                <option value="" selected>-Chọn ngành</option>
                                                @if (!is_null($selectedkhoa))
                                                @foreach ($nganh as $item_nganh)
                                                <option value="{{$item_nganh->ID_NGANH}}">{{$item_nganh->TENNGANH}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('selectednganh') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6" >
                                            <label for="admitdate" class="form-label">Lớp chuyên ngành</label>
                                            <select  id="" class="form-control" wire:model="selectedlopchuyennganh">
                                                <option value="" selected>-Chọn lớp</option>
                                                @if (!is_null($selectednganh))
                                                @foreach ($lopchuyennganh as $key=>$item_lop)
                                                @foreach ($item_lop->lopchuyennganh as $item)
                                                <option value="{{$item->ID_LOPCHUYENNGANH}}">{{$item->MALOPCHUYENNGANH}}</option>
                                                @endforeach
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('selectedlopchuyennganh') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Phái</label>
                                            <select name="PHAI" id="" class="form-control" wire:model="phai">
                                                <option value="" selected>-Chọn giới tính</option>
                                                <option value="Nữ">Nữ</option>
                                                <option value="Nam">Nam</option>
                                            </select>
                                            @error('phai') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Ngày vào trường</label>
                                            <input type="date" class="form-control" id="admitdate"  wire:model="ngayvaotruong">
                                            @error('ngayvaotruong') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Năm vào trường</label>
                                            <input type="number" class="form-control" id="admitdate"  wire:model="namvaotruong">
                                            @error('namvaotruong') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Ngày Sinh</label>
                                            <input type="date" class="form-control" id="admitdate"  wire:model="ngaysinh">
                                            @error('ngaysinh') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastname" class="form-label">CMND</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="cmnd">
                                            @error('cmnd') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Ngày cấp</label>
                                            <input type="date" class="form-control" id="lastname"  wire:model="ngaycap">
                                            @error('ngaycap') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nơi cấp</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="noicap">
                                            @error('noicap') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nơi sinh</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="noisinh">
                                            @error('noisinh') <p class="text-danger">{{ $message }}</p> @enderror

                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Email cá nhân</label>
                                            <input type="email" class="form-control" id="lastname"  wire:model="email">
                                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Số điện thoại</label>
                                            <input type="number" class="form-control" id="admitdate" placeholder="Nhập số điện thoại"  wire:model="sodienthoai">
                                            @error('sodienthoai') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Số điện thoại phụ (nếu có)</label>
                                            <input type="number" class="form-control" id="admitdate"  wire:model="sodienthoai2">
                                            @error('sodienthoai2') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Dân tộc</label>
                                            <input type="text" class="form-control" id="admitdate"  wire:model="dantoc">
                                            @error('dantoc') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Tôn giáo</label>
                                            <input type="text" class="form-control" id="admitdate"  wire:model="tongiao">
                                            @error('tongiao') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Diện chính sách</label>
                                            <select  id="" class="form-control" wire:model="dienchinhsach">
                                                <option value="" selected>-Chọn chính sách</option>
                                                <option value="Không có">Không có</option>
                                                <option value="Hộ nghèo">Hộ nghèo</option>
                                                <option value="Hộ cận nghèo">Hộ cận nghèo</option>
                                                <option value="Hộ đặc biệt khó khăn">Hộ đặc biệt khó khăn</option>
                                                <option value="Hộ gia đình là người dân tộc tiểu số">Hộ gia đình là người dân tộc tiểu số</option>
                                                <option value="Hộ gia đình có người là thương binh, bệnh binh, người có công với cách mạng">Hộ gia đình có người là thương binh, bệnh binh, người có công với cách mạng</option>
                                                <option value="Hộ gia đình bị ảnh hưởng bởi chất độc màu da cam do chiến tranh để lại.">Hộ gia đình bị ảnh hưởng bởi chất độc màu da cam do chiến tranh để lại.</option>
                                                <option value="Quân nhân, công an nhân dân được cử đi học hoặc quân nhân, công an đã hoàn thành nghĩa vụ từ trên 24 tháng và nay đã xuất ngũ.">Quân nhân, công an nhân dân được cử đi học hoặc quân nhân, công an đã hoàn thành nghĩa vụ từ trên 24 tháng và nay đã xuất ngũ.</option>
                                                <option value="Con thương binh, liệt sĩ, con bệnh binh, con bà mẹ Việt Nam anh hùng, con thương binh mất sức lao động trên 81%, con của anh hùng lực lượng vũ trang, anh hùng lao động.">Con thương binh, liệt sĩ, con bệnh binh, con bà mẹ Việt Nam anh hùng, con thương binh mất sức lao động trên 81%, con của anh hùng lực lượng vũ trang, anh hùng lao động.</option>
                                                <option value="Thương binh, bệnh binh, quân nhân, công an nhân dân xuất ngũ được cử đi học hoặc đã hoàn thành nghĩa vụ từ 12 tháng trở lên, hiện đã xuất ngũ tại khu vực 1.">Thương binh, bệnh binh, quân nhân, công an nhân dân xuất ngũ được cử đi học hoặc đã hoàn thành nghĩa vụ từ 12 tháng trở lên, hiện đã xuất ngũ tại khu vực 1.</option>
                                                <option value="Người dân tộc thiểu số">Người dân tộc thiểu số</option>
                                            </select>
                                            @error('dienchinhsach') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Đối tượng ưu tiên</label>
                                            <select name="PHAI" id="" class="form-control" wire:model="doituonguutien">
                                                <option value="" selected>-Chọn đối tượng ưu tiên</option>
                                                <option value="Không có">Không có</option>
                                                <option value="Nhóm ưu tiên 1">Nhóm ưu tiên 1</option>
                                                <option value="Nhóm ưu tiên 2">Nhóm ưu tiên 2</option>
                                                <option value="Khu vực 1">Khu vực 1</option>
                                                <option value="Khu vực 2">Khu vực 2</option>
                                                <option value="Khu vực 2 - NT">Khu vực 2 - NT</option>
                                            </select>
                                            @error('doituonguutien') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Thành phần gia đình</label>
                                            <input type="text" class="form-control" id="admitdate"  wire:model="tpgiadinh">
                                            @error('tpgiadinh') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Trình độ văn hoá</label>
                                            <select  id="" class="form-control" wire:model="trinhdovanhoa">
                                                <option value="" selected>-Chọn trình độ</option>
                                                <option value="Cơ sở">Cơ sở</option>
                                                <option value="Phổ thông">Phổ thông</option>
                                                <option value="Cao đẳng">Cao đẳng</option>
                                                <option value="Đại học">Đại học</option>
                                            </select>
                                            @error('trinhdovanhoa') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Ngày kết nạp đoàn</label>
                                            <input type="date" class="form-control" id="lastname"  wire:model="ngayketnapdoan">
                                            @error('ngayketnapdoan') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nơi kết nạp đoàn</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="noiketnapdoan">
                                            @error('noiketnapdoan') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Ngày kết nạp đảng (nếu có)</label>
                                            <input type="date" class="form-control" id="lastname"  wire:model="ngayketnapdang">
                                            @error('ngayketnapdang') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nơi kết nạp đảng</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="noiketnapdang">
                                            @error('noiketnapdang') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Quá trình công tác</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="quatrinhcongtac">
                                            @error('quatrinhcongtac') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Địa chỉ liên lạc</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="diachilienlac">
                                            @error('diachilienlac') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Ho tên vợ/chồng (nếu có)</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="hotenvochong">
                                            @error('hotenvochong') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nghề nghiệp vợ/chồng (nếu có)</label>
                                            <input type="text" class="form-control" id="lastname"  wire:model="nghenghiepvochong">
                                            @error('nghenghiepvochong') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Họ tên cha</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="hotencha">
                                            @error('hotencha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Năm sinh cha</label>
                                            <input type="date" class="form-control" id="lastname"  wire:model="namsinhcha">
                                            @error('namsinhcha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Dân tộc cha</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="dantoccha">
                                            @error('dantoccha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Tôn giáo cha</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="tongiaocha">
                                            @error('tongiaocha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nghề nghiệp cha</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="nghecha">
                                            @error('nghecha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Số điện thoại cha</label>
                                            <input type="number" class="form-control" id="lastname" wire:model="sodienthoaicha">
                                            @error('sodienthoaicha') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>


                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Họ tên mẹ</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="hotenme">
                                            @error('hotenme') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Năm sinh mẹ</label>
                                            <input type="date" class="form-control" id="lastname"  wire:model="namsinhme">
                                            @error('namsinhme') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Dân tộc mẹ</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="dantocme">
                                            @error('dantocme') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Tôn giáo mẹ</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="tongiaome">
                                            @error('tongiaome') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Nghề nghiệp mẹ</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="ngheme">
                                            @error('ngheme') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Số điện thoại mẹ</label>
                                            <input type="number" class="form-control" id="lastname" wire:model="sodienthoaime">
                                            @error('sodienthoaime') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Địa chỉ liên hệ cha mẹ</label>
                                            <input type="text" class="form-control" id="lastname" wire:model="diachichame">
                                            @error('diachichame') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Bảo Lưu</label>
                                            <select  id="" class="form-control" wire:model="baoluu">
                                                <option value="" selected>-Chọn thông tin</option>
                                                <option value="0">Không có</option>
                                                <option value="1">Đang bảo lưu</option>
                                            </select>
                                            @error('baoluu') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Hệ đào tạo</label>
                                            <select  id="" class="form-control" wire:model="id_hedaotao">
                                                <option value="" selected>-Chọn thông tin</option>
                                                @foreach ($hedaotaos as $hedaotao)
                                                <option value="{{$hedaotao->ID_HEDAOTAO}}">{{$hedaotao->TENDAYDU}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_hedaotao') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Bậc đào tạo</label>
                                            <select  id="" class="form-control" wire:model="id_bacdaotao">
                                                <option value="" selected>-Chọn thông tin</option>
                                                @foreach ($bacdaotaos as $bacdaotao)
                                                <option value="{{$bacdaotao->ID_BACDAOTAO}}">{{$bacdaotao->TENDAYDU}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_bacdaotao') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFileMultiple" class="form-label">Hình hồ sơ</label>
                                            <input class="form-control" type="file" id="formFileMultiple" wire:model="hinhhoso">
                                            <div wire:loading wire:target="hinhhoso"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div>
                                            @if ($hinhhoso)
                                            <img src="{{$hinhhoso->temporaryUrl() }}" width="250">
                                        @endif
                                            @error('hinhhoso') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="formFileMultiple" class="form-label">Hình đại diện</label>
                                            <input class="form-control" type="file" id="formFileMultiple" wire:model="hinhdaidien">
                                            <div wire:loading wire:target="hinhdaidien"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div>
                                            @if ($hinhdaidien)
                                            <img src="{{$hinhdaidien->temporaryUrl() }}" width="250">
                                        @endif
                                            @error('hinhdaidien') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="emailaddress" class="form-label">Hộ khẩu</label>
                                            <input type="text" class="form-control" id="emailaddress" placeholder="Nhập địa chỉ" required wire:model="hokhau">
                                            @error('hokhau') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Chứng chỉ tin học</label>
                                            <select  id="" class="form-control" wire:model="ccatinhoc">
                                                <option value="" selected>-Chọn thông tin</option>
                                                <option value="Không có">Không có</option>
                                                <option value="A">Có bằng A</option>
                                                <option value="B">Có bằng B</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                            @error('ccatinhoc') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admitdate" class="form-label">Chứng chỉ anh văn</label>
                                            <select  id="" class="form-control" wire:model="ccaanhvan">
                                                <option value="" selected>-Chọn thông tin</option>
                                                <option value="Không có">Không có</option>
                                                <option value="A">Có bằng A</option>
                                                <option value="B">Có bằng B</option>
                                                <option value="Khác">Khác</option>
                                            </select>
                                            @error('ccaanhvan') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Ghi Chú</label>
                                            <input type="text" class="form-control" id="lastname" require wire:model="ghichu">
                                            @error('ghichu') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="col-md-6">
                                        <label for="lastname" class="form-label">Tài khoản ngân hàng (nếu có)</label>
                                            <input type="text" class="form-control" id="lastname" require wire:model="sotaikhoan">
                                            @error('sotaikhoan') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Thêm Mới</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Row end  -->

            </div>
        </div>
</div>
