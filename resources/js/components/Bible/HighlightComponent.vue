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
                console.log("You want to highlight green!");
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
