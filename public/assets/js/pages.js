document.querySelector('.delete-from-db')?.addEventListener('click',function(){
    this.closest('.tegs-div').remove()
    sessionStorage.removeItem('modelId');
})
