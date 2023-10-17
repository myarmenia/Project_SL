

//======================================  options click============================

const selectElement = document.getElementById('selectElement');


    selectElement?.addEventListener('change', (e) => {
      const selectedOption = e.target.selectedOptions[0];
        if (selectedOption) {
          window.location.href = selectedOption.getAttribute('data-url')
        }
    });
