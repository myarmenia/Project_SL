<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('title.confirmation-of-action')}}</h5>
                <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('content.modal_text') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_button"
                    data-bs-dismiss="modal">{{__('button.cancel')}}</button>
                <form action="" id="delete_form">
                    <button class="btn btn-primary" id="delete_button" data-bs-dismiss="modal">{{__('button.confirm')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
