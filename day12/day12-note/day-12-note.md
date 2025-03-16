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

### 3.1 Connecting to MySQL
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

### 3.2 Closing the Connection
```php
$conn->close();
```

---

## 4. Best Practices for Database Connection

### 4.1 Use `mysqli` or `PDO`
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

### 4.2 Use Environment Variables for Credentials
Instead of hardcoding credentials:
```php
$servername = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASS");
$database = getenv("DB_NAME");
```

### 4.3 Always Close Database Connections
```php
$conn = null; // PDO
$conn->close(); // MySQLi
```

---

## 5. Handling Errors

### 5.1 Common Errors
| Error | Cause | Solution |
|-------|-------|----------|
| `Access denied for user` | Wrong credentials | Check username/password |
| `Unknown database` | Database does not exist | Create the database first |
| `Table doesn’t exist` | Table missing | Verify table creation |

### 5.2 Using Try-Catch for Error Handling
```php
try {
    $conn = new PDO("mysql:host=localhost;dbname=my_database", "root", "");
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
```

---

## 6. Security Best Practices

### 6.1 Use Prepared Statements (Prevent SQL Injection)
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(["user@example.com"]);
$data = $stmt->fetch();
```

### 6.2 Sanitize User Input
```php
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
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
