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
        //  const currentUrl = window.location.href;
        //  const urlParams = new URLSearchParams(window.location.href);
        //  const mainRouteValue = urlParams.get('main_route');
        //  console.log(mainRouteValue)

         const breadcrumb_items = document.querySelectorAll('.breadcrumb-item')
         const prev_url = breadcrumb_items[breadcrumb_items.length - 2].querySelector('a').getAttribute('href')
         document.getElementById('backUrl')?.setAttribute('href', prev_url)

         // deleteDublicates(breadcrumb_items)

        //  if(mainRouteValue){
        //      const regex = /\/am\/([^\/]+)\/(\d+)\/edit/;
        //      const matches = currentUrl.match(regex);

        //      if (matches && matches.length === 3) {
        //          console.log(currentUrl)
        //          const model = matches[1];
        //          const id = matches[2];
        //          let params = `?model_id=${id}&model_name=${model}`;
        //          console.log(prev_url)
        //          if(prev_url.includes('?')){
        //              params = params.replace('?', '&')
        //          }
        //          // console.log(params)
        //          document.getElementById('backUrl')?.setAttribute('href', prev_url+params)

        //      }
        //  }
        //  else {
        //      console.log(prev_url)
        //      document.getElementById('backUrl')?.setAttribute('href', prev_url)
        //  }


         // function deleteDublicates(breadcrumb_items){
         //     const elementsArray = Array.from(document.querySelectorAll('.breadcrumb-item'));
         //     const seenValues = {};
         //
         //     for (let i = 0; i < elementsArray.length; i++) {
         //         const element = elementsArray[i];
         //         const innerTextValue = element.innerText;
         //         if (seenValues[innerTextValue]) {
         //             elementsArray.splice(i, 1);
         //             i--;
         //         } else {
         //             seenValues[innerTextValue] = true;
         //         }
         //     }
         //     breadcrumb_items = elementsArray;
         // }
     }
</script>
