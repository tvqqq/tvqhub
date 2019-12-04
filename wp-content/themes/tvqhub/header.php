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

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar fixed-top">
    <div class="container header-bar">
        <a class="navbar-brand mb-1" href="<?php echo esc_url(home_url('/')) ?>" aria-label="TVQhub">
            <img class="d-block" width="100px" src="<?php echo get_stylesheet_directory_uri() ?>/images/tvqhub.svg"
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

        <ul class="navbar-nav ml-md-auto">
            <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    v4.4
                </a>
                <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bd-versions">
                    <a class="dropdown-item active" href="/docs/4.4/">Latest (4.4.x)</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/docs/4.3/">v4.3.1</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/docs/4.2/">v4.2.1</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/docs/4.0/">v4.0.0</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="https://v4-alpha.getbootstrap.com/">v4 Alpha 6</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/docs/3.4/">v3.4.1</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/docs/3.3/">v3.3.7</a>
                    <a class="dropdown-item" href="https://getbootstrap.com/2.3.2/">v2.3.2</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/docs/versions/">All versions</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link p-2" href="https://github.com/twbs/bootstrap" target="_blank" rel="noopener"
                   aria-label="GitHub">
                    <svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 499.36" role="img"
                         focusable="false"><title>GitHub</title>
                        <path fill="currentColor" fill-rule="evenodd"
                              d="M256 0C114.64 0 0 114.61 0 256c0 113.09 73.34 209 175.08 242.9 12.8 2.35 17.47-5.56 17.47-12.34 0-6.08-.22-22.18-.35-43.54-71.2 15.49-86.2-34.34-86.2-34.34-11.64-29.57-28.42-37.45-28.42-37.45-23.27-15.84 1.73-15.55 1.73-15.55 25.69 1.81 39.21 26.38 39.21 26.38 22.84 39.12 59.92 27.82 74.5 21.27 2.33-16.54 8.94-27.82 16.25-34.22-56.84-6.43-116.6-28.43-116.6-126.49 0-27.95 10-50.8 26.35-68.69-2.63-6.48-11.42-32.5 2.51-67.75 0 0 21.49-6.88 70.4 26.24a242.65 242.65 0 0 1 128.18 0c48.87-33.13 70.33-26.24 70.33-26.24 14 35.25 5.18 61.27 2.55 67.75 16.41 17.9 26.31 40.75 26.31 68.69 0 98.35-59.85 120-116.88 126.32 9.19 7.9 17.38 23.53 17.38 47.41 0 34.22-.31 61.83-.31 70.23 0 6.85 4.61 14.81 17.6 12.31C438.72 464.97 512 369.08 512 256.02 512 114.62 397.37 0 256 0z"></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-2" href="https://twitter.com/getbootstrap" target="_blank" rel="noopener"
                   aria-label="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 416.32" role="img"
                         focusable="false"><title>Twitter</title>
                        <path fill="currentColor"
                              d="M160.83 416.32c193.2 0 298.92-160.22 298.92-298.92 0-4.51 0-9-.2-13.52A214 214 0 0 0 512 49.38a212.93 212.93 0 0 1-60.44 16.6 105.7 105.7 0 0 0 46.3-58.19 209 209 0 0 1-66.79 25.37 105.09 105.09 0 0 0-181.73 71.91 116.12 116.12 0 0 0 2.66 24c-87.28-4.3-164.73-46.3-216.56-109.82A105.48 105.48 0 0 0 68 159.6a106.27 106.27 0 0 1-47.53-13.11v1.43a105.28 105.28 0 0 0 84.21 103.06 105.67 105.67 0 0 1-47.33 1.84 105.06 105.06 0 0 0 98.14 72.94A210.72 210.72 0 0 1 25 370.84a202.17 202.17 0 0 1-25-1.43 298.85 298.85 0 0 0 160.83 46.92"></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-2" href="https://bootstrap-slack.herokuapp.com/" target="_blank" rel="noopener"
                   aria-label="Slack">
                    <svg xmlns="http://www.w3.org/2000/svg" class="navbar-nav-svg" viewBox="0 0 512 512" role="img"
                         focusable="false"><title>Slack</title>
                        <path fill="currentColor" d="M210.787 234.832l68.31-22.883 22.1 65.977-68.309 22.882z"></path>
                        <path fill="currentColor"
                              d="M490.54 185.6C437.7 9.59 361.6-31.34 185.6 21.46S-31.3 150.4 21.46 326.4 150.4 543.3 326.4 490.54 543.34 361.6 490.54 185.6zM401.7 299.8l-33.15 11.05 11.46 34.38c4.5 13.92-2.87 29.06-16.78 33.56-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18l-11.46-34.38-68.36 22.92 11.46 34.38c4.5 13.92-2.87 29.06-16.78 33.56-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18l-11.46-34.43-33.15 11.05c-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18c-4.5-13.92 2.87-29.06 16.78-33.56l33.12-11.03-22.1-65.9-33.15 11.05c-2.87.82-6.14 1.64-9 1.23a27.32 27.32 0 0 1-24.56-18c-4.48-13.93 2.89-29.07 16.81-33.58l33.15-11.05-11.46-34.38c-4.5-13.92 2.87-29.06 16.78-33.56s29.06 2.87 33.56 16.78l11.46 34.38 68.36-22.92-11.46-34.38c-4.5-13.92 2.87-29.06 16.78-33.56s29.06 2.87 33.56 16.78l11.47 34.42 33.15-11.05c13.92-4.5 29.06 2.87 33.56 16.78s-2.87 29.06-16.78 33.56L329.7 194.6l22.1 65.9 33.15-11.05c13.92-4.5 29.06 2.87 33.56 16.78s-2.88 29.07-16.81 33.57z"></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-2" href="https://opencollective.com/bootstrap/" target="_blank" rel="noopener"
                   aria-label="Open Collective">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" fill-rule="evenodd"
                         class="navbar-nav-svg"
                         viewBox="0 0 40 41" role="img" focusable="false"><title>Open Collective</title>
                        <path fill-opacity=".4"
                              d="M32.8 21c0 2.4-.8 4.9-2 6.9l5.1 5.1c2.5-3.4 4.1-7.6 4.1-12 0-4.6-1.6-8.8-4-12.2L30.7 14c1.2 2 2 4.3 2 7z"></path>
                        <path
                            d="M20 33.7a12.8 12.8 0 0 1 0-25.6c2.6 0 5 .7 7 2.1L32 5a20 20 0 1 0 .1 31.9l-5-5.2a13 13 0 0 1-7 2z"></path>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</header>

<div id="content" class="site-content">
