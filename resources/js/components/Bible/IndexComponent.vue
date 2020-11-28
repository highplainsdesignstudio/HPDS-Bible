<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header sticky" v-on:click="toggleIndex" style="cursor:pointer; background-color:white; z-index:10;">
                        <div class="d-inline" id="index-menu" >
                            <img src="img/bibleclosedIcon.png" alt="bible icon" id="bible-icon" style="width:64px">
                        </div>
                        <span class="h5">Bible Book List</span>
                        <span id="down-caret">
                            <svg class="bi bi-caret-down-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
                            </svg>
                        </span>
                        <span id="up-caret" class="d-none">
                            <svg class="bi bi-caret-up-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                            </svg>
                        </span>
                    </div>
                    
                    <div class="row">
                        <div class="card-body d-none col-12" id="index-card">
                            <div class="row">
                                <div class="col-12">
                                    <!-- TODO: Fix up the index to use 1 component instead of duplicating the code. -->
                                    <span class="h5">Old Testament</span>
                                    <ul class="list-unstyled list-inline">
                                        <li v-for="book in oldTestament" v-bind:key="book.id" class="h6 list-inline-item">
                                            <a href="#" v-on:click="selectBook(book.id)"> <u>{{ book.book }}</u> |</a>
                                            <div class="chapter-select d-none" :id="'chapters-' + book.id">
                                                <span v-for="chapter in book.chapter_count"
                                                    class="chapter-select-number"
                                                    v-bind:key="chapter"
                                                    v-on:click="selectPage(book.id, chapter)"> <u>{{chapter}}</u> | </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <span class="h5">New Testament</span>
                                    <ul class="list-unstyled list-inline">
                                        <li v-for="book in newTestament" v-bind:key="book.id" class="h6 list-inline-item">
                                            <a href="#" v-on:click="selectBook(book.id)"> <u>{{ book.book }}</u> | </a>
                                            <div class="chapter-select d-none" :id="'chapters-' + book.id">
                                                <span v-for="chapter in book.chapter_count" 
                                                    class="chapter-select-number"
                                                    v-bind:key="chapter"
                                                    v-on:click="selectPage(book.id, chapter)"> <u>{{chapter}}</u> |</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //TODO: Currently, the IndexComponent is responsible for retrieving the list of books from the database.
        // This should be done within the app component instead of this component. The list of books should then be
        // passed as a prop to this component.
        // created: function() {
        //     fetch('api/books')
        //     .then(response => response.json())
        //     .then(data => {
        //         this.books = data;
        //     });
        // },
        // data: function() {
        //     return {
        //         books: null
        //     }
        // },
        computed: {
            oldTestament: function() {
                let _old = [];
                if(this.books) {
                    this.books.forEach(element => {
                        if(element.testament_id === 1) {
                            _old.push(element);
                        }
                    });
                }
                return _old;
            },
            newTestament: function() {
                let _new = [];
                if(this.books) {
                    this.books.forEach(element => {
                        if(element.testament_id === 2) {
                            _new.push(element);
                        }
                    });
                }
                return _new;
            }
        },
        methods: {
            selectBook: function(_id) {           
                let _chapters = document.getElementById('chapters-' + _id);
                _chapters.classList.toggle('d-none');
                this.selectedBook = _id;
                this.toggleChapters(_id);            
            },
            selectPage: function(_book_name, _book_id, _chapter) {
                this.toggleIndex();
                this.$emit("select-page", _book_name, _book_id, _chapter);
            },
            toggleChapters: function(_id) {
                for(var i = 1; i <= 66; i++) {
                    let _element = document.getElementById('chapters-' + i);
                    if(i != _id) {
                        _element.classList.add('d-none');
                    }
                } 
            },
            toggleIndex: function(_event) {
                let _bibleIcon = document.getElementById('bible-icon');
                let _indexCard = document.getElementById('index-card');
                let _downCaret = document.getElementById('down-caret');
                let _upCaret = document.getElementById('up-caret');

                let _src = 'http://' + window.location.hostname + '/img/bibleclosedIcon.png';
                if (_bibleIcon.src === _src) {
                    _bibleIcon.src = 'img/bibleopenIcon.png';
                } else {
                    _bibleIcon.src = 'img/bibleclosedIcon.png';
                }
                _indexCard.classList.toggle('d-none');
                _downCaret.classList.toggle('d-none');
                _upCaret.classList.toggle('d-none');
                this.toggleChapters(null);
            }
        },
        props: ["books"]
    }
</script>