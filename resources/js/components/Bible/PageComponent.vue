<template>
    <div class="container" v-if="page.name">
        <div class="row">
            <h1 class="col-12 text-center">{{ page.name + " Chapter " + page.chapter }}</h1>
        </div>
    
        <div class="row">
            <leaf-component class="col-1" type=-1 v-on:leaf-page="leafPage"></leaf-component>
            <div class="col-10">
                <div class="verse" v-for="(text, index) in chapterText" :key="text.id">
                    <p><span class="h5">{{ index + 1 }}: </span><span v-html="text.verse"></span></p>
                </div>
            </div>
            
            <leaf-component class="col-1" type=1 v-on:leaf-page="leafPage"></leaf-component>

        </div>

        



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