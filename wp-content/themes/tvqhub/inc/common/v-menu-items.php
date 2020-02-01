<?php
// Color: 400 - https://www.materialui.co/colors
$menu = [
    'ama' => [
        'name' => 'Ask Me Anything',
        'icon' => 'fas fa-question',
        'color' => '#ef5350'
    ],
    'chinese-playlist' => [
        'name' => 'Nhạc Hoa ngữ <img class="ml-1" src="https://1.bp.blogspot.com/-0QutP-eThe4/UVKw9qDmtbI/AAAAAAAAE1E/spxdpNtOVjQ/s1600/nameicon_144249.gif"/>',
        'icon' => 'fas fa-step-forward',
        'color' => '#EC407A'
    ],
    'smallcaps' => [
        'name' => 'Sᴍᴀʟʟᴄᴀᴘs Generator',
        'icon' => 'fas fa-font',
        'color' => '#AB47BC'
    ],
    'ten-tieng-trung-cua-ban' => [
        'name' => 'Tên tiếng Trung của bạn',
        'icon' => 'fas fa-globe-asia',
        'color' => '#7E57C2'
    ],
    'horoscope' => [
        'name' => 'Tra cứu chòm sao',
        'icon' => 'fas fa-star-of-david',
        'color' => '#5C6BC0'
    ],
];
?>

<h3 class="sidebar-title"><span>Menu</span></h3>
<ul class="menu-items mb-4">
    <?php foreach ($menu as $link => $item) { ?>
        <a href="/<?php echo $link ?>">
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
