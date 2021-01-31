<template>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="row"> -->
                <div class="col-8 form-group">
                    <input type="text" v-model="query" placeholder="Search" class="form-control" style="width: 100%;">
                </div>
                <button class="btn btn-light col-1" v-on:click="getSearch">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            <!-- </div> -->
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                query: ''
            }
        },
        methods: {
            getSearch: function() {
                let _verse1Pattern = /(?<book>[A-Za-z]*)\s*(?<chapter>\d+)\s*:?\s*(?<start>\d+)(\s*(?<select>,|-)?\s*(?<end>\d*))/g;
                let _query = this.query;
                let _results = [..._query.matchAll(_verse1Pattern)];
                console.log(_results);

                // if (_verse1Pattern.test(this.query)) {
                if (_results.length > 0) {
                    let _q = '?';
                    for(let i=0; i < _results.length; i++) {
                        let _temp = `book${i}=${_results[i].groups.book}&chapter${i}=${_results[i].groups.chapter}&start${i}=${_results[i].groups.start}`; 
                        if (typeof _results[i].groups.select !== 'undefined' && _results[i].groups.end !== '') {
                            _temp += `&select${i}=${_results[i].groups.select}&end${i}=${_results[i].groups.end}`;
                        }
                        
                        
                        if (i !== _results.length - 1) {
                            _temp =+ '&'; 
                        }


                        _q += _temp;
                    }
                    _q = encodeURI(_q);
                    // window.location.href = `/verse${_q}`;
                    console.log(_q);
                } else {
                    let _words = this.query.split(' ');

                    let _q = '';
                    for(let i=0; i < _words.length; i++) {
                        if (i===0) {
                            _q = _words[i];
                        } else {
                            _q += (' ' + _words[i]);
                        }
                    }
                    /**
                     * A _test string is created to check for a search of all blank spaces. If the user searches for all blank spaces,
                     * the page is reloaded. If this were not the case, the database would return every verse in the Bible.
                     */
                    let _test = _q.trim();
                    if (_test.length !== 0) {
                        _q = encodeURI(_q);
                        window.location.href = '/search?q=' + _q;
                    } else {
                        window.location.reload();
                    }
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
