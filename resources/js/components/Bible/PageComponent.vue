<template>
    <div class="container" v-if="book">
        <div class="row">
            <h1 class="col-12 text-center text-capitalize">{{ book + " Chapter " + chapter }}</h1>
        </div>
    
        <div id="chapter-text" class="row">
            <leaf-component class="col-1" type=-1 v-on:leaf-page="leafPage" :link="previous"></leaf-component>
            <div class="col-10">
                <div class="verse" v-for="(text, index) in chapterText" :key="text.id">
                    <div class="row">
                        <p :id=" 'verse-' + index" class="col-12" 
                            v-bind:class="{highlight: originalHighlights.includes(text.id) || highlights1.includes(text.id)}" 
                            v-on:click="toggleUnderline(text.id)">
                            <span class="h5">{{ index + 1 }}: </span><span v-html="text.verse" v-bind:class="{ underlined: underlines.includes(text.id) }"></span>
                        </p>
                    </div>    
                </div>
            </div>
            
            <leaf-component class="col-1" type=1 v-on:leaf-page="leafPage" :link="next"></leaf-component>
        </div>

        <!-- <div class="row">
            <highlight-component
                :chapter-id="page.chapter_id"
                :user-id="userId" 
                :verses="underlines"
                v-if="underlines.length > 0"
                v-on:highlight="highlight"></highlight-component>
            
            <div v-if="getHighlights === true"></div>
        </div> -->
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
        // computed: {
        //     getHighlights: function () {
        //         axios.get('api/highlights', {
        //             params: {
        //                 userId: this.userId,
        //                 chapterId: this.page.chapter_id
        //             }
        //         })
        //         .then(response => {
        //             let _highlights = response.data;
        //             this.originalHighlights = [];
        //             for (let i = 0; i < _highlights.length; i++) {
        //                 if (_highlights[i].color === 1) {
        //                     this.originalHighlights.push(_highlights[i].verse_id);
        //                 }
        //             }
        //             console.log('Original highlights: ', this.originalHighlights);
        //         })
        //         .catch(exception => {
        //             console.log(exception);
        //         });
        //         return true;
        //     }                
        // },
        created: function () {
            console.log(this.previous);
            console.log(this.next);
        },
        data: function () {
            return {
                originalHighlights: [],
                highlights1: [],
                underlines: []
            };
        },
        methods: {
            clearUnderlines: function () {
                this.underlines = [];
            },
            updateHighlights: function() {

            },
            highlight: function (_chapterId, _verses) {
                _verses.forEach(element => {
                    if (this.originalHighlights.includes(element)){
                        this.originalHighlights.splice(this.originalHighlights.indexOf(element), 1);
                    } else if (this.highlights1.includes(element)) {
                        this.highlights1.splice(this.highlights1.indexOf(element), 1);
                    } else {
                        this.highlights1.push(element);
                    }
                });
                this.clearUnderlines();
            },
            hideHighlightComponent: function (_index) {
                this.highlightComponentIndex = null;
            },
            leafPage: function (_type){
                this.clearUnderlines();
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
            },
            toggleUnderline: function (_index) {
                if (this.underlines.includes(_index)) {
                    this.underlines.splice(this.underlines.indexOf(_index), 1);
                } else {
                    this.underlines.push(_index);
                }
            }
        },
        mounted: function () {
            axios.defaults.headers.common['Authorization'] = `Bearer ${this.apiToken}`;
        },
        // props: ['page', 'chapterText', 'loggedIn', 'apiToken', 'userId']
        props: ['chapterText', 'book', 'chapter', 'previous', 'next']
    }
</script>