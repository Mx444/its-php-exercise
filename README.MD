# PHP Programming Exercises - ITS Steve Jobs Academy

This repository contains a collection of PHP programming exercises developed during the course at the ITS Steve Jobs Academy. The exercises cover various aspects of PHP programming, from basics to more advanced concepts.

## Repository Structure

The repository is organized into thematic folders:

- **database/**: Database configuration
  - PDO database connections
  - Environment variable credential management

- **public/**: User interface
  - Main application page
  - User management forms
  - Data visualization

- **utenti/**: User management
  - **controllers/**: Controllers for request handling
  - **providers/**: Services for business logic
  - **repositories/**: Database data access

- **utilis/**: Utility functions
  - Regular expression validation
  - Helper functions

## How to Use the Application

This project implements a CRUD (Create, Read, Update, Delete) application for user management. To run the application:

1. Clone the repository
2. Install dependencies with Composer:
```bash
composer install
```
3. Configure environment variables in the `.env` file with database parameters:
```
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=password
DB_NAME=database_name
```
4. Start a local PHP server:
```bash
php -S localhost:8000 -t src/public
```
5. Access the application via browser at `http://localhost:8000`

## Feature Examples

### Data Validation
```php
// String validation with regular expressions
function validateString(string $nome)
{
    // Check that the name contains only letters (3-15 characters)
    if (!preg_match('/^[a-zA-Z]{3,15}$/', $nome)) {
        throw new Exception("The name can only contain letters and must be between 3 and 15 characters!");
    }
}
```

### Database Operations
```php
// Reading all users from the database
public function read(): array
{
    try {
        $query = "SELECT * FROM utenti";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        return [];
    }
}
```

### Request Handling
```php
// Registering a new user
public function registerUser(array $data): never
{
    if (isset($data['nome']) && isset($data['email'])) {
        try {
            $this->utentiService->register(nome: $data['nome'], email: $data['email']);
            $_SESSION['success'] = "User registered successfully";
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
        }
    } else {
        $_SESSION['error'] = "Registration error";
    }
    header(header: 'Location: ./index.php');
    exit();
}
```

## Educational Objectives

These exercises were designed to:
- Understand the fundamental concepts of PHP programming
- Develop web application development skills
- Apply the MVC (Model-View-Controller) architectural pattern
- Implement CRUD operations on databases
- Improve the ability to write clean and well-structured code

## Requirements

- PHP 8.0 or higher
- Composer for dependency management
- MySQL database
- Basic knowledge of PHP syntax

---

*This repository was created as part of the educational journey at ITS Steve Jobs Academy.*