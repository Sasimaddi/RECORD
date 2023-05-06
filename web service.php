var xhr = new XMLHttpRequest();
xhr.open('GET', 'https://api.example.com/data', true);

// Handle the response using JSON
xhr.onload = function() {
  if (xhr.status === 200) {
    // Parse the JSON data
    var data = JSON.parse(xhr.responseText);

    // Access the data and do something with it
    console.log(data);

    // Example: loop through the data and create HTML elements
    var container = document.getElementById('container');
    for (var i = 0; i < data.length; i++) {
      var item = data[i];
      var element = document.createElement('div');
      element.innerHTML = item.name;
      container.appendChild(element);
    }
  } else {
    console.error('Error: ' + xhr.statusText);
  }
};

// Handle network errors
xhr.onerror = function() {
  console.error('Error: Network request failed');
};

// Send the request
xhr.send();