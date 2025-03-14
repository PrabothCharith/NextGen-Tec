# Introduction to SQL (Structured Query Language)

## 1. What is SQL?
SQL (**Structured Query Language**) is used to manage and manipulate databases.

### 1.1 Why Use SQL?
- Stores and retrieves large amounts of data efficiently.
- Allows filtering, sorting, and organizing data.
- Used in almost all database systems (**MySQL, PostgreSQL, SQL Server**).

### 1.2 Installing MySQL
- **MySQL** is a popular open-source database.
- **MySQL Workbench** is a visual tool to manage databases.

#### For Windows:
  - **Download MySQL Installer**: [MySQL Installer](https://dev.mysql.com/downloads/installer/)

#### For Mac:
  - **Download MySQL**: [MySQL Community Server](https://dev.mysql.com/downloads/mysql/)
  - **Download MySQL Workbench**: [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)

<br>

---

#### Video Tutorial:
Tutorial: [How to Install MySQL on Windows](https://youtu.be/hiS_mWZmmI0?si=6-8VUmKypOD4HtXs&t=80)

> [!IMPORTANT]
> **Install Full Version**
> <br>
> In this video He install custom version, but I recommend you to install full version.

![image](https://github.com/user-attachments/assets/a6bbcf24-d5c0-4461-8a99-d034797605f8)


<br><br>

## 2. SQL Database Basics
### 2.1 What is a Database?
A database is an **organized collection of data** stored in tables.

### 2.2 What is a Table?
A table consists of **rows (records)** and **columns (fields)**.

| id  | name  | age | email          |
| --- | ----- | --- | -------------- |
| 1   | Alice | 25  | alice@mail.com |
| 2   | Bob   | 30  | bob@mail.com   |

### 2.3 What is a Column?
A column is a **set of data values** of a particular type.

### 2.4 What is a Row?
A row is a **single record** in a table.

<br><br>

## 3. SQL Commands
SQL is divided into **four main categories**:

| Type                                   | Commands                               |
| -------------------------------------- | -------------------------------------- |
| **DDL (Data Definition Language)**     | `CREATE`, `ALTER`, `DROP`              |
| **DML (Data Manipulation Language)**   | `SELECT`, `INSERT`, `UPDATE`, `DELETE` |
| **DCL (Data Control Language)**        | `GRANT`, `REVOKE`                      |
| **TCL (Transaction Control Language)** | `COMMIT`, `ROLLBACK`, `SAVEPOINT`      |

<br><br>

## 4. Creating a Database & Table
### 4.1 Creating a Database
```sql
CREATE DATABASE my_database;
USE my_database;
```

### 4.2 Creating a Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    age INT,
    email VARCHAR(100)
);
```

<br><br>

## 5. Inserting Data into a Table

### 5.1 Inserting a Single Row
```sql
INSERT INTO users (name, age, email) 
VALUES ('Alice', 25, 'alice@mail.com');
```

### 5.2 Inserting Multiple Rows
```sql
INSERT INTO users (name, age, email) 
VALUES 
    ('Bob', 30, 'bob@mail.com'),
    ('Charlie', 28, 'charlie@mail.com');
```

<br><br>

## 6. Retrieving Data (SELECT)

### 6.1 Selecting All Data
```sql
SELECT * FROM users;
```

### 6.2 Selecting Specific Columns
```sql
SELECT name, email FROM users;
```

### 6.3 Filtering Data with WHERE
```sql
SELECT * FROM users WHERE age > 25;
```

### 6.4 Sorting Data (ORDER BY)
```sql
SELECT * FROM users ORDER BY age DESC;
```

### 6.5 Limiting Results (LIMIT)
```sql
SELECT * FROM users LIMIT 2;
```

<br><br>

## 7. Updating Data (UPDATE)

### 7.1 Updating a Single Row
```sql
UPDATE users
SET age = 26
WHERE name = 'Alice';
```

### 7.2 Updating Multiple Rows
```sql
UPDATE users
SET age = 30
WHERE age > 25;
```

<br><br>

## 8. Deleting Data (DELETE)

### 8.1 Deleting a Single Row
```sql
DELETE FROM users
WHERE name = 'Alice';
```

### 8.2 Deleting Multiple Rows
```sql
DELETE FROM users
WHERE age > 25;
```

<br><br>

## 9. Using Joins in SQL

_Joins combine data from multiple tables._

First of all, We need minimum two tables to perform a join operation.<br><br>So, let's create a new table called `orders`:

```sql
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

Now, let's insert some data into the `orders` table:

```sql
INSERT INTO orders (user_id, product)
VALUES
    (1, 'Laptop'),
    (2, 'Phone'),
    (1, 'Tablet');
```

<br><br>

### 9.1 Inner Join (Match Data from Both Tables)
- **Inner Join** returns rows when there is at least one match in both tables.
- The `ON` keyword is used to specify the condition.
- The `users.id` and `orders.user_id` columns are used to match the data.
- The `users.name` and `orders.product` columns are selected.
- The result will contain only the rows where the `user_id` matches in both tables.
- If there is no match, the row will not be included in the result.
  
```sql
SELECT users.name, orders.product
FROM users
INNER JOIN orders
ON users.id = orders.user_id;
```

<br><br>

### 9.2 Left Join (Match Data from Left Table)
- **Left Join** returns all rows from the left table and the matched rows from the right table.
- The result will contain all rows from the left table.
- If there is no match, the result will contain `NULL` values for the right table columns.
- The `users.name` and `orders.product` columns are selected.
- The result will contain all rows from the `users` table.
- If there is no match, the `product` column will contain `NULL` values.

```sql
SELECT users.name, orders.product
FROM users
LEFT JOIN orders
ON users.id = orders.user_id;
```

<br><br>

### 9.3 Right Join (Match Data from Right Table)
- **Right Join** returns all rows from the right table and the matched rows from the left table.
- The result will contain all rows from the right table.
- If there is no match, the result will contain `NULL` values for the left table columns.
- The `users.name` and `orders.product` columns are selected.
- The result will contain all rows from the `orders` table.
- If there is no match, the `name` column will contain `NULL` values.

```sql
SELECT users.name, orders.product
FROM users
RIGHT JOIN orders
ON users.id = orders.user_id;
```

<br><br>

### 9.4 Full Join (Match Data from Both Tables)
- **Full Join** returns all rows when there is a match in either the left or right table.
- The result will contain all rows from both tables.
- If there is no match, the result will contain `NULL` values for the columns.
- The `users.name` and `orders.product` columns are selected.
- The result will contain all rows from both the `users` and `orders` tables.
- If there is no match, the columns will contain `NULL` values.

```sql
SELECT users.name, orders.product
FROM users
FULL JOIN orders
ON users.id = orders.user_id;
```

<br><br>

## 10. Transactions in SQL

### 10.1 What is a Transaction?
A transaction ensures all database changes either fully complete or fully rollback.

### 10.2 Committing a Transaction
- **Commit** saves the changes made during the transaction.
- The changes are permanent and cannot be undone.
- The `START TRANSACTION` keyword is used to start a transaction.
- The `COMMIT` keyword is used to save the changes.
- The `ROLLBACK` keyword is used to cancel the changes.

```sql
START TRANSACTION;
UPDATE users SET age = 27 WHERE name = 'Alice';
DELETE FROM users WHERE name = 'Charlie';
ROLLBACK; -- Cancels the changes
```

### 10.3 Rolling Back a Transaction
- **Rollback** cancels the changes made during the transaction.
- The changes are not saved and are undone.
- The `ROLLBACK` keyword is used to cancel the changes.

```sql
START TRANSACTION;
UPDATE users SET age = 27 WHERE name = 'Alice';
DELETE FROM users WHERE name = 'Charlie';
COMMIT; -- Saves the changes
```

<br><br>

## 11. Summary

- CREATE DATABASE → Create a new database.
- CREATE TABLE → Define a new table.
- INSERT INTO → Add new records.
- SELECT → Retrieve data from tables.
- UPDATE → Modify existing records.
- DELETE → Remove records.
- JOINS → Combine data from multiple tables.
- TRANSACTIONS → Ensure safe database operations.
