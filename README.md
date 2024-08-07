<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Simple Crud App

## Introduction

Job Listing Application is designed using Laravel Blade to Post posts and comments to the website and each user can manage his own posted posts (Create, Edit, Delete). 

## Features

- **User Authentication and Authorization**

  - Register and login functionality

- **Roles and Permissions**

  
  - **Logged In User**:
    - Add, edit, delete their own posts / Add, Edit, Delete their own comments 
    - Cannot edit or delete another user's post or comments unless belongs to their own posts
  - **User**:
    - View posts
    - Add comments

- **Posts Management**

  - Add, edit, delete posts


## Setup and Installation

### Prerequisites
- PHP 8.2
- composer
- XAMPP (if you want to use MySQL database)

### Backend Setup
1. Navigate to the project directory:
   Create a `.env` file based on the `.env.example` and configure your environment variables in case MySQL
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
    OR case using sqlite just use
    ```sh
    DB_CONNECTION=sqlite
    ```
    
```sh
composer install
```

```sh
php artisan serve
```


## Contributing
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.


## Contact
For any questions or support, please contact [tarekyaghi3@gmail.com].
