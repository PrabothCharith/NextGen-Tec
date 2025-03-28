# Using JWT and .env in PHP

## Table of Contents
- [Using JWT and .env in PHP](#using-jwt-and-env-in-php)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Prerequisites](#prerequisites)
  - [Step 1: Install Required Packages](#step-1-install-required-packages)
  - [Step 2: Create the .env File](#step-2-create-the-env-file)
  - [Step 3: Create the JWT Helper Class](#step-3-create-the-jwt-helper-class)
    - [Example to generate a token:](#example-to-generate-a-token)
    - [To decode a token:](#to-decode-a-token)
  - [Step 4: Using JWT in Your Application](#step-4-using-jwt-in-your-application)
    - [Example of a simple login endpoint:](#example-of-a-simple-login-endpoint)
    - [Example of a protected route:](#example-of-a-protected-route)
  - [Technical Words](#technical-words)

## Introduction
- In this guide, we will learn how to use JWT (JSON Web Tokens) for authentication in a PHP application. We will also see how to manage environment variables using the `.env` file.
- This is a common practice in modern web applications to keep sensitive information secure and manage configurations easily.
- We will use the `firebase/php-jwt` library for handling JWTs and `vlucas/phpdotenv` for managing environment variables.

## Prerequisites

- PHP 7.4 or later
- Composer installed
- A web server with PHP support (e.g., Apache, Nginx)
- phpdotenv package for loading .env files
- firebase/php-jwt package for handling JWT

## Step 1: Install Required Packages
1. Create a new directory for your project and navigate to it:
   ```bash
   mkdir your_project
   cd your_project
   ```
2. Initialize a new Composer project:
   ```bash
   composer init
   ```
3. Install the required packages:
   - JWT
    ```bash
    composer require firebase/php-jwt
    ```
   - Dotenv
    ```bash
    composer require vlucas/phpdotenv
    ```

## Step 2: Create the .env File
   1. Create a new file named `.env` in the root of your project directory.
   2. Add the following content to the `.env` file:
      ```env
      JWT_SECRET=your_jwt_secret_key
      ```
   - Replace `your_jwt_secret_key` with a strong secret key for signing your JWTs.

> [!TIP]
> If you want to generate a strong secret key, you can use the following command in your terminal:
``` bash
node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"
```

   3. Make sure to add the `.env` file to your `.gitignore` file to prevent it from being committed to version control:
       ```gitignore
       .env
       ```

## Step 3: Create the JWT Helper Class
1. Create a new file named `JwtHelper.php` in your project directory.
2. Add the following code to `JwtHelper.php`:
   ```php
   <?php

   use Firebase\JWT\JWT;
   use Firebase\JWT\ExpiredException;
   use Firebase\JWT\SignatureInvalidException;

   class JwtHelper {
       private $secretKey;

       public function __construct() {
           $this->secretKey = getenv('JWT_SECRET');
       }

       public function generateToken($data) {
           $issuedAt = time();
           $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour
           $payload = [
               'iat' => $issuedAt,
               'exp' => $expirationTime,
               'data' => $data
           ];

           return JWT::encode($payload, $this->secretKey);
       }

       public function decodeToken($token) {
           try {
               return JWT::decode($token, $this->secretKey, ['HS256']);
           } catch (ExpiredException $e) {
               return null; // Token has expired
           } catch (SignatureInvalidException $e) {
               return null; // Invalid token signature
           }
       }
   }
   ```
3. This class provides methods to generate and decode JWTs using the secret key from the `.env` file.
4. The `generateToken` method creates a JWT with an expiration time of 1 hour, and the `decodeToken` method verifies the token and returns the payload if valid.
5. The `decodeToken` method also handles exceptions for expired tokens and invalid signatures.
6. Make sure to include the `JwtHelper.php` file in your main PHP script where you want to use JWT authentication.
7. You can include the file using the following code:
   ```php
   require 'vendor/autoload.php';
   require 'JwtHelper.php';
   ```
8. This will load the necessary classes from the `vendor` directory created by Composer and your custom `JwtHelper` class.
9. You can now use the `JwtHelper` class to generate and decode JWTs in your application.

### Example to generate a token:
```php
$jwtHelper = new JwtHelper();
$data = ['user_id' => 123, 'username' => 'john_doe'];
$token = $jwtHelper->generateToken($data);
echo "Generated Token: " . $token;
```
### To decode a token:
```php
$decoded = $jwtHelper->decodeToken($token);
if ($decoded) {
    echo "Decoded Token: ";
    print_r($decoded);
} else {
    echo "Invalid or expired token.";
}
```
## Step 4: Using JWT in Your Application
1. You can now use the `JwtHelper` class in your application to handle JWT authentication.
2. For example, you can create a login endpoint that generates a JWT for a user after successful authentication.
3. You can also create a middleware to check the JWT in the request headers for protected routes.
### Example of a simple login endpoint:
```php
<?php
require 'vendor/autoload.php';
require 'JwtHelper.php';
use Dotenv\Dotenv;
// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Simulate user authentication
$username = $_POST['username'];
$password = $_POST['password'];
// Replace with your own authentication logic
if ($username === 'john_doe' && $password === 'password123') {
    $jwtHelper = new JwtHelper();
    $data = ['user_id' => 123, 'username' => $username];
    $token = $jwtHelper->generateToken($data);
    echo json_encode(['token' => $token]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials']);
}
```
### Example of a protected route:
```php
<?php
require 'vendor/autoload.php';
require 'JwtHelper.php';
use Dotenv\Dotenv;
// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$jwtHelper = new JwtHelper();
$headers = getallheaders();
$token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;
if ($token) {
    $decoded = $jwtHelper->decodeToken($token);
    if ($decoded) {
        echo json_encode(['message' => 'Protected route accessed', 'data' => $decoded]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid or expired token']);
    }
} else {
    http_response_code(401);
    echo json_encode(['error' => 'No token provided']);
}
```


## Technical Words
- **mkdir**: A command used in the terminal to create a new directory.
- **createImmutable**: A method from the `vlucas/phpdotenv` library that creates an instance of the `Dotenv` class to load environment variables from the `.env` file.
- **composer**: A dependency manager for PHP that allows you to manage libraries and packages in your project.
- **JWT (JSON Web Token)**: A compact, URL-safe means of representing claims to be transferred between two parties. The claims in a JWT are encoded as a JSON object that is used as the payload of a JSON Web Signature structure or as the plaintext of a JSON Web Encryption structure, enabling the claims to be digitally signed or integrity protected with a Message Authentication Code (MAC) and/or encrypted.
- **.env file**: A file used to store environment variables in a key-value format. It is commonly used to manage sensitive information and configuration settings in a secure manner.
- **firebase/php-jwt**: A PHP library for encoding and decoding JSON Web Tokens (JWT).
- **vlucas/phpdotenv**: A PHP library that loads environment variables from a `.env` file into the `$_ENV` superglobal array.
- **getallheaders()**: A PHP function that retrieves all HTTP headers from the current request.
- **Bearer Token**: A type of access token that is used in HTTP authentication. It is typically included in the `Authorization` header of an HTTP request.
- **http_response_code()**: A PHP function that sets the HTTP response status code for the current request.
- **json_encode()**: A PHP function that converts a PHP variable into a JSON string.
- **json_decode()**: A PHP function that converts a JSON string into a PHP variable.
- **str_replace()**: A PHP function that replaces all occurrences of a search string with a replacement string in a given string.
- **print_r()**: A PHP function that prints human-readable information about a variable.
- **isset()**: A PHP function that checks if a variable is set and is not NULL.