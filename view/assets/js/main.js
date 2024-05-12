var rangeInput = document.getElementById("customRange3");

// Add an event listener for the 'input' event
rangeInput.addEventListener("input", function () {
  // Get the current value of the range input
  var currentValue = rangeInput.value;

  // Log the current value to the console (you can do something else with it)
  document.getElementById("choice_price").innerHTML = currentValue;
});

// rangeInput.onmouseup = function () {
//   window.location.href = "../app/index.php?item_list&&category_id=1";
// };

function getPrice(href) {
  window.location.href = href + rangeInput.value;
}

function add_item(user_id) {
  // Get the current URL
  const url = new URL(window.location.href);

  // Get the query parameters
  const queryParams = new URLSearchParams(url.search);

  // Access individual query parameters
  const productId = queryParams.get("product_id");
  const colorId = queryParams.get("color_id");
  const sizeId = queryParams.get("size_id");

  // Save items to the cart
  const quantity = document.getElementById("quantity").value;

  const payload = {
    'user_id': user_id,
    'product_id': productId,
    'color_id': colorId,
    'size_id': sizeId,
    'quantity': quantity
  };
  
  const hostname = window.location.hostname;

  // Todo: Add new item to the user's cart by sending a post request
  // to the server.
  fetch("add_cart_item.php", {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload)
  }).then((response) => {
    // Display success message.
    if (response.status == 200) {
      var successModal = document.getElementById("add-item-success");
      successModal.style.display = "block";
    } else {
      var errorModal = document.getElementById("add-item-error");
      errorModal.style.display = "block";
    }
  }).catch((response) => {
    // Display error message to the screen if there is an error occured.
      var errorModal = document.getElementById("add-item-error");
      errorModal.style.display = "block";
  })
} 

function add_item_handler(quantity, user_id) {
  // quantity is used to check if the product is out of stock.
  value = document.getElementById("quantity").value;
  if (value > quantity) {
    var modal = document.getElementById("limitModal");
    modal.style.display = "block";
    return;
  } else if (value < 1) {
    var modal = document.getElementById("invalid-input");
    modal.style.display = "block";
    return;
  }

  add_item(user_id);
}

// Function to close the modal
function reloadPage() {
  location.reload();
}

// Function to close the modal
function closeModal() {
  var modal = document.getElementById("limitModal");
  var successModal = document.getElementById("add-item-success");
  var errorModal = document.getElementById("add-item-error");

  modal.style.display = "none";
  successModal.style.display = "none";
  errorModal.style.display = "none";
}


function updateQuantity(user_id, product_id, color_id, size_id, max_quantity) {
    // Create the payload object

    console.log("'updateQuantity' listener is called.");

    let payload = {
        user_id: user_id,
        product_id: product_id,
        color_id: color_id,
        size_id: size_id,
    };

    function changeQuantityHandler(event) {
        // Retrieve the input element that fired the event
        var inputElement = event.target;

        // Retrieve the quantity value from the input element
        var quantity = inputElement.value;
        if (quantity < 0) {
          inputElement.value = 0;
          quantity = 0;
        } else if (quantity > max_quantity) {
          inputElement.value = max_quantity;
          quantity = max_quantity
        }

        payload.quantity = quantity;

        // Make a POST request to the endpoint
        fetch("update_cart_item.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(payload)
        })
        .then(function(response) {
            // Handle the response here
            if (response.ok) {
                console.log("Quantity updated successfully");
            } else {
                throw new Error("Failed to update quantity");
            }
        })
        .catch(function(error) {
            // Handle any errors that occur during the request
            console.error(error);
        });
    }

    return changeQuantityHandler;
}

function change_quantity(quantity) {
  const user_quantity = document.getElementById("quantity").value;
  if (user_quantity > quantity) {
    document.getElementById("quantity").value = quantity;
  } else if (user_quantity < 0) {
    document.getElementById("quantity").value = 0;
  }
}