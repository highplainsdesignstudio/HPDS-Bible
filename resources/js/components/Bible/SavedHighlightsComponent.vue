<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Saved Highlights</h2>
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">

                        <div v-for="(verse, index) in highlights" :key="index">
                            <p>{{ verse.book }} Chapter {{ verse.book_chapter }} : {{ verse.chapter_verse }} - <span v-html="verse.verse"></span></p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created: function () {
            console.log(this.highlights);
        },
        props: ['highlights']
    }
</script>
