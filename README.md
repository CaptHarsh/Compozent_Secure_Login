# Compozent Secure Login System

# Introduction

Compozent Secure Login is a PHP-based authentication system that ensures secure user authentication, login, and signup functionalities. This system relies on a MySQL database to securely store user information.

# Installation

# Clone the repository to your local machine:

    git clone https://github.com/CaptHarsh/Compozent_Secure_Login.git

Set up a MySQL database and update the database connection details in LoginPage.php and Signup.php:

     $servername = "localhost";
     $username = "your_username";
     $password = "your_password";
     $database = "your_database";

Import the compozent_secure_login_db.sql file into your MySQL database to create the necessary tables. Ensure that your PHP environment is set up and running. If using a local environment, consider using a service like MailTrap for 2FA verification.
![image](https://github.com/CaptHarsh/Compozent_Secure_Login/assets/117205669/5e100119-a546-4701-a321-7a9430b2e0b6)
![image](https://github.com/CaptHarsh/Compozent_Secure_Login/assets/117205669/2535bec0-6c63-4038-bb15-a474f09b951d)
![image](https://github.com/CaptHarsh/Compozent_Secure_Login/assets/117205669/5fc810d8-2f1e-403a-a38b-2535f578b462)
![image](https://github.com/CaptHarsh/Compozent_Secure_Login/assets/117205669/438c698f-1f24-43e6-88f0-bc73d255d2b9)
![image](https://github.com/CaptHarsh/Compozent_Secure_Login/assets/117205669/e078a67d-ab26-478d-8603-e58a92dba376)


# Functionalities

User Authentication:
Users can authenticate themselves by providing their username and password, with passwords securely hashed using the password_hash function. The system uses password_verify to validate user-entered passwords during login.

Login Page (LoginPage.php):
The login page allows users to enter their credentials with a minimalist design and a dark theme for an enhanced user experience. Appropriate error messages are displayed for invalid usernames or passwords. Upon successful login, users are redirected to the dashboard (Dashboard.php).

Dashboard (Dashboard.php):
Authenticated users are greeted with a welcome message, and the dashboard provides a logout button for secure account logout. Sessions are used to track user authentication status.

Signup Page (Signup.php):
Users can create a new account by providing a unique username, email, and password. Passwords are securely hashed before being stored, and checks for existing usernames and emails ensure uniqueness. A simulated two-factor authentication (2FA) process via email is included, using a randomly generated verification code.

# Database Connection
The system establishes a secure connection to a MySQL database, with configurable database connection details (server, username, password, database name).

# Security Measures
Passwords are hashed using bcrypt for enhanced security. Input validation is implemented to prevent SQL injection and other common security vulnerabilities. The system recommends using HTTPS to encrypt data in transit.






