# About
The HPDS Bible is a web application created using the [Laravel](https://laravel.com/) framework. 
The application allows users to navigate and read the full King James version of the Bible. It also allows 
users to highlight verses. Users can create accounts in order to save their highlights. 
This project was started with the goal of helping users study the bible. The developer would like to convey
to anyone reading this text that the Bible is the most important historical document in existence. Understanding
the Bible is key to salvation from the coming world events.

# Requirements
* PHP 7.1 or higher
* Composer
* Node.js
* MySQL / MariaDB server
* SMTP host account for sending emails.

# Installation
* Configure .env file
* Run composer install: php composer install
* Generate key: php artisan key:generate
* Run migrations: php artisan migrate
* Seed database: php artisan db:seed
* Install npm dependencies: npm install
* Build npm production: npm run prod
* Build development: npm run dev

## License
* The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
* The HPDS Bible is open-sourced software license under the [MIT license](https://opensource.org/licenses/MIT).