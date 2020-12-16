<template>
    <div v-on:click="highlight">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
            <circle cx="8" cy="8" r="8"/>
        </svg>
    </div>
</template>

<script>
    export default {
        methods: {
            highlight: function () {
                console.log(this.userId);
                axios.post('api/highlights', {
                    userId: this.userId,
                    verseId: this.verseId
                })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: ['userId', 'verseId']
    }
</script>
