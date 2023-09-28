function makeEditable(cell) {
  cell.contentEditable = true;
  cell.focus();

  cell.addEventListener('blur', function() {
      cell.contentEditable = false;
      const newValue = cell.innerText;
      const itemId = cell.getAttribute('data-item-id');
      const column = cell.getAttribute('data-column'); 
      saveCellValueToServer(itemId, column, newValue);
  });
}

function saveCellValueToServer(itemId, column, newValue) {
  fetch(`/editDetailItem/${itemId}`, {
          method: 'PATCH',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify({ column, newValue }),
      })
      .then(response => response.json())
      .then(data => {
          console.log(data);
      })
      .catch(error => {
          console.log('Произошла ошибка', error);
      });
}