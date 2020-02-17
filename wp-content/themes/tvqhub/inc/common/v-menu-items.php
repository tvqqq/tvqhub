<?php
// Color: 400 - https://www.materialui.co/colors
$menu = [
    [
        'link' => 'https://ly.tvqhub.com',
        'name' => 'Short Link',
        'icon' => 'fas fa-link',
        'color' => '#29B6F6'
    ], [
        'link' => '/ama',
        'name' => 'Ask Me Anything',
        'icon' => 'fas fa-question',
        'color' => '#42A5F5'
    ], [
        'link' => 'chinese-playlist',
        'name' => 'Nhạc Hoa ngữ',
        'icon' => 'fas fa-step-forward',
        'color' => '#5C6BC0'
    ], [
        'link' => 'ten-tieng-trung-cua-ban',
        'name' => 'Tên tiếng Trung của bạn',
        'icon' => 'fas fa-globe-asia',
        'color' => '#7E57C2'
    ], [
        'link' => 'smallcaps',
        'name' => 'Sᴍᴀʟʟᴄᴀᴘs Generator',
        'icon' => 'fas fa-font',
        'color' => '#AB47BC'
    ], [
        'link' => 'horoscope',
        'name' => 'Tra cứu chòm sao',
        'icon' => 'fas fa-star-of-david',
        'color' => '#EC407A'
    ], [
        'link' => 'https://deep.tvqhub.com',
        'name' => 'Deep by TVQhub',
        'icon' => 'fas fa-cloud-moon-rain',
        'color' => '#ef5350'
    ]
];
?>

<h3 class="sidebar-title"><span>Menu</span></h3>
<ul class="menu-items mb-4">
    <?php foreach ($menu as $item) { ?>
        <a href="<?php echo $item['link'] ?>" <?php echo strpos($item['link'], '.') ? 'target="_blank"' : '' ?>>
            <li>
                <span class="fa-stack" style="color: <?php echo $item['color'] ?>">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="<?php echo $item['icon'] ?> fa-stack-1x fa-inverse"></i>
                </span>
                <span><?php echo $item['name'] ?></span>
            </li>
        </a>
    <?php } ?>
</ul>
