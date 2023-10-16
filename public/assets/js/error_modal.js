function errorModal(el) {
    const errModal = document.getElementById('errModal')

   document.querySelector('.error-modal-info p').textContent = el
    errModal.classList.add('activeErrorModal')


    document.querySelector('.my-close-error').addEventListener('click', (e) => {

      errModal.classList.remove('activeErrorModal')


    })
  }
