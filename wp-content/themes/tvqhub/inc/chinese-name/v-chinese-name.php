<div id="app-vue-chinese-name">
    <div class="text-center">
        <h3 class="text-danger">Tên tiếng Trung và ý nghĩa tên tiếng Trung của bạn</h3>
        <h3>你的中文名字是。。。</h3>
        <p class="lead my-3"><strong>Hướng dẫn:</strong> <strong class="text-info">Nhập họ tên tiếng Việt có dấu của bạn</strong> vào ô bên dưới để dịch tên tiếng Việt sang tiếng Trung.<br/>Họ tên
            tiếng Trung của bạn gồm tiếng Trung, cách đọc và ý nghĩa tham khảo.</p>
        <div class="form-inline row no-gutters">
            <div class="col-12 col-lg-5 offset-lg-3">
                <input type="text" class="form-control form-control-lg w-100" placeholder="Tên của bạn..." v-model="vnName" @keypress="isName($event)" :value="vnName.toUpperCase()"
                       @input="vnName = $event.target.value.toUpperCase()">
            </div>
            <div class="col-12 col-lg-1">
                <button type="button" class="btn btn-primary btn-lg mt-1 mt-lg-0" @click="translate">
                    <span class="spinner-border spinner-border-sm" v-if="loading">
                        <span class="sr-only">Loading...</span>
                    </span>
                    <span v-else>Dịch</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6 offset-lg-3">
            <div class="alert alert-danger" v-if="fail">
                Không tìm được kết quả phù hợp!
            </div>
            <div v-else v-if="result">
                <strong>
                    <mark>{{ vnName }}</mark>
                </strong>
                <h2 class="display-3" v-text="cnChar"></h2>
                <h4 class="text-muted pt-0 pb-2">/ <span v-text="cnPinyin"></span> / <a @click="playSound" class="plain audio"><i class="fas fa-volume-up"></i></a></h4>
                <h5 class="text-info"><u>Ý nghĩa</u></h5>
                <ul v-for="(value, index) in result.words">
                    <li>
                        <div><strong>{{ value }}</strong>: {{ result.translated_words[index][0] }} ({{ result.spellings[index][0] }})</div>
                        <div v-html="result.meanings[index][0].replace(/(?:\r\n|\r|\n)/g, br)"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=BpFmzpMX"></script>
<script>
    var app = new Vue({
        el: '#app-vue-chinese-name',
        data() {
            return {
                vnName: '',
                cnChar: '',
                cnPinyin: '',
                result: null,
                loading: false,
                br: '<br/>',
                fail: false,
            }
        },
        created() {
        },
        methods: {
            isName(evt) {
                this.result = null;
                evt = (evt) ? evt : window.event;
                const charCode = (evt.which) ? evt.which : evt.keyCode;
                if (((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)) && charCode === 32) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },
            translate() {
                this.loading = true;
                axios({
                    method: 'POST',
                    url: API + '/chinese-name',
                    data: {
                        name: this.vnName,
                    }
                }).then(response => {
                    let data = response.data.data;
                    let check = 0;
                    data.translated_words.filter(word => {
                        if (word.length === 0) check++;
                    });
                    if (check === 0) {
                        this.fail = false;
                        this.cnChar = data.translated_words.join('');
                        this.cnPinyin = data.spellings.join(' ');
                        this.result = data;
                    } else {
                        this.fail = true;
                    }
                }).catch(error => {
                    this.fail = true;
                    console.log(error);
                }).then(() => {
                    this.loading = false;
                });
            },
            playSound() {
                responsiveVoice.speak(this.cnChar, 'Chinese Female');
            }
        },
    });
</script>
