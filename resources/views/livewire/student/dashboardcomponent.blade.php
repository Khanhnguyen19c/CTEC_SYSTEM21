<!-- Body: Body -->
<div wire:ignore>
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom">
                        <h3 class="fw-bold mb-0">Thời Gian Biểu</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-lg-12 col-md-12 ">
                    <!-- card: Calendar -->
                    <div class="card">
                        <div class="card-body" id='my_calendar'></div>

                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>

    <!-- Add Event-->
    <div class="modal fade" id="addevent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="eventaddLabel">Thêm Sự Kiện Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput99" class="form-label">Tên Sự Kiện</label>
                        <input type="text" class="form-control" id="exampleFormControlInput99" wire:model="title">
                    </div>
                    <div class="deadline-form">
                        <form method="POST" wire:submit.prevent="save_event()">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="datepickerded" class="form-label">Ngày Bắt Đầu</label>
                                    <input type="datetime-local" class="form-control" id="datepickerded" wire:model.defer="start">
                                </div>
                                <div class="col">
                                    <label for="datepickerdedone" class="form-label">Ngày Kết Thúc</label>
                                    <input type="datetime-local" class="form-control" id="datepickerdedone" wire:model.defer="end">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tạo Mới</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Event-->
    <div class="modal fade" id="editevent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="eventaddLabel">Cập Nhật Sự Kiện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput99" class="form-label">Tên Sự Kiện</label>
                        <input type="text" class="form-control" id="exampleFormControlInput99" wire:model="title">
                    </div>
                    <div class="deadline-form">
                        <form method="POST" wire:submit.prevent="update_event()">
                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="datepickerded" class="form-label">Ngày Bắt Đầu</label>
                                    <input type="datetime-local" class="form-control" id="datepickerded" wire:model.defer="start">
                                </div>
                                <div class="col">
                                    <label for="datepickerdedone" class="form-label">Ngày Kết Thúc</label>
                                    <input type="datetime-local" class="form-control" id="datepickerdedone" wire:model.defer="end">
                                </div>
                            </div>
                    </div>

                    <div class="d-flex justify-content-between">

                        <button class="btn btn-danger" wire:click.prevent=delete_event>Xoá</button>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @push('scripts')

    <script>
        //reset khi dong form
        $('#addevent').on('hidden.bs.modal', function() {
            @this.title = '';
            @this.start = '';
            @this.end = '';
        });
        $('#editevent').on('hidden.bs.modal', function() {
            @this.title = '';
            @this.start = '';
            @this.end = '';
            @this.event_id = '';
        });
        const calendarEL = document.getElementById('my_calendar');
        const calendar = new FullCalendar.Calendar(calendarEL, {
            initialView: 'dayGridMonth',
            selectable: true,
            editable: true,
            displayEventTime: false,
            select: function({
                startStr,
                endStr
            }) {
                $('#addevent').modal('toggle');
                //lấy ngày bắt đầu và kết thúc
                @this.start = startStr + 'T00:00:00';
                @this.end = endStr + 'T00:00:00';
            },
            // click view event use dayjs.org
            eventClick: function({
                event
            }) {
                @this.event_id = event.id;
                @this.title = event.title;
                @this.start = dayjs(event.start).format('YYYY-MM-DDTHH:mm:ss');
                @this.end = dayjs(event.end).format('YYYY-MM-DDTHH:mm:ss');
                $('#editevent').modal('toggle');
            }
        });
        //link API
        calendar.addEventSource({
            url: '/api/calendar/events/{{ Auth::user()->id }}'
        });

        calendar.render();
        // create auto close modal
        document.addEventListener('closeModalCreate', function({
            detail
        }) {
            if (detail.close) {
                $('#addevent').modal('toggle');
            }
        });
        // edit auto close modal
        document.addEventListener('closeModalEdit', function({
            detail
        }) {
            if (detail.close) {
                $('#editevent').modal('toggle');
            }
        });
        // refesh page
        document.addEventListener('refeshEvent', ({
            detail
        }) => {
            if (detail.refesh) {
                calendar.refetchEvents();
            }
        });
    </script>
    @endpush
