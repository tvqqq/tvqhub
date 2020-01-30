<?php
// Color: 400 - https://www.materialui.co/colors
$menu = [
    'ama' => [
        'name' => 'Ask Me Anything',
        'icon' => 'fas fa-question',
        'color' => '#ef5350'
    ],
    'smallcaps' => [
        'name' => 'Sᴍᴀʟʟᴄᴀᴘs Generator',
        'icon' => 'fas fa-font',
        'color' => '#EC407A'
    ],
    'ten-tieng-trung-cua-ban' => [
        'name' => 'Tên tiếng Trung của bạn',
        'icon' => 'fas fa-globe-asia',
        'color' => '#AB47BC'
    ],
    'horoscope' => [
        'name' => 'Tra cứu chòm sao',
        'icon' => 'fas fa-star-of-david',
        'color' => '#7E57C2'
    ],
];
?>

<h3 class="sidebar-title"><span>Menu</span></h3>
<ul class="menu-items mb-4">
    <?php foreach ($menu as $link => $item) { ?>
    <li>
        <a href="/<?php echo $link ?>">
            <span class="fa-stack" style="color: <?php echo $item['color'] ?>">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="<?php echo $item['icon'] ?> fa-stack-1x fa-inverse"></i>
            </span>
            <span><?php echo $item['name'] ?></span>
        </a>
    </li>
    <?php } ?>
</ul>
