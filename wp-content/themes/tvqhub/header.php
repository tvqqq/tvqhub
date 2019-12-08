<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<!-- Global script -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154201677-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-154201677-1');
</script>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0&appId=949098545458729&autoLogAppEvents=1"></script>

<body <?php body_class(); ?>>

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <div class="container flex-wrap header-bar">
        <a class="navbar-brand mb-1 mx-auto mx-lg-0 mr-lg-2" href="<?php echo esc_url(home_url('/')) ?>"
           aria-label="TVQhub">
            <img class="d-block" width="100px" src="<?php echo get_theme_file_uri('assets/images/tvqhub.svg') ?>"
                 alt="TVQhub Logo">
        </a>

        <div class="navbar-nav-scroll">
            <ul class="navbar-nav bd-navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link" href="/category/chuyen-code">Chuyện code</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/category/chuyen-linh-tinh">Chuyện linh tinh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/category/chia-se">Chia sẻ</a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav ml-md-auto mx-auto m-md-0">
            <li class="nav-item">
                <a class="nav-link p-2" href="/me" data-toggle="tooltip" data-placement="bottom" title="About me"><i
                        class="fas fa-user-circle"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-2" href="/contact" data-toggle="tooltip" data-placement="bottom" title="Contact"><i
                        class="far fa-paper-plane"></i></a>
            </li>
            <li class="nav-item">
                <form class="form-inline search" method="get" action="<?php echo home_url(); ?>"
                      role="search" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"
                      data-trigger="focus" data-content="Press <code>enter</code> to search">
                    <input id="search" class="form-control form-control-sm" type="search" placeholder="Search..."
                           value="<?php echo get_search_query() ?>" name="s"/>
                </form>
            </li>
        </ul>
    </div>
</header>

<div id="content" class="site-content">
