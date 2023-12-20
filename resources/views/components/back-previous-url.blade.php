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

 <script>
     if (document.getElementById('backUrl')) {
         const currentUrl = window.location.href;
         const urlParams = new URLSearchParams(window.location.href);
         const mainRouteValue = urlParams.get('main_route');
         console.log(mainRouteValue)

         const breadcrumb_items = document.querySelectorAll('.breadcrumb-item')
         const prev_url = breadcrumb_items[breadcrumb_items.length - 2].querySelector('a').getAttribute('href')

         if(mainRouteValue){
             const regex = /\/am\/([^\/]+)\/(\d+)\/edit/;
             const matches = currentUrl.match(regex);

             if (matches && matches.length === 3) {
                 console.log(currentUrl)
                 const model = matches[1];
                 const id = matches[2];
                 let params = `?model_id=${id}&model_name=${model}`;
                 console.log(prev_url)
                 if(prev_url.includes('?')){
                     params = params.replace('?', '&')
                 }
                 document.getElementById('backUrl')?.setAttribute('href', prev_url+params)
             }
         }
         else {
             console.log(prev_url)
             document.getElementById('backUrl')?.setAttribute('href', prev_url)
         }
     }
</script>
