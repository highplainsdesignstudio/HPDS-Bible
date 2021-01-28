<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search Results</div>

                    <div class="card-body">
                        {{ results }} search results found.
                        <article v-for="result in results" :key="result.id">
                            <!-- <p>{{ result.chapter.book.book }} {{ result.chapter.book_chapter }}:{{ result.chapter_verse }} - <span :v-html="result.verse"></span></p> -->
                            <!-- <p>{{ result.chapter.book_chapter }}:{{ result.chapter_verse }} - <span :v-html="result.verse"></span></p> -->
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.results);
        },
        props: ['results']
    }
</script>
