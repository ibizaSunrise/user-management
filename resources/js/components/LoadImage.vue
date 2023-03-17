<template>
    <div class="container">
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        <button @click.prevent="sendImage" type="button" class="btn btn-primary mt-3">Add</button>
    </div>

</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import {EventBus} from "../event-bus";

export default {
    name: "LoadImage",
    components: {
        vueDropzone: vue2Dropzone,
    },
    data: function () {
        return {
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                autoProcessQueue: false,
                addRemoveLinks: true,
                headers: {"My-Awesome-Header": "header value"}
            }
        }
    },
    methods: {
        sendImage() {
            const data = new FormData()
            const files = this.$refs.myVueDropzone.getAcceptedFiles()
            files.forEach(file => {
                data.append('images[]', file)
                this.$refs.myVueDropzone.removeFile(file)
            })
            axios.post('/api/user/image', data)
                .then(res => {
                    EventBus.$emit('user.update', res.data.data.user)
                })
        },

    }
}
</script>

<style scoped>

</style>
