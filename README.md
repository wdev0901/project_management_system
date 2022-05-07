## Project Management Web App

## Setup

- Clone repository
  ```
  git clone https://github.com/wdev0901/project_management_system.git
  ```
- Create '.env' file from sample '.env.example'
- Update DB credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD etc)
- Open terminal and run 
  - `composer install`
  - `php artisan key:generate`
  - `php artisan migrate --seed`
  - `php artisan serve`
- Navigate to 'localhost:8000' and see application is running

## Login Info
  ```
    email: admin@admin.com
    password: password
  ```

