const addItemBtn = document.getElementById('addItem');
const orderList = document.getElementById('orderList');
const orderForm = document.getElementById('orderForm');

addItemBtn.addEventListener('click', function() {
  const itemName = document.getElementById('item').value;
  const itemQuantity = document.getElementById('quantity').value;

  // Validate input (optional)
  if (itemName.trim() === '' || itemQuantity <= 0) {
    alert('Please enter a valid item name and quantity.');
    return;
  }

  // Create list item element
  const listItem = document.createElement('li');
  listItem.textContent = `${itemName} (x${itemQuantity})`;

  // Add a button to remove the item
  const removeBtn = document.createElement('button');
  removeBtn.textContent = 'Remove';
  removeBtn.classList.add('btn', 'btn-danger', 'remove-item', 'mx-3', 'mb-1');
  removeBtn.addEventListener('click', function() {
    orderList.removeChild(listItem);
  });
  listItem.appendChild(removeBtn);

  // Add the list item to the order list
  orderList.appendChild(listItem);

  // Clear input fields for next item
  document.getElementById('item').value = '';
  document.getElementById('quantity').value = '';
});

// Prevent form submission on pressing Enter in input fields
orderForm.addEventListener('submit', function(e) {
  e.preventDefault();

  // Check if any items are added before submitting
  if (orderList.children.length === 0) {
    alert('Please add at least one item to your order.');
    return;
  }
});