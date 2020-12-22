<template>
<div class="leaf">


    <button v-bind:class=" [type==1 ? 'leaf-next' : 'leaf-previous', 'btn', 'btn-primary'] " v-on:click="clickLeaf()">
        <span v-if="type==-1">
            <svg width="3em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </span>
        
        <span v-if="type==1">
            <svg width="3em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
            </svg>
        </span>
    </button>

</div>
</template>

<script>
    export default {
        methods: {
            clickLeaf: function() {
                location.replace('http://bible.local/' + this.link.book + '/' + this.link.chapter);
            }
        },
        props:['type', 'link']
    }
</script>