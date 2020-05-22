<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Index Component
                    </div>

                    <div class="row">
                        <div id="index-menu" v-on:click="toggleIndex" class="col-4">
                            <img src="img/bibleclosedIcon.png" alt="bible icon0" id="bible-icon" style="width:64px">
                        </div>

                        <div class="card-body d-none col-8" id="index-card">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    Old Testament
                                    <ul>
                                        <li v-for="book in oldTestament" v-bind:key="book.id" ><a href="#">{{ book.book }}</a></li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    New Testament
                                    <ul>
                                        <li v-for="book in newTestament" v-bind:key="book.id"><a href="#">{{ book.book }}</a></li>
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
        created: function() {
            fetch('api/bible')
            .then(response => response.json())
            .then(data => {
                this.books = data;
                console.log(this.books);
            });
        },
        data: function() {
            return {
                books: null
            }
        },
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
            toggleIndex: function(_event) {
                let _bibleIcon = document.getElementById('bible-icon');
                let _indexCard = document.getElementById('index-card');

                let _src = 'http://' + window.location.hostname + '/img/bibleclosedIcon.png';
                if (_bibleIcon.src === _src) {
                    _bibleIcon.src = 'img/bibleopenIcon.png';
                } else {
                    _bibleIcon.src = 'img/bibleclosedIcon.png';

                }

                _indexCard.classList.toggle('d-none');
            }
        },
        mounted() {
            console.log('Bible Component mounted.')
        }
    }
</script>