<template>
    <div id="highlight-component" >
            <img :src="'/img/green-circle.png'"  v-on:click="highlight(1)" title="Highlight Green.">
            <img :src="'/img/x.png'" v-on:click="highlight(0)" title="Clear Selected.">

    </div>
</template>

<script>
    export default {
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
                        // console.log(error);
                    });
                }
                this.$emit('highlight', this.chapterId, this.verses, color);
            }
        },
        props: ['chapterId', 'userId', 'verses']
    }
</script>
