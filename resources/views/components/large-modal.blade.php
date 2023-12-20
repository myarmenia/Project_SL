<!-------------------------------------- large modal blog -------------------------------------------------->
<div class="modal fade" id="additional_information" tabindex="-1" aria-labelledby="exampleModalLgLabel"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalLgLabel">{{ __('content.createNew') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="large-modalBlock">
                    <div class="mb-3 announcement-input-block calendar-container">
                        <label for="start_of_announcement" class="form-label">{{ __('content.start_time') }}</label>
                        <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                        <input style="position: relative;" type="text"  data-check="date" class="form-control calendarInput"
                               id="start_of_announcement"
                               autocomplete="off" onblur="handleBlur(this)">
                    </div>
                    <div class="mb-3 announcement-input-block calendar-container">
                        <label for="end_of_announcement" class="form-label">{{ __('content.end_time') }}</label>
                        <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>
                        <input style="position: relative;" type="text" data-check="date" class="form-control calendarInput"
                               id="end_of_announcement"
                               autocomplete="off" onblur="handleBlur(this)">
                    </div>
                    <div class="mb-3 announcement-input-block">
                        <label for="exampleFormControlTextarea1" class="form-label">{{ __('content.large_modal_desc') }}</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-button">
                    <button class='btn btn-primary my-class-sub' data-bs-dismiss="modal">{{ __('content.addTo') }}</button>
                </div>
                <input hidden id="updated_route" value="{{route('man.update',$dataId)}}">
            </div>
        </div>
    </div>
</div>
