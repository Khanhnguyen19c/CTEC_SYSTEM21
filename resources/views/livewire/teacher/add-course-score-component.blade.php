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
                            <a href="{{route('coursescore_list')}}" class="btn btn-primary">Danh Sách</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST" wire:submit.prevent="add_courseScore()">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Mã học phần</label>
                                        <select name="PHAI" id="" class="form-control" wire:model="selectedhocphan">
                                            <option value="" selected>-Chọn học phần</option>
                                            @foreach ($module as $module)
                                            <option value="{{$module->hocphan->ID_HOCPHAN}}">{{$module->hocphan->MAHOCPHAN}} - {{$module->hocphan->TENHOCPHAN}}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedhocphan') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="firstname" class="form-label">Lớp học phần</label>
                                        <select name="PHAI" id="" class="form-control" wire:model="selectedlophocphan">
                                            <option value="" selected>-Chọn lớp học phần</option>
                                            @foreach ($classmodule as $classmodule)
                                            <option value="{{$classmodule->ID_LOPHOCPHAN}}">{{$classmodule->MALOPHOCPHAN}}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedlophocphan') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname" class="form-label">Tên sinh viên</label>
                                        <select name="PHAI" id="" class="form-control" wire:model="ID_SINHVIEN">
                                            <option value="" selected>-Chọn sinh viên</option>
                                            @foreach ($student as $student)
                                            <option value="{{$student->sinhvien->ID_SINHVIEN}}">{{$student->sinhvien->MASV}} - {{$student->sinhvien->HODEM}} {{$student->sinhvien->TEN}}</option>
                                            @endforeach
                                        </select>
                                        @error('ID_SINHVIEN') <p class="text-danger">{{ $message }}</p> @enderror

                                    </div>

                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 1 (Cột 1)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS11">
                                        @error('HS11') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 1 (Cột 2)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS12">
                                        @error('HS12') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 1 (Cột 3)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS13">
                                        @error('HS13') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 2 (Cột 1)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS21">
                                        @error('HS21') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 2 (Cột 2)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS22">
                                        @error('HS22') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="admitdate" class="form-label">Hệ số 2 (Cột 3)</label>
                                        <input type="text" class="form-control" id="admitdate" wire:model="HS23">
                                        @error('HS23') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emailaddress" class="form-label">Thi lần 1</label>
                                        <input type="text" class="form-control" id="emailaddress" wire:model="THILAN1">
                                        @error('THILAN1') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emailaddress" class="form-label">Thi lần 2</label>
                                        <input type="text" class="form-control" id="emailaddress" wire:model="THILAN2">
                                        @error('THILAN2') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="emailaddress" class="form-label">Số tiết vắng (LT)</label>
                                        <input type="text" class="form-control" id="emailaddress" wire:model="SOTIETVANGLYTHUYET">
                                        @error('SOTIETVANGLYTHUYET') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emailaddress" class="form-label">Số tiết vắng (TH)</label>
                                        <input type="text" class="form-control" id="emailaddress" wire:model="SOTIETVANGTHUCHANH">
                                        @error('SOTIETVANGTHUCHANH') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="emailaddress" class="form-label">Ghi chú</label>
                                        <input type="text" class="form-control" id="emailaddress" wire:model="GHICHU">
                                        @error('GHICHU') <p class="text-danger">{{ $message }}</p> @enderror
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
