<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/inc/chinese-playlist/APlayer.css' ?>"/>
<script src="<?php echo get_template_directory_uri() . '/inc/chinese-playlist/APlayer.min.js' ?>"></script>

<div id="app-vue-chinese-playlist">
    <div id="aplayer"> </div>
</div>

<script>
    jQuery(function ($) {
        let audioList = [];

        $.ajax({
            url: API + '/chinese-playlist',
        }).done(function (response) {
            response.data.forEach(item => {
                audioList.push({
                    'name': '「' + item.cn_name + '」' + item.vn_name,
                    'artist': item.artist,
                    'url': item.mp3_url,
                    'cover': item.image_url,
                    'theme': item.color
                });
            });

            // @see https://aplayer.js.org/#/home?id=quick-start
            const ap = new APlayer({
                container: document.getElementById('aplayer'),
                mini: false,
                autoplay: false,
                loop: 'all',
                order: 'list',
                preload: 'metadata',
                volume: 1,
                mutex: true,
                listFolded: false,
                listMaxHeight: '460px',
                audio: audioList
            });
        });
    });
</script>
