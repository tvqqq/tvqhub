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

        <div class="card my-3">
            <div class="card-header">
                Clean Up Database
            </div>
            <div class="card-body">
                <b-button size="lg" @click="cleanUpDb">Clean <b-icon-bucket></b-icon-bucket></b-button>
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
            },
            cleanUpDb() {
                axios({
                    method: 'GET',
                    url: '/clean-up',
                }).then(response => {
                    this.makeToast('Action completed!');
                }).catch(err => {
                    this.makeToast(err.response.data.message, 'danger');
                });
            }
        }
    }
</script>
