# AJAX in JavaScript & Handling Requests in PHP

## 1. What is AJAX?
AJAX (**Asynchronous JavaScript and XML**) allows web pages to send and receive data **without refreshing** the page.

### 1.1 Why Use AJAX?
- Improves user experience by making **asynchronous requests**.
- Reduces page load times.
- Enables dynamic updates without full reloads.

---

## 2. Sending an AJAX Request in JavaScript
AJAX requests are commonly handled using **fetch()** or **XMLHttpRequest**.

### 2.1 Using Fetch API (Modern Approach)
```js
fetch("server.php")
  .then(response => response.text())
  .then(data => console.log(data))
  .catch(error => console.log("Error:", error));
```

- fetch("server.php") – Sends a request to server.php.
- .then(response.text()) – Converts the response to text.
- .catch(error) – Handles errors.


## 3. Handling Requests in PHP
PHP processes incoming AJAX requests and sends responses.

### 3.1 Simple PHP Response to AJAX

`server.php`
```php
<?php
echo "Hello from PHP!";
?>
```

- This script returns a response that AJAX can handle.


## 4. Sending Data from JavaScript to PHP (POST Request)
Data can be sent to the server using the **POST** method.

### 4.1 JavaScript: Sending Data to PHP
```js
fetch("server.php", {
  method: "POST",
  body: JSON.stringify({ name: "John" })
})
  .then(response => response.text())
  .then(data => console.log(data))
  .catch(error => console.log("Error:", error));
```

- method: "POST" – Specifies the request method.
- body: JSON.stringify({ name: "John" }) – Sends data to the server.
- response.text() – Converts the response to text.
- .catch(error) – Handles errors.

### 4.2 PHP: Receiving Data from AJAX
```php
<?php
$data = json_decode(file_get_contents("php://input"));
echo "Hello, " . $data->name . "!";
?>
```

- json_decode(file_get_contents("php://input")) – Retrieves the POST data.
- echo "Hello, " . $data->name . "!"; – Sends a response to JavaScript.
- The response is displayed in the console.
- The server.php script receives the data and sends a response.

---

## 5. Displaying AJAX Response on a Web Page

The AJAX response can be displayed on a web page using JavaScript.

### 5.1 Displaying Response in HTML
```js
fetch("server.php")
  .then(response => response.text())
  .then(data => {
    document.getElementById("output").innerHTML = data;
  })
  .catch(error => console.log("Error:", error));
```

- document.getElementById("output").innerHTML = data; – Displays the response in an HTML element with the ID "output".
- The response is displayed on the web page.

