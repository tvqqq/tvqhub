</div><!--.row-->
</div><!--.container-->

<div class="back-to-top">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>

<footer id="colophon" class="site-footer bd-footer text-muted mt-3" role="contentinfo">
    <div class="container">
        <div class="particletext confetti">
            <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i>
                <?php echo date('Y') ?> -
                <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a>.
            </p>
            <p>
                <i class="fa fa-coffee text-success" aria-hidden="true"></i> +
                <i class="fa fa-heart animated infinite pulse text-danger" aria-hidden="true"></i> =
                <img class="tvqhub-logo-footer" src="<?php echo get_theme_file_uri('assets/images/tvqhub.svg') ?>"
                     alt="<?php bloginfo('name') ?>"> |
                Built with <i class="fab fa-wordpress-simple"></i> + <i class="fab fa-laravel"></i> + <i
                    class="fab fa-vuejs"></i>.
            </p>
            <div class="links">
                <ul class="social-link mb-3">
                    <li><a href="https://www.facebook.com/tvqqq" target="_blank"><i class="fab fa-facebook fa-2x"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="fb/tvqqq"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/tvq" target="_blank"><i class="fab fa-linkedin fa-2x"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="in/tvq"></i></a></li>
                    <li><a href="https://github.com/tvqqq" target="_blank"><i class="fab fa-github fa-2x"
                                                                              data-toggle="tooltip"
                                                                              data-placement="top"
                                                                              title="github/tvqqq"></i></a></li>
                    <li><a href="mailto:quyen@tvqhub.com" target="_blank"><i class="fas fa-at fa-2x"
                                                                             data-toggle="tooltip"
                                                                             data-placement="top"
                                                                             title="quyen@tvqhub.com"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="stripes">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 10">
            <path d="M0-3.2h128v16.5H0z" fill="#39ADD1"/>
            <path d="M128-3.2h128v16.5H128z" fill="#71DB8C"/>
            <path d="M256-3.2h128v16.5H256z" fill="#51B46D"/>
            <path d="M384-3.2h128.2v16.5H384z" fill="#E15258"/>
            <path d="M512-3.2h128.2v16.5H512z" fill="#838CC7"/>
            <path d="M640-3.2h128v16.5H640z" fill="#7D669E"/>
            <path d="M768-3.2h128v16.5H768z" fill="#F092B0"/>
            <path d="M896-3.2h128v16.5H896z" fill="#FF5B89"/>
            <path d="M1024-3.2h128v16.5h-128z" fill="#FFD466"/>
            <path d="M1152-3.2h128v16.5h-128z" fill="#FCAD12"/>
        </svg>
    </div>
</footer>
</div><!--#content-->
<?php wp_footer(); ?>
</body>
</html>
