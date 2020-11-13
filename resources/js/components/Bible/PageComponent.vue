<template>
    <div class="container">
        <div v-if="page.name">
            <h1 class="text-center">{{ page.name + " Chapter " + page.chapter }}</h1>
        </div>
    
        <div class="verse" v-for="(text, index) in chapterText" :key="text.id">
            <p><span class="h5">{{ index + 1 }}: </span><span v-html="text.verse"></span></p>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['page', 'chapterText']
    }
</script>