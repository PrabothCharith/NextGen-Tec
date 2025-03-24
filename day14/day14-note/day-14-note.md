# Full Course Summary - Web Development with PHP & MySQL

This document provides a **detailed summary** of all topics covered from **Day 1 to the Final Project**.

## **1. Introduction to Web Development**
Web development consists of **frontend (client-side)** and **backend (server-side)** development.  
- **Frontend:** Handles user interface and interactions (HTML, CSS, JavaScript).
- **Backend:** Manages data processing and database interactions (PHP, MySQL).
- **Full-Stack:** Combines both frontend and backend.

## **2. HTML - The Structure of Webpages**
HTML (**HyperText Markup Language**) defines the structure of web pages.  
### **2.1 Basic Structure of an HTML Document**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Web Page</title>
</head>
<body>
    <h1>Welcome to Web Development</h1>
</body>
</html>
```
### **2.2 Common HTML Elements**
- **Headings:** `<h1> to <h6>`
- **Paragraphs:** `<p>`
- **Links:** `<a href="url">`
- **Images:** `<img src="image.jpg">`
- **Forms:** `<form>, <input>, <button>`

## **3. CSS - Styling Web Pages**
CSS (**Cascading Style Sheets**) is used to design web pages.

### **3.1 Types of CSS**
- **Inline CSS:** Directly inside an element (`style="color: red;"`).
- **Internal CSS:** Inside `<style>` in the `<head>` section.
- **External CSS:** A separate `.css` file linked with `<link>`.

### **3.2 Basic CSS Example**
```css
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}
```

## **4. JavaScript - Making Web Pages Interactive**
JavaScript (**JS**) adds dynamic behavior to web pages.

### **4.1 Variables & Data Types**
```js
let name = "John"; // String
let age = 25;      // Number
```

### **4.2 Functions & Events**
```js
function greet() {
    alert("Hello, World!");
}
document.getElementById("btn").addEventListener("click", greet);
```

### **4.3 Fetch API**
```js
fetch("server.php")
    .then(response => response.json())
    .then(data => console.log(data));
```

## **5. PHP - Server-Side Scripting**
PHP is a **backend scripting language** used for dynamic web applications.

### **5.1 Basic PHP Syntax**
```php
<?php
echo "Hello, PHP!";
?>
```

### **5.2 Variables & Data Types**
```php
$name = "Alice";
$age = 30;
```

### **5.3 PHP Functions**
```php
function greet($name) {
    return "Hello, " . $name . "!";
}
```

## **6. MySQL - Database Management**
MySQL is a **relational database** used to store and manage data.

### **6.1 Creating a Database**
```sql
CREATE DATABASE ecommerce;
```

### **6.2 Creating a Table**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE
);
```

### **6.3 Basic CRUD Operations**
- **Insert Data:**  
```sql
INSERT INTO users (name, email) VALUES ('Alice', 'alice@mail.com');
```
- **Retrieve Data:**  
```sql
SELECT * FROM users;
```
- **Update Data:**  
```sql
UPDATE users SET name = 'Bob' WHERE id = 1;
```
- **Delete Data:**  
```sql
DELETE FROM users WHERE id = 1;
```

## **7. PHP & MySQL Connection**
### **7.1 Using PDO for Database Connection**
```php
<?php
$dsn = "mysql:host=localhost;dbname=ecommerce";
$username = "root";
$password = "";
try {
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
```

### **7.2 Handling Form Data**
```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
}
?>
```

## **8. Sessions & Cookies**
### **8.1 Sessions**
Sessions store user data on the server.

#### 8.1.1 Start a Session
```php
session_start();
```
#### 8.1.2 Set Session Data
```php
$_SESSION["username"] = "JohnDoe";
```
#### 8.1.3 Get Session Data
```php
if(isset($_SESSION["username"])) {
    echo "Username: " . $_SESSION["username"];
}
```
#### 8.1.4 Destroy Session
```php
session_start();
session_unset();
session_destroy();
```
#### 8.1.5 Session Timeout
```php
$lifetime = 3600; // 1 hour (in seconds)
session_set_cookie_params($lifetime);
session_start();
```

### **8.2 Cookies**
Cookies store user data on the client-side.

#### 8.2.1 Set data
```php
setcookie("username", "JohnDoe", time() + (86400 * 30), "/");
```
#### 8.2.2 Get data
```php
if(isset($_COOKIE["username"])) {
    echo "Username: " . $_COOKIE["username"];
}
```
### **8.3 Destroying Cookies**
```php
setcookie("username", "", time() - 3600, "/");
```

## **9. Security Best Practices**
### **9.1 SQL Injection & Prevention**
**Vulnerable Code:**
```php
$query = "SELECT * FROM users WHERE email = '$email'";
```
**Secure Code (Prepared Statements):**

#### Method 1:
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email, $password]);
```
---
#### Method 2:
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password
$stmt->execute();
```

### **9.2 Data Validation & Sanitization**
```php
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
```
