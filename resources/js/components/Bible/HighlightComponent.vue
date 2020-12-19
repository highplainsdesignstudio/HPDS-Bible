<template>
    <div id="highlight-component" class="col-12">
        <div  v-on:click="highlight">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="8"/>
            </svg>
        </div>
        
    </div>
</template>

<script>
    export default {
        methods: {
            highlight: function () {
                let _post = {
                    userId: this.userId,
                    count: this.verses.length
                };

                for (let i = 0; i < this.verses.length; i++) {
                    let _x = i + 1;
                    let _name = "verse_" + _x;
                    _post[_name] = this.verses[i];
                }

                if (this.userId > 0) {
                    axios.post('api/highlights', _post)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }

                this.$emit('highlight', this.chapterId, this.verses);
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: ['chapterId', 'userId', 'verses']
    }
</script>
