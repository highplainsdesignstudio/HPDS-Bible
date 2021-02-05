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
                query: typeof this.q !== 'undefined' ? this.q : ''
            }
        },
        methods: {
            getSearch: function() {
                /**
                 * This is a VERY long function and should be consolidated in the future. Right now it appears to be working,
                 * but it has not been tested beyond development. This method is triggered on click of the search button. It gets the text
                 * from the search box, determines if it is a verse, generates a URI string, and redirects the user to a new page using a get request with data.
                 */

                // Create the various Regular Expressions that are required throughout the method.
                let _verse1Pattern = /(?<book>\d?\s*[A-Za-z]+)\s*(?<chapter>\d+)\s*:?\s*(?<start>\d*)\s*(?<select>,|-)?\s*(?<end>\d*)/g;
                // let _verse1Pattern = /(?<book>\d?\s*[A-Za-z]+)\s*(?<chapter>\d+)\s*:?\s*(?<start>\d*)/g;
                // let _verse2Pattern = /\s*(?<select>,|-)?\s*(?<end>\d*)/g;
                let _verse2Pattern = /(\d?\s*[A-Za-z]+\s*\d+\s*:?\d*\s*(,|-)?\s*\d*)/g;
                let _verse3Pattern = /(,\s*(?<and>\d+))/g;
                let _verse4Pattern = /(?<from>\d)+\s*-\s*(?<thru>\d+)/g;
                
                // Create the results using the text from the input field modeled to this.query against the first regular expression.
                let _query = this.query;
                let _results = [..._query.matchAll(_verse1Pattern)];
                // console.log(_results);

                // Now, check if there are any results that look like a verse.
                // if (_verse1Pattern.test(this.query)) {
                if (_results.length > 0) {
                    // If there are _results, begin creating the query data (_q) that will be sent to the server with a GET call.
                    let _q = '?';
                    let _comparer = this.query.replace(_verse2Pattern, '|'); // This replaces any patterns of "1 Kings 1:1-2" with the "|" to determine if there are extra verses.
                    // console.log(_comparer);
                    let _compTokens = _comparer.split('|'); // Used to determine if there are any extra verses beyond the original verse. ex: "Genesis 1:1-2, 3, 5"
                    // console.log(_compTokens);
                    
                    // Loop through the _results
                    for(let i=0; i < _results.length; i++) {
                        // Create the temporary string that will be sent with the GET. This will be created for every result found in search box.
                        let _temp = `book${i+1}=${_results[i].groups.book}&chapter${i+1}=${_results[i].groups.chapter}`; 
                        if (_results[i].groups.start !== '') {
                            _temp += `&start${i+1}=${_results[i].groups.start}`;
                            if (typeof _results[i].groups.select !== 'undefined' && _results[i].groups.end !== '') {
                                _temp += `&select${i+1}=${_results[i].groups.select}&end${i+1}=${_results[i].groups.end}`;
                            }
                        }

                        // Creat the arrays for any extra verses found beyond the original pattern. The arrays contain text as either a ",9" or "1-2"
                        let _andnext = [..._compTokens[i+1].matchAll(_verse3Pattern)]; // Contains ",9"s
                        let _thrunext = [..._compTokens[i+1].matchAll(_verse4Pattern)]; // Contains "1-2"s
                        let _and = []; // Holds an array that will be used to concatenate to the _q string.
                        
                        // If there are any ",9"s add them to the _and
                        if (_andnext.length > 0) {
                            _andnext.forEach(element => {
                                _and.push(element.groups.and);
                            });
                        }
                        // let _andthru = _and.split('+');

                        // If there are any "1-2"s add them to the _and
                        if (_thrunext.length > 0) {
                            for (let x=0; x < _thrunext.length; x++) {
                                let _thruTest = false;
                                // Check if there are any ",9"s that match the first of any "9-10"s to not return duplicates or partials in the future.
                                for(let y=0; y < _and.length; y++) {
                                    if(_thrunext[x].groups.from === _and[y]) {
                                        _and[y] = _thrunext[x].groups.from + '-' + _thrunext[x].groups.thru;
                                        _thruTest = true;
                                        break;
                                    }
                                }
                                if (!_thruTest) {
                                    _and.push(_thrunext[x].groups.from + '-' + _thrunext[x].groups.thru);
                                }
                            }
                        }
                        
                        // console.log(_and);
                        let _tmpAnd = '';
                        // If there are _and after all that, create the string to add to the _q via the _temp.
                        if (_and.length > 0) {
                            _tmpAnd = `&and${i+1}=`;
                            for(let z=0; z < _and.length; z++) {
                                if(z !== _and.length - 1) {
                                    _tmpAnd += _and[z] + ','
                                } else {
                                    _tmpAnd += _and[z];
                                }
                            }
                            _temp += _tmpAnd;
                            // console.log(_tmpAnd);
                        }

                        if (i !== _results.length - 1) {
                            _temp += '&';
                        }
                
                        _q += _temp;
                    }

                    // if (_results.length > 1) {
                        _q += `&count=${_results.length}`; // Maybe this should be added even if there are not multiple results?
                    // }

                    // encode the _q to a URI to send as a GET request to the server.
                    _q += "&string=" + this.query;
                    _q = encodeURI(_q);
                    window.location.href = `/verse${_q}`;
                    // console.log(_q);
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
        // mounted() {
        //     console.log(this.q);
        // },
        props: ['q']
    }
</script>
