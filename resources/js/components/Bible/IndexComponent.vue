<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header sticky-top" style="background-color:white; z-index:1001;">
                        <button class="h5 btn btn-primary" v-on:click="toggleIndex" style="cursor:pointer;">
                            <span class="d-inline" id="index-menu" >
                                <img src="/img/bibleclosedIcon.png" alt="bible icon" id="bible-icon" style="width:64px">
                            </span>
                            Bible Book List 
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
                        </button>
                    </div>
                    
                <div class="row">
                        <div class="card-body d-none col-12" id="index-card">
                            <div class="row">
                                <div class="col-6">
                                    <span class="h5">Old Testament</span>
                                    <ul class="list-unstyled">
                                        <li v-for="book in oldTestament" v-bind:key="book.id">
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton" 
                                                    data-toggle="dropdown" 
                                                    aria-haspopup="true" 
                                                    aria-expanded="false"
                                                    style="width: 100%;">
                                                    {{ book.book }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <span v-for="chapter in book.chapter_count"
                                                        class="chapter-select-number"
                                                        v-bind:key="chapter">
                                                        <a :href="hostname + book.book + '/' + chapter">{{chapter}}</a> | 
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <span class="h5">New Testament</span>
                                    <ul class="list-unstyled">
                                        <li v-for="book in newTestament" v-bind:key="book.id">
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" 
                                                    type="button" id="dropdownMenuButton" 
                                                    data-toggle="dropdown" 
                                                    aria-haspopup="true" 
                                                    aria-expanded="false"
                                                    style="width: 100%;">
                                                    {{ book.book }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <span v-for="chapter in book.chapter_count"
                                                        class="chapter-select-number"
                                                        v-bind:key="chapter">
                                                        <a :href="hostname + book.book + '/' + chapter">{{chapter}}</a> | 
                                                    </span>
                                                </div>
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
        computed: {
            hostname: function() {
                return 'http://' + location.hostname + '/';
            },
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

        // data: function () {
        //     return {
        //        
        //     }
        // },
        methods: {
            toggleIndex: function(_event) {
                let _bibleIcon = document.getElementById('bible-icon');
                let _indexCard = document.getElementById('index-card');
                let _downCaret = document.getElementById('down-caret');
                let _upCaret = document.getElementById('up-caret');

                if (_bibleIcon.src === 'http://' + location.hostname + '/img/bibleclosedIcon.png' || _bibleIcon.src === 'https://' + location.hostname + '/img/bibleclosedIcon.png') {
                    _bibleIcon.src = '/img/bibleopenIcon.png';
                } else {
                    _bibleIcon.src = '/img/bibleclosedIcon.png';
                }
                _indexCard.classList.toggle('d-none');
                _downCaret.classList.toggle('d-none');
                _upCaret.classList.toggle('d-none');
            }
        },
        props: ['books', 'getBooksUrl']
    }
</script>