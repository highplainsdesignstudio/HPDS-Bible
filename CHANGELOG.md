# Bible App
A KJV Bible application built with Laravel.
## v0.0.5 (wip)
### Fourth commit (12/19/2020)
* Implemented soft deletes to the Highlight model.
* Made changes to the HighlightComponent. Now, there is only one HighlightComponent that manages the function
of saving highlights. 
* The user can now click verses to underline and to remove underlines. 
* Decided to go a different route on the design of the site. Committing before major changes.

### Third commit (12/16/2020)
* Added a Highlight model and migration.
* The HighlightedVerses controller has been renamed to HighlightController.
* Minor code cleanup.
* The HighlightComponent now saves or deletes a highlighted verse in the database.

### Second commit (12/15/2020)
* Removed the Vue form app instance. It was unecessary.
* <strike>HighlightComponent now shows up when the user mouseover's the verse and disappears on mouseout. If the user is not logged in,
the user gets a message to log in to save verses.</strike>
* The HighlightComponent now appears when the user clicks on the verse. It disappears if the user clicks a different verse or the same verse twice.
* The 'verses' database table has been updated to include a 'chapter_verse' column. The migration and databaseseeder have been updated.
* Added the HighlightedVerses controller resource.
* Updated the Login and Logout control methods in order to create/delete Sanctum api key after logging in and logging out.
The backend is now complete for the API key generation. The front end now has a temporary call to a backend api test route. 
Additional API routes can now be added using the Sanctum middleware.

### First commit (12/11/2020)
* Installed Laravel Sanctum via composer.
* Set up the work for a Highlight Component that will serve as the component that will save verses for users that are logged in.

## v0.0.4 (11/28/2020)
## Fifth Commit (11/28/2020)
* Changes made to the user dashboard.
* Changes made to the navigation dropdown links.
* Removed book name from parameters from selectPage method on app object.
* Cookies are now used to remember the last selectedPage. When a user navigates to the Bible route, 
the front end checks for cookies to determine the saved book id and chapter.
### Fourth Commit (11/26/2020)
* All components are now registered locally. 

### Third Commit (11/26/2020)
* The leaf components have been stylized into buttons. 

### Second Commit (11/24/2020)
* Updated the DatabaseSeeder to use the chapter_id to the verses table. This id is the 
chapter count in which it appears in the whole Bible, and not just the numbered chapter within each book.
* The create verses migration now creates a column called chapter_id instead of chapter. This id is a foreign 
key to the chapters table.
* The GetBibleController now returns the chapter_id properly to the vue frontend.
* The leaf components have been put into place and the user can now traverse chapters by clicking
the components. One is for the previous chapter, and the other is for the next chapter. 

### First Commit (11/23/2020)
* Added a <leaf-component> that will serve as the component to go to the previous
or next chapters.
* Added a Chapter model in order to add every chapter to the database.
* Updated the database seeder to add the chapters to the database.
* Added source maps to the webpack.mix.js file to assist with debugging.
* Moved the fetch api/books processing from the index component to the app component.

## v0.0.3 (11/22/2020)
* Updated some node packages.
* Added routes to handle user registration email verification.
* Added the KJV.json.
* Minor changes to frontend components. 
* Moved to new repository location for future development.

## v0.0.2 (11/13/2020)
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

## v0.0.1 (05/20/20)
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

