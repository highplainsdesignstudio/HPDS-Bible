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
                let words = this.query.split(' ');
                let q = '';
                for(let i=0; i < words.length; i++) {
                    if (i===0) {
                        q = words[i];
                    } else {
                        q += (' ' + words[i]);
                    }
                }
                q = encodeURI(q);
                window.location.href = '/search?q=' + q;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
