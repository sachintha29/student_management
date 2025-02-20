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
GET /api/user/students
```

#### Get a Single Student
```http
GET /api/user/students/{id}
```

#### Create a New Student
```http
POST /api/user/students
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
PUT /api/user/students/{id}
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
DELETE /api/user/students/{id}
```


API Endpoints
Authentication Routes
Method	Endpoint	Description	Authentication Required
POST	/api/user/register	Register a new user	❌ No
POST	/api/user/login	Login and get token	❌ No
POST	/api/user/logout	Logout the user	✅ Yes
Student Management Routes (auth:sanctum required)
Method	Endpoint	Description	Authentication Required
GET	/api/students	List all students	✅ Yes
POST	/api/students	Create a new student	✅ Yes
GET	/api/students/{id}	Get a specific student	✅ Yes
PUT	/api/students/{id}	Update a student	✅ Yes
DELETE	/api/students/{id}	Delete a student	✅ Yes
Authentication Usage
Register
Send a POST request to /api/user/register with:

json
Copy
Edit
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
Login
Send a POST request to /api/user/login with:

json
Copy
Edit
{
  "email": "john@example.com",
  "password": "password123"
}
Response:


{
  "user": { "id": 1, "name": "John Doe", "email": "john@example.com" },
  "token": "your-access-token"
}
Use this token for authenticated requests in the Authorization header:


Authorization: Bearer your-access-token

