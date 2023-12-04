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
                    <div class="mb-3 announcement-input-block file-input-block">
                        <form action="" class="file-form">
                            <input type="file" class="attach-file-input btn btn-primary">
                        </form>
                    </div>

                    <div class="mb-3 announcement-input-block textarea-block">
                        <textarea class="text_area_modal form-control-text" id="exampleFormControlTextarea1" rows="10"></textarea>
                    </div>

                </div>
                <div class="modal-buttons">
                    <button class="btn btn-primary add-file-btn" data-bs-dismiss="modal">{{ __('button.save') }}</button>
                    <button class="btn btn-secondary close-button" data-bs-dismiss="modal">{{ __('button.cancel') }}</button>
                </div>

            </div>
        </div>
    </div>
