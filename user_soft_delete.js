// Select all buttons with class "deleteUserBtn"
const deleteUserButtons = document.querySelectorAll('.deleteUserBtn');  

deleteUserButtons.forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault();  // Prevent default form submission

    const form = document.getElementById(this.id.replace('deleteUserBtn', 'deleteUserForm'));  // Get the corresponding form

    // Display confirmation dialog
    if (confirm('Are you sure you want to delete this user?')) {
      form.submit();  // Submit the form if user confirms
    } else {
      // Handle cancellation if user doesn't confirm
      console.log('User deletion cancelled.'); // Or show a message
    }
  });
});


// Select all buttons with class "deleteItemBtn"
const deleteItemButtons = document.querySelectorAll('.deleteItemBtn');  

deleteItemButtons.forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault();  // Prevent default form submission

    const form = document.getElementById(this.id.replace('deleteItemBtn', 'deleteItemForm'));  // Get the corresponding form

    // Display confirmation dialog
    if (confirm('Are you sure you want to delete this item?')) {
      form.submit();  // Submit the form if user confirms
    } else {
      // Handle cancellation if user doesn't confirm
      console.log('Item deletion cancelled.'); // Or show a message
    }
  });
});



