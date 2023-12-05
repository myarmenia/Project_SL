<div class="flex justify-content-end">
    @if ($submit)
        <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-left"></i></button>
    
    @else
        {{-- <a class="btn btn-primary" href="#" onclick="history.back();return false;">
            <i class="bi bi-arrow-left"></i>
        </a> --}}
        <a class="btn btn-primary" href="#" id="backUrl">
            <i class="bi bi-arrow-left"></i>
        </a>
    @endif
</div>

{{-- <script>
    if (document.getElementById('backUrl') != 'undefined') {

        let breadcrumb_items = document.querySelectorAll('.breadcrumb-item')
        let prev_url = breadcrumb_items[breadcrumb_items.length - 2].querySelector('a').getAttribute('href')
        console.log(prev_url)
        document.getElementById('backUrl').setAttribute('href', prev_url)
    }
    // sessionStorage.setItem('reload', 'yes');
</script> --}}
