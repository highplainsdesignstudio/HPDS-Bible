<template>
    <button class="btn btn-danger col-1" v-on:click="deleteHighlight"> X </button>
</template>

<script>
    export default {
        methods: {
            deleteHighlight: function() {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.apiToken}`;

                axios.delete('/api/highlights/' + this.id)
                .then(response => {
                    console.log(`User ${this.user} HIghlight ${this.highlight}, ID: ${this.id} deleted`);
                    console.log('DB Response: ' + response)
                    let elem = document.getElementById('highlight-' + this.highlight);
                    elem.style.display = 'none';                    
                })
                .catch(exception => {
                    console.log(exception);
                    alert('There was a problem with the database. Please try again later.');
                });
            }
        },
        mounted: function() {
            console.log(this.apiToken);
        },
        props: ['apiToken', 'highlight', 'user', 'id']
    }
</script>
