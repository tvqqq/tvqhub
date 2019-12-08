<?php
get_header();
?>

    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-12">
                <main id="main" class="site-main" role="main">
                    <section class="error-404 not-found my-5 text-center">
                        <div class="d-inline-flex align-items-center position-relative">
                            <strong class="code text-danger pr-3">404</strong>
                            <span class="ml-3 text-muted">Not Found <i class="fas fa-heart-broken"></i></span>
                        </div>
                    </section>
                    <?php get_template_part('template-parts/components/searchform'); ?>
                </main>
            </div>
        </div>
    </div>

<?php
get_footer();
