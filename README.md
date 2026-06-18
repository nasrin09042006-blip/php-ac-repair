If your AC Repair & Service project is built with **PHP**, use this README:

# ❄️ AC Repair & Service Management System

A web-based AC Repair & Service Management System developed using PHP and MySQL. This application helps customers book AC repair and maintenance services online while enabling administrators to manage service requests, customers, and technicians efficiently.

## 📌 Overview

The system simplifies the process of scheduling AC repairs and maintenance services. Customers can submit service requests, track their status, and receive updates, while administrators can manage bookings and service records from a centralized dashboard.

## ✨ Features

* User Registration and Login
* AC Service Booking
* Repair Request Submission
* Customer Dashboard
* Admin Dashboard
* Service Status Tracking
* Technician Management
* Service History
* Responsive User Interface
* Secure Authentication

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
* **Backend:** PHP
* **Database:** MySQL
* **Server:** Apache (XAMPP/WAMP/LAMP)

## 📂 Project Structure

```text
ac-repair-service/
│
├── admin/
│   ├── dashboard.php
│   ├── manage-services.php
│   └── manage-users.php
│
├── customer/
│   ├── booking.php
│   ├── profile.php
│   └── history.php
│
├── includes/
│   ├── config.php
│   ├── header.php
│   └── footer.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── database/
│   └── ac_service.sql
│
├── index.php
├── login.php
├── register.php
└── README.md
```

## ⚙️ Installation

### 1. Clone the Repository

``https://github.com/nasrin09042006-blip

```

### 2. Move Project to Server Directory

For XAMPP:

```text
C:\xampp\htdocs\
```

### 3. Create Database

1. Open phpMyAdmin.
2. Create a database named:

```sql
ac_service_db
```

3. Import the SQL file from the `database` folder.

### 4. Configure Database Connection

Edit `config.php`:

```php
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ac_service_db";

$conn = mysqli_connect($host, $user, $password, $database);
?>
```

### 5. Run the Project

Start Apache and MySQL from XAMPP.

Open:

```text
http://localhost/ac-repair-service
```

## 👨‍💻 User Roles

### Customer

* Register/Login
* Book AC Services
* View Service Status
* Manage Profile

### Administrator

* Manage Customers
* Manage Service Requests
* Assign Technicians
* Update Service Status
* Generate Reports

## 📸 Screenshots
img width="1366" height="720" alt="Screenshot 2025-10-15 174803" src=<"https://github.com/user-attachments/assets/ad2e92e7-a507-4fd6-afc0-c1f70f5d5d90" />


### Home Page
<img width="1366" height="720" alt="Screenshot 2025-10-15 174803" src="https://github.com/user-attachme<img width="1366" height="720" alt="Screenshot 2025-10-15 142444" src="https://github.com/user-attachments/assets/98d8769b-44ad-4164-b73a-782a7ef044f9" />
nts/assets/48be1a5b-cb5c-46a7-be85-ef76f232c0dd" />



### Service Booking Page
<img width="1366" height="720" alt="Screenshot 2025-10-15 142444" src="https://github.com/user-attachments/assets/2534ff4d-8d84-4825-b94c-2b7de74e3e9c" />
<img width="1366" height="720" alt="Screenshot 2025-10-15 142833" src="https://github.com/user-attachments/assets/5e2a353e-2b9b-4fcc-a476-b96b0103b8b0" />



### Admin Dashboard

<img width="1366" height="720" alt="Screenshot 2025-10-15 142655" src="https://github.com/user-attachments/assets/ee6241be-4599-4a9c-9e44-26ed26978b9b" />


## 🔄 System Workflow

1. Customer registers and logs in.
2. Customer submits a service request.
3. Admin reviews the request.
4. Technician is assigned.
5. Service is completed.
6. Status is updated and visible to the customer.

## 🎯 Future Improvements

* Online Payment Gateway
* Email Notifications
* SMS Alerts
* Technician Tracking
* Customer Reviews & Ratings
* Mobile Application Support

## 📄 License

This project is licensed under the MIT License.

## 👤 Author

**Nasrin**

GitHub: `nasrin09042006-blip`

⭐ If you like this project, consider giving it a star on GitHub!
