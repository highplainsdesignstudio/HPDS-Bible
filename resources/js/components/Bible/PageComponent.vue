<template>
    <div class="container" v-if="page.name">
        <div>
            <h1 class="text-center">{{ page.name + " Chapter " + page.chapter }}</h1>
        </div>
    
        <div class="verse" v-for="(text, index) in chapterText" :key="text.id">
            <p><span class="h5">{{ index + 1 }}: </span><span v-html="text.verse"></span></p>
        </div>

        <leaf-component type=-1 v-on:leaf-page="leafPage"></leaf-component>
        <leaf-component type=1 v-on:leaf-page="leafPage"></leaf-component>


    </div>
</template>

<script>
    export default {
        methods: {
            leafPage: function (_type){
                this.$emit('leaf-page', _type);
            }
        },
        props: ['page', 'chapterText']
    }
</script>