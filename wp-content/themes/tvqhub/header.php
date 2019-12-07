<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<!-- Global script -->

<!-- Google Analytics -->

<!-- Facebook SDK -->

<body <?php body_class(); ?>>

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <div class="container flex-wrap header-bar">
        <a class="navbar-brand mb-1 mx-auto mx-lg-0 mr-lg-4" href="<?php echo esc_url(home_url('/')) ?>"
           aria-label="TVQhub">
            <img class="d-block" width="100px" src="<?php echo get_theme_file_uri('assets/images/tvqhub.svg') ?>"
                 alt="TVQhub Logo">
        </a>

        <div class="navbar-nav-scroll">
            <ul class="navbar-nav bd-navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link " href="/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Bootstrap');">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/docs/4.4/getting-started/introduction/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Docs');">Documentation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/docs/4.4/examples/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Examples');">Examples</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://icons.getbootstrap.com/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Icons');">Icons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://themes.getbootstrap.com/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Themes');" target="_blank"
                       rel="noopener">Themes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://expo.getbootstrap.com/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Expo');" target="_blank"
                       rel="noopener">Expo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://blog.getbootstrap.com/"
                       onclick="ga('send', 'event', 'Navbar', 'Community links', 'Blog');" target="_blank"
                       rel="noopener">Blog</a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav ml-md-auto mx-auto m-md-0">
            <li class="nav-item">
                <a class="nav-link p-2" href="/me" data-toggle="tooltip" data-placement="bottom" title="About me"><i class="fas fa-user-circle"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-2" href="/contact" data-toggle="tooltip" data-placement="bottom" title="Contact"><i class="far fa-paper-plane"></i></a>
            </li>
            <li class="nav-item">
                <form class="form-inline search" method="get" action="<?php echo home_url(); ?>"
                      role="search" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="focus" data-content="Press <code>enter</code> to search">
                    <input id="search" class="form-control form-control-sm" type="search" placeholder="Search..."
                           value="<?php echo get_search_query() ?>" name="s"/>
                </form>
            </li>
        </ul>
    </div>
</header>

<div id="content" class="site-content">
