<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to Install and Run the E-Learning Platform

This project is an e-learning platform built with Laravel that incorporates Role-Based Access Control (RBAC) to manage different user types: Admin, Teacher, and Student. The system supports CRUD operations for core features such as courses, quizzes, assignments, and student progress tracking.

### Prerequisites

Before you begin, ensure you have the following installed on your system:

* PHP (version 8.3.16 or higher is recommended)
* Composer
* MySQL (version 8.4.3 or higher is recommended)
* Node.js and npm (or Yarn)

### Installation Steps

1.  **Clone the Repository:**
    First, clone the project repository from GitHub:
    ```bash
    git clone [https://github.com/jeayuun/E-Learning-Platform.git](https://github.com/jeayuun/E-Learning-Platform.git)
    cd E-Learning-Platform
    ```

2.  **Install Composer Dependencies:**
    Install the PHP dependencies using Composer:
    ```bash
    composer install
    ```

3.  **Set Up Environment File:**
    Copy the example environment file and generate an application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure Database:**
    Open the newly created `.env` file and update the database connection details. Ensure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` are correctly set for your MySQL database.

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

5.  **Run Database Migrations and Seeders:**
    Execute the migrations to create the necessary tables in your database. The `--seed` flag will also run the database seeders, which can be used to populate initial data (like roles and a default admin user).
    ```bash
    php artisan migrate --seed
    ```
    *Note: The `spatie/laravel-permission` package is used for RBAC and is set up during seeding or through a dedicated controller to define roles and permissions.* 

6.  **Install Node Dependencies and Compile Assets:**
    Install the frontend dependencies using npm and compile the assets using Vite:
    ```bash
    npm install
    npm run dev
    # Or for production:
    # npm run build
    ```
    *Tailwind CSS and Bootstrap are used for styling, and Vite is used for asset bundling.* 

7.  **Start the Laravel Development Server:**
    Finally, start the local development server:
    ```bash
    php artisan serve
    ```

    This will typically start the server at `http://127.0.0.1:8000`. You can access the application in your web browser at this address.

### Default User Roles (if seeded)

If the database was seeded, you might have default accounts for each role:

* **Admin:** Full access to manage users, courses, quizzes, and assignments.
* **Teacher:** Can create and manage courses, view student progress, and handle assignments and quizzes. 
* **Student:** Can enroll in courses, view course materials, and submit assignments.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).