# Bible App
A KJV Bible application built with Laravel.
## v1.0.2 (wip)
## Eighth commit (02/04/2021)
* Removed stopwords from SearchBibleController.
* Minor code cleanup.
* npm run prod
### Seventh commit (02/03/2021)
* Added check to SearchBibleController to prevent queries of empty space. The user is now returned to the bible.index view.
* Changed the search-results view to include the SearchResultsComponent. Modified the component to display the search results.
* Added Pagination to the SearchBibleController and the SearchVersesController.
* The search query is now the value for the search field in the SearchComponent. This let's the user know what they searched for when search results are displayed.
* The searched query words are now highlighted in the search results.

### Sixth commit (02/01/2021)
* Added comments to sort through the getSearch method in the SearchComponent. It has  become a large method that needs to be consolidated.
* The SearchVerseController works better now. The &and= data still needs to be processed though.
* The &and= data is now processed. The search function appears to be ready for testing and rollout.

### Fifth commit (01/31/2021)
* More work on reqular expressions in the Vue Search Component.
* The frontend Vue Searh Component can now detect multiple verse and create a proper url to search for multiple verses when using , and - in the notations.
* The frontend is disconnected from the backend when searching for verses in the format of:  1 Book 1:1, 2-3

### Fourth commit (01/30/2021)
* Added regular expressions in the Vue Search Component to determine if verses were entered.
* Created /verse route.
* Created SearchVerseController.
### Third commit (01/27/2021)
* Added link targets in the search-results view. 
* Added style to highlight the targeted verse.

### Second commit (01/26/2021)
* added relationships to the Testament, Book, Chapter, and Verse models.
* Added URI encoding to the search redirect href.
* Changed the SearchBibleController to search for more results. 
* Changed search-results template to show each verse and the number of results.

### First commit (01/24/2021)
* npm run dev 
* Created SearchBibleController
* Created Search Component.
* Created Search Results view.
* The search results view currently only dd's the returned results.

## v1.0.1 (01/22/2021)
### Second commit (01/22/2021)
* Created a Dashboard Controller
* Added a table to the Dashboard View to show every user in the database.
* code cleanup.

### First commit (01/21/2021) 
#### Hotfix for production
* npm run dev = this puts the app back into development mode.
* Placed the app div in the index view inside of a container-fluid instead of container. This fixes the size of the index component.
* Created the Role model and seeded the database with an admin and a subscriber role.
* Created the /dashboard route and guarded to only admin users.
* Register Controller updated to set the role id of each new registered user to 2, which is subscriber. Currently, an admin user must be made via an sql statement to the database.
* A Dashboard view has been created to be displayed at the /dashboard route.
* added z-index and background color to the navigation dropdown menu when logged in.
* npm run prod for hotfix. Hotfix is due to the dropdown styles in the app.blade file.

## v1.0.0 (01/19/2021)
### Fourth commit (01/19/2021)
* npm run prod
* v1.0.0 ready for deployment.
* HPDS Bible licensed under MIT License.

### Third commit (1/18/2021)
* Fixed bug that didn't show bible open icon in the index component.
* Index Component changed to use Bootstraps dropdown menus. This fixes the problem of rendering the chapters when the book was selected.
* Index component also styled different and splits the old and new testaments into columns instead of rows. 

### Second commit (01/08/2021)
* More changes to facilitate a secure public installation.

### First commit (01/07/2021)
* Setup for public installation.
* Added some installation steps to the Readme.md and removed Laravel information.

## v0.0.6 (01/05/2021)
### Fourth commit (01/05/2021) 
* removed hard coded hostname from the javascript front end. Replaced with location.hostname or php equivilant


### Third commit (01/03/2021)
* Code cleanup.
* Style changes.
* Added an "x" to the Highlight component in order to clear all the underlines.
* Footer added.

### Second commit (12/28/2020)
* The Welcome view now conforms with the rest of the site.
* Several images were (temporarily) added for the Welcome view.

### First commit (12/23/2020)
* Style changes for responsive design.
* Code cleanup.

## v0.0.5 (12/21/2020)
### Eigth commit (12/21/2020)
* The Highlights Component was added to show highlights on each chapter.
* The Highlights Controller has been updated to send proper information to the front end. 
* The Home page now shows all of the user's highlights.
* Requests to books/chapters that don't exist now abort with a 404 error.
* Some code clean up.

### Seventh commit (12/21/2020)
* Small style changes and other code clean up.
* New Bible.page view created to accommodate the chapter text.
* The Bible.index view now only shows a Vue Index Component that allows the user to navigate to a chapter.
### Sixth commit (12/20/2020)
* GetBibleController changed to added to return previous and next chapters when the bible text is retrieved.
* LeafComponent added.

### Fifth commit (12/19/2020)
* Major structural redesign for both back and front ends.
* The frontend Bible is now mostly PHP orientated.
* Web routes added to accomadate new design.
* The app now refreshes for every chapter. This is a major redesign.
* Changes to the Vue components.

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

