# Bibliotheca – RFID-Based Library Management System

## Features
* RFID-based member and book tracking
* Real-time book issuance and return system
* Online portal for searching books and managing accounts
* Admin panel for managing books and members
* Detailed transaction history and feedback module (to be implemented)
* Password reset and validation system
* Integration of hardware (RFID reader and RFID tags) with backend

## Technology Stack
* **Frontend**: HTML, CSS, JavaScript
* **Backend**: PHP, Python
* **Database**: MySQL (can be modified to fit PSQL)
* **Hardware**: EM-18 RFID Reader, EM4102 RFID Tags (can use any reader as long as it transmits serial data)

## System Architecture

* **RFID Scanner Module**  
  Detects member and book tags using EM-18 reader connected to UART to serial convertor and sends serial data to the backend.

* **Web Application**  
  Handles member login, book search, issue/return requests, and admin operations.

* **Database**  
  Stores all user, book, author, and transaction data in normalized relational tables.

## How to Set Up
* **Backend**
  * Run the `app.py` program.
  * Start the MySQL server if using MySQL or update the code to fit any other database server.
  * Run the `db.sql` file on the database server.
 
* **Frontend**
  * For a member, the `Page/homepage.html` is the starting point.
  * For issuing/returning books, the `Main/main.html` is the starting point, which should ideally be constantly running one a screen in the library.
  * All passwords for the members and the admin are provided in the database.
 
## How to Use
* **Issue or Return a Book**
  * Scan the member's RFID tag.
  * Scan the book's RFID tag.
  * System checks borrowing limits, availability, and logs the transaction.
 
* **Online Portal**
  * Members can search for books, view borrowing history, and update their profile.
  * Admins can add, update, or delete books and members.

## Authors and Acknowledgements
This project was the mandatory final year project of my bachelor's degree, made together with my project group "Group BG5".

Made during my 5th and 6th Semester (last year) at Fergusson College pursuing B.Sc. (Computer Science).
