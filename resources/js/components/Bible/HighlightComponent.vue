<template>
    <div id="highlight-component" >
            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-circle-fill" viewBox="0 0 32 32" v-on:click="highlight(1)">
                <circle cx="16" cy="16" r="16"/>
            </svg> -->
            <img :src="'/img/green-circle.png'"  v-on:click="highlight(1)" title="Highlight Green.">
            <img :src="'/img/x.png'" v-on:click="highlight(0)" title="Clear Selected.">

    </div>
</template>

<script>
    export default {
        computed: {
            hostname: function() {
                return 'http://' + location.hostname + '/';
            }
        },
        methods: {
            highlight: function (color) {
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
                    axios.post( '/api/highlights', _post)
                    .then(response => {
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
                this.$emit('highlight', this.chapterId, this.verses, color);
            }
        },
        props: ['chapterId', 'userId', 'verses']
    }
</script>
