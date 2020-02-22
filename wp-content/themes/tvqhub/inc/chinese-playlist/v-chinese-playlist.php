<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/inc/chinese-playlist/APlayer.css' ?>"/>
<script src="<?php echo get_template_directory_uri() . '/inc/chinese-playlist/APlayer.min.js' ?>"></script>

<div id="app-vue-chinese-playlist">
    <div class="sticker text-center my-3">
        <img src="<?php echo get_template_directory_uri() . '/inc/chinese-playlist/chinese-playlist.png' ?>" width="500px" />
    </div>
    <div id="aplayer"> </div>
    <div class="text-center mt-4">
        <i class="fas fa-music"></i> <strong>{{ count }}</strong> bài hát • Cập nhật: {{ lastUpdated }} <i class="far fa-clock"></i><br/><br/>
        Hãy đóng góp thêm vào playlist bằng cách bình luận bên dưới nhé <img src="https://2.bp.blogspot.com/-X73i45IvKlY/UVKwu-h6ymI/AAAAAAAAEuI/OlGPV2lEorM/s320/nameicon_122626.gif" class="sticker" />
    </div>
</div>

<script>
    var app = new Vue({
        el: '#app-vue-chinese-playlist',
        data() {
            return {
                count: 0,
                lastUpdated: null
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            async init() {
                await axios(AIRLOCK + '/csrf');
                await axios.post(AIRLOCK + '/login');
                await this.index();
            },
            async index() {
                let audioList = [];
                await axios({
                    method: 'GET',
                    url: API + '/chinese-playlist'
                }).then(response => {
                    let data = response.data;
                    this.count = data.meta.count;
                    this.lastUpdated = data.meta.last_updated;
                    data.data.forEach(item => {
                        audioList.push({
                            'name': '「' + item.cn_name + '」' + item.vn_name,
                            'artist': item.artist,
                            'url': item.mp3_url,
                            'cover': item.image_url,
                            'theme': item.color
                        });
                    });
                });
                await this.apPlayer(audioList);
            },
            apPlayer(audioList) {
                // @see https://aplayer.js.org/#/home?id=quick-start
                const ap = new APlayer({
                    container: document.getElementById('aplayer'),
                    mini: false,
                    autoplay: true,
                    loop: 'all',
                    order: 'list',
                    preload: 'metadata',
                    volume: 1,
                    mutex: true,
                    listFolded: false,
                    listMaxHeight: '470px',
                    audio: audioList
                });
            }
        }
    });
</script>
