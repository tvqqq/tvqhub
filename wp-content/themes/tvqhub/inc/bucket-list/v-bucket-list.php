<div id="app-vue-bucketlist">
    <ul style="list-style: none">
        <li v-for="(item, index) in items" class="my-1">
            <input disabled type="checkbox" class="mr-1" :checked="item.complete_date"/>
            <span :class="{ 'text-muted': item.complete_date }">{{ index + 1 }}. {{ item.content }}</span>
            <span v-if="item.complete_date" class="btn badge badge-success badge-pill" data-toggle="popover"
                  :data-content="item.description">{{ item.complete_date }}</span>
        </li>
    </ul>
</div>

<script>
    var app = new Vue({
        el: '#app-vue-bucketlist',
        data: function () {
            return {
                items: []
            }
        },
        mounted() {
            this.init();
        },
        updated() {
            this.$nextTick(() => {
                jQuery('[data-toggle="popover"]').popover({
                    placement: 'top'
                });
            });
        },
        methods: {
            async init() {
                await axios(AIRLOCK + '/csrf');
                await axios.post(AIRLOCK + '/login');
                await this.index();
            },
            async index() {
                await axios({
                    method: 'GET',
                    url: API + '/bucket-list'
                }).then(response => {
                    this.items = response.data.data;
                });
            }
        }
    });
</script>
