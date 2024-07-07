const addItemBtn = document.getElementById('addItem');
const orderList = document.getElementById('orderList');
const orderForm = document.getElementById('orderForm');
const itemsInputField = document.getElementById('items');
let itemsArray = [];

addItemBtn.addEventListener('click', function() {

  const itemName = document.getElementById('item-name').value;
  const itemSize = document.getElementById('item-size').value;
  const itemQuantity = document.getElementById('quantity').value;

  // Validate input (optional)
  if (itemName.trim() === '' || itemQuantity <= 0) {
    alert('Please enter a valid item name and quantity.');
    return;
  }

  // Create list item element
  const listItem = document.createElement('li');
  listItem.textContent = `${itemName} (${itemSize}) - (x${itemQuantity})`;

  // Add the list item to the order list
  orderList.appendChild(listItem);

  // Add items to the itemsArray 
  const item = [itemName, itemSize, itemQuantity];
  itemsArray.push(item); 

  // Clear input fields for next item
  document.getElementById('item-name').value = '';
  document.getElementById('item-size').value = '';
  document.getElementById('quantity').value = '';
});

// Prevent form submission on pressing Enter in input fields
orderForm.addEventListener('submit', function(e) {
  // e.preventDefault();

  // Check if any items are added before submitting
  if ( orderList.hasChildNodes() && orderList.children.length === 0 ) {
      alert('Please add at least one item to your order.');
      return;
  }

  const itemsJson = JSON.stringify(itemsArray); 
  itemsInputField.value = itemsJson;
});
