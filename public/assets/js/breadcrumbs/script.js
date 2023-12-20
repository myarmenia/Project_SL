let crumbs = [];
// if()
let currentUrl = window.location.href;
// console.log(currentUrl + ' =====currentUrl')
let url = currentUrl.split(lang)[1]
// console.log(url+ ' --------url')
let uri = location.pathname.substring(1);
// console.log(uri + '888888888')
localStorage.setItem("crumbs_url", crumbs);

// ========================================

console.log(localStorage.hasOwnProperty('crumbs_url') + ' ////////////')

if (uri.includes('?') || currentUrl.includes('edit') || currentUrl.includes('create')) {

    if (localStorage.hasOwnProperty('crumbs_url')) {
        crumbs = localStorage.getItem('crumbs_url');
    }
}
console.log(localStorage.getItem('crumbs_url') + ' ----------')

if (currentUrl.includes('fusion') || currentUrl.includes('loging') || currentUrl.includes('checked-user-list') || currentUrl.includes('advancedsearch')) {
    if (localStorage.hasOwnProperty('crumbs_url')) {
        crumbs = localStorage.getItem('crumbs_url');
    }
}
// if (request()->segment(3) == 'loging' && request()->segment(4)) {
//     if (session()->has('crumbs_url')) {
//         $crumbs = Session::get('crumbs_url');
//     }
// }

// if (request()->segment(2) == 'checked-user-list') {
//     if (session()->has('crumbs_url')) {
//         $crumbs = Session::get('crumbs_url');
//     }
// }
// if (request()->segment(2) == 'advancedsearch') {

//     if(request()->segment(3)){
//     if (session()->has('crumbs_url')) {
//         $crumbs = Session::get('crumbs_url');
//     }

//     }

// }

if (currentUrl.includes('open')) {


let arr_asoc = []
    arr_asoc['title'] = 'open';
    arr_asoc['url'] = url;
    arr_asoc['name'] = 'open';

    crumbs.push(arr_asoc);


} else if (currentUrl.includes('dictionary')) {
    localStorage.removeItem('crumbs_url');

    arr_asoc['title'] = 'dictionary';
    arr_asoc['url'] = url;
    arr_asoc['name'] = 'dictionary(3)';
    crumbs[0] = arr_asoc;

}

else {
}

// printBreadCrumbs(crumbs)



// function printBreadCrumbs(crumbs) {
//     console.log(crumbs)
//     crumbs.forEach((element, index) => {
//         const li = document.createElement('li')
//         li.classList.add('breadcrumb-item')

//         if (element['name'] === crumbs[crumbs.length - 1]['name'] && index == crumbs[crumbs.length - 1]) {
//             li.classList.add('active')
//             let k = 'open'
//             console.log('<?php echo __("sidebar.'+k+'"); ?>')

//             li.innerHTML = `{{ __('sidebar.' . k) }}`;
//             if (element['id']) {
//                 li.innerHTML += ` ID:  ${element['id'] }`
//             }
//         } else {
//             let a = document.createElement('a')
//             a.setAttribute('href', `{{ app()->getLocale() }} ${element['url'] }`)
//             let p = element["name"]

//             a.innerHTML = "{{ __('sidebar.element[name]') }}"
//             if (element['id']) {
//                 a.innerHTML += ` ID:  ${element['id'] }`
//             }
//             li.append(a)
//         }

//         document.querySelector('.breadcrumb').append(li)

//     });


// }

