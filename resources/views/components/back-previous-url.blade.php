<div class="flex justify-content-end">
    @if($submit)
        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-left"></i></button>
    @else
        <a class="btn btn-primary" href="#" onclick="history.back();return false;">
            <i class="bi bi-arrow-left"></i>
        </a>
    @endif
</div>
