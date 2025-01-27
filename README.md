# Clouds-PHP-Technical-Task

This project is a simple Laravel-based application that allows customers to sign up and subscribe to a recurring payment plan while providing admins the ability to manage customer records.

## Features

-   **Two user types:**
    -   **Admin**
    -   **Customer**
-   **Customer Features:**
    -   Sign up with **Name**, **Email**, and **Password**.
    -   Payment form during registration to select a subscription plan (**monthly** or **yearly**).
    -   Ability to log in to the application (unless deactivated).
-   **Admin Features:**
    -   View a list of all customers.
    -   Search customers by **name** or **email**.
    -   Update, deactivate, reactivate, or delete customer records.
    -   Deactivated customers cannot log in.

## Installation and Configuration

Follow these steps to set up and run the project locally:

### Step 1: Clone the Repository

```bash
git clone git@github.com:MuhamedAly7/Clouds-technical-task.git
cd Clouds-technical-task/
```

### Step 2: Configure Environment Variables

Copy the example `.env` file:

```bash
cp .env.example .env
```

Edit the `.env` file with your Stripe credentials and product/plan IDs:

```env
STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret
STRIPE_WEBHOOK_SECRET=stripe-webhook-secret
PRODUCT_ID=product-id
MONTHLY_PLAN_ID=price-monthly-plan-id
YEARLY_PLAN_ID=price-yearly-plan-id
```

### Step 3: Stripe Setup

1. **Create a Stripe Account**
    - Obtain your `STRIPE_KEY` and `STRIPE_SECRET` from your Stripe dashboard.
2. **Install Stripe CLI**
    - Follow Stripe's documentation to install the Stripe CLI.
3. **Authenticate Stripe CLI**
    - Run:
        ```bash
        stripe login
        ```
        - Visit the link provided in the terminal to authenticate.
    - Then, run:
        ```bash
        stripe listen --forward-to http://localhost:8000/stripe/webhook
        ```
        - Copy the `STRIPE_WEBHOOK_SECRET` from the terminal output into your `.env` file.
4. **Create Stripe Product and Plans**
    - Create a product in your Stripe dashboard with two prices:
        - One for the **monthly** plan.
        - One for the **yearly** plan.
    - Copy the plan IDs into the `.env` file.

### Step 4: Install Dependencies

Install PHP dependencies:

```bash
composer install
```

### Step 5: Set Up the Database

1. Run migrations:
    ```bash
    php artisan migrate
    ```
2. Seed the database with an admin user:
    ```bash
    php artisan db:seed --class=AdminUserSeeder
    ```

### Step 6: Generate Application Key

```bash
php artisan key:generate
```

### Step 7: Build Frontend Assets

Install and build frontend dependencies:

```bash
npm install
npm run build
```

### Step 8: Serve the Application

Run the application:

```bash
php artisan serve
```

Open your browser and navigate to:

```
http://localhost:8000
```

## Usage

-   **Admin Login:** Use the seeded admin credentials from the `AdminUserSeeder`.
-   **Customer Registration:** Sign up as a customer, select a subscription plan, and log in.

## Contributing

Contributions are welcome! If you have any suggestions, feel free to create a pull request or open an issue.

## License

This project is licensed under the [MIT License](LICENSE).
