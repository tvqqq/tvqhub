<div id="app-vue-ama">
    <div class="logo-ama text-center">
        <img src="<?php echo get_template_directory_uri() . '/inc/ama/ama-tvq.png' ?>" class="sticker" width="250px">
    </div>
    <div class="question">
        <div class="form-group">
            <h3><i class="fas fa-question-circle"></i> Question</h3>
            <textarea class="form-control" rows="8" placeholder="What, when, why... feel free to ask."
                      v-model="question" minlength="3" maxlength="500"></textarea>
        </div>
        <transition name="fade">
            <div class="success text-center" v-if="success">
                <img src="<?php echo get_template_directory_uri() . '/inc/ama/quobee-yeah-ama.gif' ?>" class="sticker"
                     width="150px">
                <div class="alert alert-success d-inline">Thank you for your question! I will reply ASAP!</div>
            </div>
            <div v-else>
                <div class="fail text-center">
                    <div class="alert alert-danger" v-show="failMsg">{{ failMsg }}</div>
                </div>
                <button type="button" class="btn btn-lg btn-primary d-block w-100" @click.prevent="send"
                        :disabled="isDisabled">
                    <div v-if="loading">
                        <div class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div v-else>
                        Send <i class="far fa-paper-plane"></i>
                    </div>
                </button>
            </div>
        </transition>
    </div>
    <p class="text-center text-muted mt-3"><i class="fas fa-caret-down"></i></p>
    <div v-show="isListLoading" class="text-center">
        <div class="spinner-border m-5" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="spinner-grow spinner-grow-sm" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <span class="text-muted">{{ countNoReply }} questions on queue...</span>
    <div v-for="q in listQuestions">
        <div class="card my-2">
            <div class="card-body">
                <h4>{{ q.question }}</h4>
                <small class="text-muted"><i class="far fa-clock"></i> {{ q.created_at }}</small>
                <p class="mt-3" v-html="q.answer"></p>
            </div>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: '#app-vue-ama',
        data() {
            return {
                question: '',
                listQuestions: [],
                loading: false,
                success: false,
                failMsg: '',
                isListLoading: true,
                countNoReply: 0
            }
        },
        created() {
        },
        computed: {
            isDisabled() {
                return this.loading || this.question.length < 3;
            },
        },
        mounted() {
            this.init();
        },
        methods: {
            async init() {
                await axios(AIRLOCK);
                await this.index();
            },
            index() {
                axios({
                    method: 'GET',
                    url: API + '/ama'
                }).then(response => {
                    this.listQuestions = response.data.data;
                    this.countNoReply = response.data.meta.count_no_reply;
                    this.isListLoading = false;
                });
            },
            send() {
                this.loading = true;
                axios({
                    method: 'POST',
                    url: API + '/ama',
                    data: {
                        question: this.question
                    }
                }).then(response => {
                    this.loading = false;
                    this.question = '';
                    this.success = true;
                    this.countNoReply++;
                    setTimeout(() => {
                        this.success = false
                    }, 3000);
                }).catch(error => {
                    this.failMsg = JSON.stringify(error.response.data.message);
                    setTimeout(() => {
                        this.failMsg = ''
                    }, 3000);
                    this.loading = false;
                });
            },
        }
    });
</script>
