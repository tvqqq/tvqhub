<template>
    <div>
        <div class="card">
            <div class="card-header">
                Convert Title WP
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <b-form-input v-model="titleRaw" placeholder="Enter the title..."></b-form-input>
                    <div class="mx-2 mt-0"><b-button variant="outline-primary" @click="convertTitleWp"><b-icon-forward-fill></b-icon-forward-fill></b-button></div>
                    <b-form-input v-model="titleConverted" disabled></b-form-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Functions",
        data() {
            return {
                titleRaw: '',
                titleConverted: ''
            }
        },
        methods: {
            convertTitleWp() {
                console.log('1111');
                axios({
                    method: 'POST',
                    url: '/title',
                    data: {data: { title: this.titleRaw } }
                }).then(response => {
                    this.titleConverted = response.data.data;
                    this.makeToast('Action completed!');
                }).catch(err => {
                    this.makeToast(err.response.data.message, 'danger');
                });
            }
        }
    }
</script>
