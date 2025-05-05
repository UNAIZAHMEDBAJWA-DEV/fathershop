# Fathershop Project

## Description
Fathershop is a Laravel-based web application that allows you to manage email campaigns, filter customers, and send bulk emails with tracking.

## Installation

### Prerequisites
Make sure you have the following installed on your machine:

- [PHP](https://www.php.net/downloads) (version 7.4 or above)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/docs) (for Laravel-specific commands)
- [XAMPP](https://www.apachefriends.org/index.html) or any local development environment

### Steps to Install:

1. **Clone the repository**:

    Open your terminal and run the following command to clone the repository:

    ```bash
    git clone https://github.com/UNAIZAHMEDBAJWA-DEV/fathershop.git
    ```

2. **Navigate to the project folder**:

    ```bash
    cd fathershop
    ```

3. **Install dependencies**:

    Run Composer to install the required dependencies:

    ```bash
    composer install
    ```

4. **Set up environment variables**:

    Copy the `.env.example` file to a new `.env` file:

    ```bash
    cp .env.example .env
    ```

    Now, open the `.env` file and set your database and mailer credentials.

    For example:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=fathershop_db
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.sendgrid.net
    MAIL_PORT=587
    MAIL_USERNAME=apikey
    MAIL_PASSWORD=your_sendgrid_api_key_here
    MAIL_ENCRYPTION=tls
    ```

5. **Generate the application key**:

    Run the following command to generate the app key:

    ```bash
    php artisan key:generate
    ```

6. **Run Migrations** (Optional):

    If your project uses a database, run the migrations:

    ```bash
    php artisan migrate
    ```

    This will create the required tables in your database.

7. **Serve the application**:

    You can now run the application locally using:

    ```bash
    php artisan serve
    ```

    The app will be available at `http://127.0.0.1:8000`.

---

## Usage

### Create Campaign

To create a new email campaign, make a `POST` request to the following endpoint:



