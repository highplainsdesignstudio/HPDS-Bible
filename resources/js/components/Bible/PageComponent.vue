<template>
    <div class="container" v-if="page.name">
        <div class="row">
            <h1 class="col-12 text-center">{{ page.name + " Chapter " + page.chapter }}</h1>
        </div>
    
        <div class="row">
            <leaf-component class="col-1" type=-1 v-on:leaf-page="leafPage"></leaf-component>
            <div class="col-10">
                <div class="verse" v-for="(text, index) in chapterText" :key="text.id">
                    <!-- <div class="row" v-on:mouseover="toggleHighlightComponent(index)" v-on:mouseout="toggleHighlightComponent(index)"> -->
                    <div class="row" v-on:click="showHighlightComponent(index)">
                        <p :id=" 'verse-' + index" class="col-12"><span class="h5">{{ index + 1 }}: </span><span v-html="text.verse"></span></p>
                        
                        <div :id="'highlight-component-' + index" class="col-3 d-none">
                            <div v-if="loggedIn == true">
                                <highlight-component :verse-id="text.id" :user-id="userId"></highlight-component>
                            </div>
                            <div v-else>
                                <a href="/login">Log in</a> to save verses.
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            
            <leaf-component class="col-1" type=1 v-on:leaf-page="leafPage"></leaf-component>

        </div>
    </div>
</template>

<script>
    import LeafComponent from './LeafComponent.vue';
    import HighlightComponent from './HighlightComponent.vue';

    export default {
        components: {
            'leaf-component': LeafComponent,
            'highlight-component': HighlightComponent
        },
        created: function () {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.apiToken}`;
        },
        data: function () {
            return {
                highlightComponentIndex: null
            };
        },
        methods: {
            hideHighlightComponent: function (_index) {
                this.highlightComponentIndex = null;
            },
            leafPage: function (_type){
                this.$emit('leaf-page', _type);
            },
            showHighlightComponent: function (_index) {
                if (this.highlightComponentIndex === null) {
                    this.toggleHighlightComponent(_index);
                    this.highlightComponentIndex = _index;
                } else if (this.highlightComponentIndex !== _index) {
                    this.toggleHighlightComponent(this.highlightComponentIndex);
                    this.toggleHighlightComponent(_index);
                    this.highlightComponentIndex = _index;
                } else if (this.highlightComponentIndex === _index) {
                    this.toggleHighlightComponent(_index);
                    this.highlightComponentIndex = null;
                }
            },
            toggleHighlightComponent: function (_index) {
                let _verse = document.getElementById('verse-' + _index);
                let _verseClasses = _verse.classList;
                _verseClasses.toggle('col-9');
                _verseClasses.toggle('col-12');

                let _highlightComponent = document.getElementById("highlight-component-" + _index);
                let _componentClasses = _highlightComponent.classList;
                _componentClasses.toggle('d-none');
            }
        },
        mounted: function () {
            console.log(this.apiToken);
            axios.get('api/highlights')
            .then(response => {
                console.log(response);
            });
        },
        props: ['page', 'chapterText', 'loggedIn', 'apiToken', 'userId']
    }
</script>