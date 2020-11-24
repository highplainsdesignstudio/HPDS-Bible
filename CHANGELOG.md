#Bible App
A KJV Bible application built with Laravel.
##v0.0.4 (wip)
###First Commit (11/23/2020)
##v0.0.3 (11/22/2020)
* Added a <leaf-component> that will serve as the component to go to the previous
or next chapters.
* Added a Chapter model in order to add every chapter to the database.
* Updated the database seeder to add the chapters to the database.
* Added source maps to the webpack.mix.js file to assist with debugging.
* Moved the fetch api/books processing from the index component to the app component. 

* Updated some node packages.
* Added routes to handle user registration email verification.
* Added the KJV.json.
* Minor changes to frontend components. 
* Moved to new repository location for future development.

##v0.0.2 (11/13/2020)
* Added GetBibleController
* The main page now shows links to read the Bible
* There is now a Read page that houses a vue app.
* vue <index-component> created in the front end app. This index component 
is to be a hamburger menu that opens and closes when clicked and holds links to each 
bible book.
* The bible data has been seeded to the database.
* A bible icon has been added to toggle open an index listing.
* <page-component> created to house the chapter text.
* Updated Laravel from v7 to v8.14.0

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

