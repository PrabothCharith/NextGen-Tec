# Assignment-2: PHP, JavaScript, and MySQL Basics  

## Assignment: User Registration & Login System  

### Objective  
Create a simple user registration and login system using PHP, JavaScript, and MySQL. This assignment will help you understand form validation, data processing, and database interaction.  

### Submission Link  
https://forms.gle/kXVESmGq2CLNf63o6

### Deadline  
27/03/2025  

---

## Requirements  

### Forms  
- Create a **registration form** (`index.php`)  
- Create a **login form** (`login.php`)  
- Use **Tailwind CSS** for styling  
- You can reuse the previous assignment’s design  

### Validation  
- Ensure **fields are not empty**  
- Password must be **at least 6 characters long**  
- Confirm password must **match the entered password**  

### Backend (`server.php`)  
- Use **MySQLi** or **PDO** to connect to the database  
- Process **all backend logic** in `server.php`  
- **Do not use sessions**  

### JavaScript (Frontend Requests)  
- Use the **Fetch API** to send and receive data in **JSON format**  
- **jQuery is optional**, but Fetch API is required for sending requests  

### Database  
- **Table Name:** `users`  
- **Fields:** `id`, `name`, `email`, `password`  

---

## Process Flow  

### User Registration  
1. Users register via `index.php`  
2. On **successful registration**, redirect to `login.php`  

### User Login  
1. Users log in using their **email** and **password**  
2. If login is successful, redirect to `dashboard.php`  
3. `dashboard.php` should exist but **does not need any design or content**  

---

## Submission Instructions  
1. After completing the assignment, compress **all project files** (including the **database `.sql` file**) into a `.zip` file.  
2. Upload the `.zip` file to the provided link before the deadline.  

---

## Evaluation Criteria  

| **Criteria**           | **Points** | **Description**  |
|------------------------|------------|----------------|
| **Form Design & Styling** | 10  | Uses **Tailwind CSS** properly. The forms are structured and visually appealing. |
| **Frontend Validation** | 15  | Validates **empty fields, password length (min. 6 chars), and matching passwords** before sending data to the server. |
| **JavaScript Fetch Usage** | 15  | Correctly **sends requests via Fetch API** and processes **JSON responses**. |
| **PHP Backend Processing** | 20  | Properly handles **form submissions and database interactions** in `server.php`. |
| **Database Integration** | 20  | Successfully **connects to MySQL**, inserts user data, and verifies login credentials. |
| **Redirects & Process Flow** | 10  | Registration redirects to **login.php**, and successful login redirects to **dashboard.php**. |
| **Code Quality & Organization** | 10  | Code is **clean, structured, and well-commented**. |