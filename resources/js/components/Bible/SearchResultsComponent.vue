<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Search Results</div>

                    <div class="card-body">
                        <article v-for="result in searchResults" :key="result.id">
                            <p><a :href="'/' + result.book.toString() + '/' + result.book_chapter.toString() + '#' + 'verse-' + result.chapter_verse.toString()">
                                {{ result.book }} {{ result.book_chapter }}:{{ result.chapter_verse }}
                            </a>: - <span v-html="result.verse"></span></p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            searchResults: function() {
                let tmpResults = [];
                for(let i = 0; i < this.tokens.length; i++) {
                    let searchContextRegEx = new RegExp(`${this.tokens[i]}`, 'ig');
    
                    for(let j = 0; j < this.results.length; j++) {
                        tmpResults[j] = this.results[j];
                        this.results[j].verse = this.results[j].verse.replaceAll(searchContextRegEx, `<span class='search-context'>${this.tokens[i]}</span>`);
                    }
                }
                return tmpResults;
            }
        },
        created: function() {
        //     this.tokens.forEach(function(element) {
        //         let searchContextRegEx = new RegExp(`/${element}/`);
        //         this.results.forEach(function(verse) {
        //             verse.replaceAll(searchContextRegEx, `<span class='search-context'>${element}</span>`);
        //         });
        //     });
        // },
        // mounted() {
            console.log(this.tokens);
            // this.tokens.forEach(function(element) {
            //     let searchContextRegEx = new RegExp(`/${element}/`);
            //     results.forEach(function(verse) {
            //         verse.replaceAll(searchContextRegEx, `<span class='search-context'>${element}</span>`);
            //     });
            // });
            for(let i = 0; i < this.tokens.length; i++) {
                let searchContextRegEx = new RegExp(`${this.tokens[i]}`, 'ig');
                // this.results.forEach(element => {
                //     element.verse.replaceAll(searchContextRegEx, `<span class='search-context'>${this.tokens[i]}</span>`);
                // });
                for(let j = 0; j < this.results.length; j++) {
                    this.results[j].verse = this.results[j].verse.replaceAll(searchContextRegEx, `<span class='search-context'>${this.tokens[i]}</span>`);
                }
            }
        },
        props: ['tokens', 'results']
    }
</script>
