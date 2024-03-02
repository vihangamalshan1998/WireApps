# Pharmacy Management System

This project is a RESTful API built with Laravel for managing a pharmacy's business processes including authentication, medication inventory management, and customer record management.

## Getting Started

To run this project locally, follow these steps:

### Prerequisites

- PHP >= 7.4
- Composer
- SQLite (or any other supported database by Laravel)

### Installation

1. Clone this repository:
2. Navigate to the project directory:
3. Install dependencies:
3. Install dependencies:
4. Copy the .env.example file to .env:
5. Generate application key:
6. Update the database settings in the .env file according to your local environment.
7. Migrate the database:
8. Seed the database with mock data:
9. ```bash(for add passport)
   php artisan passport:install

### Running the Server

To start the Laravel development server, run the following command:


The API will be accessible at http://localhost:8000 by default.

## Endpoints

The following endpoints are available:

- Authentication:
  - POST /api/login

- Medication Inventory Management:
  - GET /api/medications
  - GET /api/medications/{id}
  - POST /api/medications
  - PUT /api/medications/{id}
  - DELETE /api/medications/{id}

- Customer Record Management:
  - GET /api/customers
  - GET /api/customers/{id}
  - POST /api/customers
  - PUT /api/customers/{id}
  - DELETE /api/customers/{id}

## User Roles

- Owner: Can perform CRUD operations and permanent deletion of records.
- Manager: Can update and soft delete records but cannot insert or permanently delete.
- Cashier: Can update records but cannot insert or delete.

## Testing

You can use the provided Postman collection for testing the API endpoints.

Email: admin@gmail.com, Password: secret    (Admin)
Email: manager@gmail.com, Password: secret  (Manager)
Email: cashier@gmail.com, Password: secret  (Cashier)
