#Bible App
A KJV Bible application built with Laravel.

##v0.0.2 (WIP)
* Added GetBibleController
* The main page now shows links to read the Bible
* There is now a Read page that houses a vue app.
* vue <index-component> created in the front end app. This index component 
is to be a hamburger menu that opens and closes when clicked and holds links to each 
bible book.
* The bible data has been seeded to the database.
* 

##v0.0.1 (05/20/20)
* CHANGELOG.md
* npm install && npm run dev
* composer require laravel/ui
* php artisan ui vue --auth
* php artisan storage:link
* Added create_testaments_table migration
* Added create_books_table migration
* Added create_verses_table migration
* composer dump-autoload
* Created Testament model
* Created Book model
* Created Verse model
* Created DatabaseSeeder to add bible data to the db tables