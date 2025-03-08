# Introduction to PHP  

## 1. What is PHP?  
PHP (Hypertext Preprocessor) is a **server-side scripting language** used to create dynamic web applications.  

### 1.1 Why Use PHP?  
- Can interact with databases like **MySQL**.  
- Runs on almost all web servers (**Apache, NGINX**).  
- Supports form handling, authentication, and file uploads.  
- Powers popular websites like **Facebook and WordPress**.  

## 2. Setting Up PHP Locally  
To run PHP, install **XAMPP** (Windows/Linux) or **MAMP** (Mac).  

### 2.1 Installing XAMPP:  
1. Download **XAMPP** from [apachefriends.org](https://www.apachefriends.org/).  
2. Install and open the XAMPP control panel.  
3. Start **Apache** (for running PHP) and **MySQL** (for databases).  
4. Place PHP files in the `htdocs` folder (inside the XAMPP directory).  
5. Open your browser and visit `http://localhost/filename.php`.  


## 3. Writing Your First PHP Script  
Create a file `index.php` inside the `htdocs` folder and add:  

```php
<?php
echo "Hello, World!";
?>
```

Now open `http://localhost/index.php` in your browser to see the output.

---

## 4.  PHP Syntax & Variables

### 4.1 PHP Variables
Variables in PHP start with a **dollar sign** `$` followed by the variable name.  

```php
<?php
$name = "Alice"; // String
$age = 25; // Integer
$isStudent = true; // Boolean

echo "Name: " . $name;
?>
```

---

### 4.2 Data Types in PHP
| Data Type         | Description                      |
| ----------------- | -------------------------------- |
| String            | "Hello, World!"                  |
| Integer           | 25                               |
| Float             | 3.14                             |
| Boolean           | true/false                       |
| Array             | ["Apple", "Banana", "Cherry"]    |
| Associative Array | ["name" => "Alice", "age" => 25] |
| Object            | $car = new Car();                |
| NULL              | null                             |

## 5. Handling Forms with PHP

### 5.1 HTML Form Example:
```html
<form action="submit.php" method="post">
  <input type="text" name="name" placeholder="Enter your name">
  <input type="submit" value="Submit">
</form>
```

### 5.2 Processing Form Data in PHP:
Create a file `submit.php` and add:
```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    echo "Welcome, " . htmlspecialchars($username);
}
?>
```
- $_POST – Retrieves form data.
- htmlspecialchars() – Prevents security vulnerabilities.

---

## 6. PHP Operators

### 6.1 Arithmetic Operators

| Operator | Description    |
| -------- | -------------- |
| +        | Addition       |
| -        | Subtraction    |
| *        | Multiplication |
| /        | Division       |
| %        | Modulus        |

#### Example:

```php
<?php
$x = 10;
$y = 5;

echo $x + $y; // Addition
echo $x - $y; // Subtraction
echo $x * $y; // Multiplication
echo $x / $y; // Division
?>
```

### 6.2 Comparison Operators
```php
<?php
$a = 10;
$b = 20;

echo $a == $b; // false
echo $a != $b; // true
echo $a > $b;  // false
?>
```

## 7. Summary
- PHP is a server-side language for building web applications.
- Install XAMPP to run PHP locally.
- PHP uses echo to output data.
- It supports variables, forms, and databases.