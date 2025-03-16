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

### 6.2 What is SQL Injection?
**SQL Injection** is a type of attack where an attacker can manipulate a web application's database queries by injecting malicious SQL code through user input. It happens when user input is directly inserted into SQL queries without proper validation or sanitization.

#### Why it Happens
When user input is not properly handled, an attacker can input SQL commands that the application executes, leading to unauthorized access or data manipulation.

#### Step-by-Step Breakdown of How an Attacker Exploits SQL Injection:
1. The attacker identifies a vulnerable input field, such as a login form.
2. They input a specially crafted string that includes SQL commands.
3. If the application does not validate or sanitize the input, the SQL query is executed with the attacker's code.
4. The attacker gains unauthorized access or retrieves sensitive data.

### Example: How SQL Injection Works
```php
<?php
$email = $_GET['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
?>
```
If an attacker inputs `admin' --`, the query becomes:
```sql
SELECT * FROM users WHERE email = 'admin' --';
```
This comment (`--`) effectively ignores the rest of the SQL command, allowing the attacker to bypass login security.

### 6.3 Safe Version Using Prepared Statements
#### What are Prepared Statements?
Prepared statements are a way to execute SQL queries that separate the SQL code from user input. This separation makes it impossible for an attacker to inject malicious SQL code.

#### How Placeholders (?) Work
Placeholders are markers in the SQL query that are replaced with actual values later. This ensures that user input is treated as data, not as part of the SQL command.

### Simple Breakdown of a Prepared Statement
```php
<?php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_GET['email']]);
?>
```
1. **Preparing**: The SQL query is defined with placeholders, and the database prepares it for execution.
2. **Binding**: User input is bound to the placeholders, ensuring it is treated as data.
3. **Executing**: The prepared statement is executed, safely retrieving the data without risk of SQL injection.

### 6.4 Restrict Database Permissions
- Do not use **root** for web applications.
- Create a **limited privilege user**.

### 6.5 Enable HTTPS
Ensure all database connections and API calls are made over **HTTPS**.

---

## 7. Summary
- Use **PDO** over MySQLi for better security.
- Always **handle errors** with `try-catch`.
- Use **prepared statements** to prevent SQL injection.
- Restrict **database user permissions**.
- **Prepared statements prevent SQL injection by treating user input as data, not code.**
