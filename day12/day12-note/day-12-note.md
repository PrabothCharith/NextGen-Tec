# Database and PHP Connection

## 1. Introduction
PHP can connect to databases like **MySQL**, allowing dynamic websites to store and retrieve data.

## 2. Setting Up PHP and MySQL Connection
To connect PHP with MySQL, follow these steps:

### 2.1 Enable MySQL in XAMPP
1. Open **XAMPP Control Panel**.
2. Start **Apache** and **MySQL**.

### 2.2 Create a Database
Run this SQL command in **phpMyAdmin**:
```sql
CREATE DATABASE my_database;
```

### 2.3 Create a Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE
);
```

---

## 3. Basic PHP Database Connection

### 3.1 What is MySQLi?
**MySQLi** stands for **MySQL Improved** and is a PHP extension that allows for interaction with MySQL databases. It provides both procedural and object-oriented interfaces. While **MySQLi** is specific to MySQL, **PDO** (PHP Data Objects) is a database abstraction layer that supports multiple database types. 

| Feature        | MySQLi                            | PDO                              |
|----------------|-----------------------------------|----------------------------------|
| Database Support | MySQL only                       | Multiple databases               |
| API Type       | Procedural and Object-oriented    | Object-oriented only             |
| Named Parameters | No                              | Yes                              |
| Error Handling  | Traditional error handling       | Exception handling with `PDOException` |

### 3.2 Connecting to MySQL
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
```

### 3.3 Closing the Connection
```php
$conn->close();
```

---

## 4. Best Practices for Database Connection

### 4.1 What is Try-Catch?
The **try-catch** statement is used for handling errors in PHP. It allows you to execute code in the `try` block and catch exceptions in the `catch` block.

Example:
```php
try {
    // Code that may throw an exception
    echo "Hello, World!";
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}
```

### 4.2 Use `mysqli` or `PDO`
- **PDO** (PHP Data Objects) is recommended for better security and flexibility.
- Example using PDO:
```php
<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=my_database", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
```

### 4.3 What are Environment Variables?
**Environment variables** are dynamic values that store configuration data for your applications. They are preferred over hardcoding credentials because they provide better security and flexibility in different environments.

### 4.4 Use Environment Variables for Credentials
Instead of hardcoding credentials:
```php
$servername = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASS");
$database = getenv("DB_NAME");
```

### 4.5 What is PDO?
**PDO** (PHP Data Objects) is a database abstraction layer that allows access to multiple database types through a uniform interface. It is more secure and flexible compared to MySQLi.

### 4.6 Always Close Database Connections
```php
$conn = null; // PDO
$conn->close(); // MySQLi
```

---

## 5. Handling Errors

### 5.1 What is PDOException?
**PDOException** is an error type specific to **PDO** database operations. It provides detailed information about the error that occurred during database interactions.

### 5.2 Common Errors
| Error | Cause | Solution |
|-------|-------|----------|
| `Access denied for user` | Wrong credentials | Check username/password |
| `Unknown database` | Database does not exist | Create the database first |
| `Table doesn’t exist` | Table missing | Verify table creation |

### 5.3 Using Try-Catch for Error Handling
```php
try {
    $conn = new PDO("mysql:host=localhost;dbname=my_database", "root", "");
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
```

---

## 6. Security Best Practices

### 6.1 What is Data Sanitization?
Data sanitization ensures that user input is safe by removing unwanted characters. This process helps prevent security vulnerabilities such as SQL injection.

#### 6.2.1 What is `FILTER_SANITIZE_EMAIL`?
`FILTER_SANITIZE_EMAIL` removes invalid characters from an email address before using it in the database.

Example:
```php
$email = filter_var("user@@example.com", FILTER_SANITIZE_EMAIL);
echo $email; // Output: user@example.com
```

### 6.2 Use Prepared Statements (Prevent SQL Injection)
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(["user@example.com"]);
$data = $stmt->fetch();
```

### 6.3 Restrict Database Permissions
- Do not use **root** for web applications.
- Create a **limited privilege user**.

### 6.4 Enable HTTPS
Ensure all database connections and API calls are made over **HTTPS**.

---

## 7. Summary
- Use **PDO** over MySQLi for better security.
- Always **handle errors** with `try-catch`.
- Use **prepared statements** to prevent SQL injection.
- Restrict **database user permissions**.

---
This note provides a structured approach from **basic setup** to **best security practices** for PHP-MySQL connections.
