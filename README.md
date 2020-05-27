## Flor2u PHP Test (Laravel)
Тестовое задание соискателя на вакантную должность PHP-программиста.

### [Тестовое задание](https://github.com/DanilaGegele/HR-php-test)
* На ларавел следует сделать API
* На фронте применить vue.js

### Install

Requirements - https://laravel.com/docs/7.x/installation#server-requirements

* Клонируем репозиторий
    ```bash
    git clone https://github.com/vladmeh/flor2u-php-test.git
    cd flor2u-php-test
    rm -rf .git
    ```
* Устанавливаем зависимости PHP
    ```bash
    composer install
    ```
* Устанавливаем зависимости JS и CSS
    ```bash
    npm install
    ```
    or
    ```bash
    yarn install
    ```

### Setting
* Переименовываем `.env.example` в `.env`
* Настраниваем `.env` (соединение с БД)
* Генерируем ключ, выполняем миграцию, заполняем БД
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    ```
* На всякий случай обновляем конфигурацию и зависимости
    ```bash
    composer dumpautoload
    php artisan config:cache
    ```

### Run
* Запускаем сервер
    ```bash
    php artisan serve
    ```
* Открываем браузер по ссылке `http://localhost::8000`

#### My Implementation Stack:
* PHP XAMPP 7.3.9
* Laravel 7.13.0
* SQLite 3