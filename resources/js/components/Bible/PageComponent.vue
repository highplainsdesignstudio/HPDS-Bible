<template>
    <div class="container-fluid" v-if="book">
        <div class="row">
            <h1 class="col-12 text-center text-capitalize">{{ book + " Chapter " + chapter }}</h1>
        </div>
    
        <div class="row"  id="chapter-text">
            <leaf-component class="col-12 col-md-2 col-lg-1 sticky-top" type=-1 v-on:leaf-page="leafPage" :link="previous" title="Previous Chapter."></leaf-component>
            <div class="col-12 col-md-8 col-lg-10">
                <div v-for="(text, index) in chapterText" :key="text.id" class="v-contain">
                    <p :id=" 'verse-' + (index + 1)" class="verse"
                        v-on:click="toggleUnderline(text.id)">
                        <span class="h5">{{ index + 1 }}: </span>
                        <span v-html="text.verse" 
                            :class="{ underlined: underlines.includes(text.id), highlight: originalHighlights.includes(text.id) || highlights1.includes(text.id) }">
                        </span>
                    </p>
                </div>
            </div>
            
            <leaf-component class="col-12 col-md-2 col-lg-1 sticky" type=1 v-on:leaf-page="leafPage" :link="next" title="Next Chapter."></leaf-component>
        </div>

       <div class="row">
            <highlight-component
                class="offset-1 offset-md-2"
                :chapter-id="this.chapterText[0].chapter_id"
                :user-id="userId"
                :verses="underlines"
                v-if="underlines.length > 0"
                v-on:highlight="highlight"></highlight-component>
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
            if (this.apiToken != '') {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.apiToken}`;
                // axios.get('http://' + location.hostname + '/api/highlights', {
                axios.get('/api/highlights', {
                    params: {
                        userId: this.userId,
                        chapterId: this.chapterText[0].chapter_id
                    }
                })
                .then(response => {
                    let _highlights = response.data;
                    _highlights.forEach(element => {
                        this.originalHighlights.push(element.verse_id);

                        switch(element.color) {
                            case 1: 
                                this.highlights1.push(element.verse_id);
                                break;
                            default:
                                this.highlights1.push(element.verse_id);
                        }
                    });
                })
                .catch(exception => {
                    // console.log(exception);
                });
            }
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
            highlight: function (_chapterId, _verses, _color) {
                if (_color != '0')
                {
                    _verses.forEach(element => {
                        if (this.originalHighlights.includes(element)){
                            this.originalHighlights.splice(this.originalHighlights.indexOf(element), 1);
                        }
                        if (this.highlights1.includes(element)) {
                            this.highlights1.splice(this.highlights1.indexOf(element), 1);
                        } else {
                            switch(_color) {
                                case 1: 
                                    this.highlights1.push(element);
                                    break;
                                default:
                                    this.highlights1.push(element);
                            }
                        }
                    });
                }
                

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
                let _verse = document.getElementById('verse-' + (_index + 1));
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
        },
        // props: ['page', 'chapterText', 'loggedIn', 'apiToken', 'userId']
        props: ['apiToken', 'chapterText', 'book', 'chapter', 'previous', 'next', 'userId']
    }
</script>