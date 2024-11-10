
# LaraManage Project Setup Guide

This guide will help you set up the LaraManage project with step-by-step instructions. Follow each command in order to ensure a smooth setup.

---

## Prerequisites

Ensure you have the following installed:

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/downloads)
- [MySQL](https://www.mysql.com/downloads/)

---

## Steps

### 1. Clone the Repository

Clone the LaraManage project from GitHub by running the following commands in your terminal:

```bash
git clone https://github.com/Tetrafarmakos/LaraManage.git
cd LaraManage
```

### 2. Install Dependencies

Once inside the project directory, use Composer to install the necessary dependencies:

```bash
composer install
```

### 3. Set Up Environment Variables

1. Rename the `.env.example` file to `.env`:

   ```bash
   mv .env.example .env
   ```

2. Generate a unique application key for Laravel:

   ```bash
   php artisan key:generate
   ```

### 4. Configure Database Settings

1. Open the `.env` file in a text editor and update the database credentials with your MySQL information:

   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

2. Create a MySQL database that matches the name specified in the `DB_DATABASE` value in your `.env` file or in `config/database.php`.

3. Create a MySQL test database laramanage_testing that matches the name in `phpunit.xml`.

### 5. Run Database Migrations

Run the migrations to create the necessary tables in the database:

```bash
php artisan migrate
```

### 6. Seed the Database (For Users,Roles and Permissions)

To add initial data to the database, run the seeder:

```bash
php artisan db:seed
```

### 7. Configure Queue Driver

1. Open the `.env` file and set up the queue driver according to your preferred configuration. Common choices include `database` and `redis`.
2. After configuring the queue driver, start the queue worker to handle background jobs:

   ```bash
   php artisan queue:work
   ```

---

This guide covers all steps needed to set up the LaraManage project. Enjoy coding!
