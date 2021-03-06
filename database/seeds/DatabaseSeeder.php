<?php

use Illuminate\Database\Seeder;
use App\Models\Testament;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Verse;
use App\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // First seed testaments table
        $testament = new Testament;
        $testament->testament = 'old';
        $testament->save();
        $testament = null;
        $testament = new Testament;
        $testament->testament = 'new';
        $testament->save();

        // Second, read the json file
        $bible = file_get_contents('json/KJV.json');
        $bible = json_decode($bible);

        // Third, add the book names the books table.
        $index = 1;
        $testament_id = 1;
        foreach($bible as $bookName => $chapters){
            $book = new Book;
            $book->book = $bookName;
            // If the $index <= 39, the book is in the Old testament. The rest are New Testament.
            if($index <= 39) {
                $testament_id = 1;
                // $book->testament_id = 1;
            } else {
                $testament_id = 2;
                // $book->testament_id = 2;
            }
            $book->testament_id = $testament_id;

            // Cycle through the chapters to determine the chapter count.
            $chapterCount = 0;
            foreach($chapters as $chapterIndex => $verses) {
                // While cycling through the chapters, insert the chapter into the chapters table.
                $chapter = new Chapter;
                $chapter->book_id = $index;
                $chapter->book_chapter = $chapterIndex;
                $chapter->save();

                // While cycling through chapters, insert the verses.
                foreach($verses as $chapterVerse => $verseText) {
                    $verse = new Verse;
                    $verse->testament_id = $testament_id;
                    $verse->book_id = $index;
                    $verse->chapter_id = $chapter->id;
                    $verse->chapter_verse = $chapterVerse;
                    $verse->verse = $verseText;
                    $verse->save();
                }
                $chapterCount++;
            }
            $book->chapter_count = $chapterCount;

            $book->save();
            $index++;
        }

        // Fourth, add the predefined user roles.
        $role1 = new Role;
        $role1->role = 'admin';
        $role1->save();

        $role2 = new Role;
        $role2->role = 'subscriber';
        $role2->save();

    }
}
