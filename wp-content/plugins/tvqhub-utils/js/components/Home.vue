<template>
    <div>
        <b-input-group prepend="Lambda Secret Key">
            <b-form-input v-model="data.lambda_secret_key"></b-form-input>
        </b-input-group>

        <b-button variant="outline-primary" class="mt-3" @click="update">Update
            <b-icon-check2-circle></b-icon-check2-circle>
        </b-button>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
                data: {
                    lambda_secret_key: null
                }
            }
        },
        created() {
            axios({
                method: 'GET',
                url: '/home',
            }).then(response => {
                this.data = response.data.data
            });
        },
        methods: {
            update() {
                axios({
                    method: 'POST',
                    url: '/home',
                    data: {data: this.data}
                }).then(response => {
                    this.makeToast('Action completed!');
                });
            }
        }
    }
</script>
