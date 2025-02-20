# Laravel Student Management System

This is a Laravel 10+ based **Student Management System** with **CRUD operations**, **API endpoints**, and **authentication using Laravel Sanctum**.

---
## Features
- **Student Management** (Add, Edit, Delete, View)
- **Course Management** (Assign courses to students)
- **REST API** for managing students
- **Authentication with Laravel Sanctum** (Register, Login, Logout)

---
## Installation Steps

### **1. Clone the Repository**
```sh
  git clone https://github.com/your-repo/student-management.git
  cd student-management
```

### **2. Install Dependencies**
```sh
  composer install
  npm install && npm run dev
```

### **3. Configure Environment**
Copy the example environment file:
```sh
  cp .env.example .env
```

Update the `.env` file with your database credentials:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### **4. Run Migrations & Seeders**
```sh
  php artisan migrate --seed
```

### **5. Generate Application Key**
```sh
  php artisan key:generate
```

### **6. Serve the Application**
```sh
  php artisan serve
```

---
## **API Endpoints**

### **Authentication Endpoints**
#### Register
```http
POST /api/user/register
```
**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

#### Login
```http
POST /api/user/login
```
**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

#### Logout (Requires Authentication)
```http
POST /api/user/logout
```
**Headers:**
```http
Authorization: Bearer {token}
```

### **Student API (Requires Authentication)**
#### Get All Students
```http
GET /api//students
```

#### Get a Single Student
```http
GET /api/students/{id}
```

#### Create a New Student
```http
POST /api/students
```
**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com"
}
```

#### Update Student
```http
PUT /api/students/{id}
```
**Request Body:**
```json
{
  "name": "Updated Name",
  "email": "updated@example.com"
}
```

#### Delete Student
```http
DELETE /api/students/{id}
```


