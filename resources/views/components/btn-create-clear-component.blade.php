<div class="d-flex justify-content-between py-4">
    @if($show)
        <div>
            <a href="{{ route($route)}}" class="btn btn-secondary" id="clear_button">{{__('content.createNew')}}</a>
        </div>
    @endif
    <div class="button-clear-filter">
        <button class="btn btn-secondary" id="clear_button">{{__('content.clean_all')}}</button>
    </div>
</div>
