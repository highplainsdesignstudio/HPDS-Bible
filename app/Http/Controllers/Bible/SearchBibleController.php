<?php

namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verse;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchBibleController extends Controller
{
    //
    public function index(Request $request) {
        
        $query = $request->query();
        if (!isset($query['q'])) {
            return view('bible.index');
        }

        $searchTerms = Str::of($query['q'])->explode("\"");
        $tokens = Str::of($query['q'])->explode(' ');


        $altQuery = '';
        $tokens = $this->removeStopWords($tokens);

        if (count($tokens) > 1) {
            for($i=0; $i < count($tokens); $i++) {
                if($i == 0) {
                    $altQuery = $tokens[0];
                } else {
                    $altQuery .= ('%' . $tokens[$i]);
                }
    
                // $tverses[$i] = Verse::where('verse', 'LIKE', "%{$tokens[$i]}%")->get();
            }
    
            $verses = Verse::where('verse', 'LIKE', "%{$query['q']}%")
            // $verses = Verse::where('verse', 'LIKE', "%{$altQuery}%")
                // ->orwhere('verse', 'LIKE', "%{$altQuery}%")
                // ->get();
                ->paginate(25);

            if (count($verses) == 0) {
                // $verses = Verse::where('verse', 'LIKE', "%{$altQuery}%") ->get();
                $verses = Verse::where('verse', 'LIKE', "%{$altQuery}%") ->paginate(25);
                if (count($verses->items()) == 0) {
                    $tmpVerses = new Verse;
                    for($i=0; $i < count($tokens); $i++) {
                        $tverses[$i] = Verse::where('verse', 'LIKE', "%{$tokens[$i]}%")->get();
    
                    }
                    
                    foreach($tverses as $key => $tverse) {
                        $key == 0 ? $tmpVerses = $tverse : $tmpVerses = $tmpVerses->concat($tverse);
                    }
                    $tmpVerses->unique();
                    $tmpCount = count($tmpVerses);
                    $verses = new LengthAwarePaginator($tmpVerses->forPage(1, 25), $tmpCount, 25, 1);
                    // TODO: Maybe needs to sort the $tmpVerses before making the Paginator? 
                }
            }
            
            $verses->withPath("search?q={$query['q']}");

        } elseif (count($tokens) == 1) {
            $verses = Verse::where('verse', 'LIKE', "%{$tokens[0]}%")
                // ->get();
                ->paginate(25);
            $verses->withPath("search?q={$query['q']}");
        } else {
            $verses = [];
        }

        return view('bible.search-results', ['q' => $query['q'],'tokens' => $tokens, 'verses' => $verses]);
    }

    private function removeStopWords ($tokens) {
        $stopWords = [
            "a",
            "about",
            "above",
            "after",
            "again",
            "against",
            "all",
            "am",
            "an",
            "and",
            "any",
            "are",
            "aren't",
            "as",
            "at",
            "be",
            "because",
            "been",
            "before",
            "being",
            "below",
            "between",
            "both",
            "but",
            "by",
            "can't",
            "cannot",
            "could",
            "couldn't",
            "did",
            "didn't",
            "do",
            "does",
            "doesn't",
            "doing",
            "don't",
            "down",
            "during",
            "each",
            "few",
            "for",
            "from",
            "further",
            "had",
            "hadn't",
            "has",
            "hasn't",
            "have",
            "haven't",
            "having",
            "he",
            "he'd",
            "he'll",
            "he's",
            "her",
            "here",
            "here's",
            "hers",
            "herself",
            "him",
            "himself",
            "his",
            "how",
            "how's",
            "i",
            "i'd",
            "i'll",
            "i'm",
            "i've",
            "if",
            "in",
            "into",
            'is',
            "isn't",
            "it",
            "it's",
            "its",
            "itself",
            "let's",
            "me",
            "more",
            "most",
            "mustn't",
            "my",
            "myself",
            "no",
            "nor",
            "not",
            "of",
            "off",
            "on",
            "once",
            "only",
            "or",
            "other",
            "ought",
            "our",
            "ours",
            "ourselves",
            "out",
            "over",
            "own",
            "same",
            "shan't",
            "she",
            "she'd",
            "she'll",
            "she's",
            "should",
            "shouldn't",
            "so",
            "some",
            "such",
            "than",
            "that",
            "that's",
            "the",
            "their",
            "theirs",
            "them",
            "themselves",
            "then",
            "there",
            "there's",
            "these",
            "they",
            "they'd",
            "they'll",
            "they're",
            "they've",
            "this",
            "those",
            "through",
            "to",
            "too",
            "under",
            "until",
            "up",
            "very",
            "was",
            "wasn't",
            "we",
            "we'd",
            "we'll",
            "we're",
            "we've",
            "were",
            "weren't",
            "what",
            "what's",
            "when",
            "when's",
            "where",
            "where's",
            "which",
            "while",
            "who",
            "who's",
            "whom",
            "why",
            "why's",
            "with",
            "won't",
            "would",
            "wouldn't",
            "you",
            "you'd",
            "you'll",
            "you're",
            "you've",
            "your",
            "yours",
            "yourself",
            "yourselves"
        ];
        $new = [];
        for ($i = 0; $i < count($tokens); $i++) {
            array_push($new, $tokens[$i]);
            foreach ($stopWords as $stopWord) {
                if ($tokens[$i] == $stopWord) {
                    array_pop($new);
                    break;
                }
            }
        }
        return $new;
    }
}
