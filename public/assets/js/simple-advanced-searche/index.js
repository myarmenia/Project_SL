// let grid_fusion_btn = document.querySelectorAll('.k-grid-fusion')
// grid_fusion_btn.addEventListener('click',(e) => fusionFunc(e))
// function fusionFunc(e) {
//     let arr = []
//     e.preventDefault()
//     let checked_inputs = document.querySelectorAll('.fusion-checkbox-input')
//     let tb_name = document.querySelector('.details').getAttribute('data-tb-name')
//     checked_inputs.forEach(el => {
//         if(el.checked){
//             let fusion_id  = el.closest('tr').querySelector('#grid_active_cell')  
//             let obj = {
//                 id:fusion_id.innerText
//             }
//             arr.push(obj)
//         }
//     })
//    let data = {
//         all_fusion_id: arr,
//         tb_name : tb_name
//     }

//     console.log(data);
   
// }
document.addEventListener("DOMContentLoaded", (e) => {
    let t = document.querySelectorAll('.k-selectable tr')
    console.log(t);
});

