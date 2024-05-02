# Todak Assesment

This API is developed using Laravel, to create a comprehensive food ordering system. The system caters to three main user roles: Customer, Restaurant Manager, and Administrator. Additionally, it incorporates authentication and offers optional dashboard views for administrators.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Admin Credentials](#Admin-Credentials)
- [Testing Stripe Payment Gateway](#testing-stripe-payment-gateway)
- [License](#license)

## Requirements

- PHP >= 8.0
- Composer >= 2.0
- Laravel Framework >= v10

## Installation

1. Clone the repository:
   
   ```bash
   git clone https://github.com/username/project.git
   ```

2. Navigate into the project directory:
   
   ```bash
   cd todak-assessment
   ```

3. Install dependencies:
   
   ```bash
   composer install
   ```

4. Copy `.env.example` to `.env` and update the necessary configuration:
   
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seeders (if applicable):
   
   ```bash
   php artisan migrate:fresh --seed
   ```

7. Serve the application:
   
   ```bash
   php artisan serve
   ```

8. Run npm dependencies:
   ```bash
   npm install
   ```

8. Visit `http://localhost:8000` in your browser to see the application.

## Admin Credentials

Below are the login credentials for different user roles in the system:

### Admin
- **Email:** admin@gmail.com
- **Password:** Admin1234

### Restaurant Managers
- **Manager 1**
  - **Email:** manager1@gmail.com
  - **Password:** Manager1234

- **Manager 2**
  - **Email:** manager2@gmail.com
  - **Password:** Manager1234

- **Manager 3**
  - **Email:** manager3@gmail.com
  - **Password:** Manager1234

### Customers
- **Customer 1**
  - **Email:** customer1@gmail.com
  - **Password:** Customer1234

## Testing Stripe Payment Gateway

You can test the Stripe payment gateway integration using the following card number:

- **Card Number:** 4242 4242 4242 4242
- **Expiry Date:** Any future date
- **CVC:** Any 3 digits
- **ZIP Code:** Any 5-digit ZIP code

This card number is used for testing purposes in Stripe's testing environment. You can use it to simulate successful payments and test various scenarios in your application.


## License

This project is licensed under the MIT - see the [LICENSE](LICENSE) file for details.
