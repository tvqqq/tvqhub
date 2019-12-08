<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div class="text-center">
    <div class="sharethis-inline-reaction-buttons"></div>
    <div class="sharethis-inline-share-buttons"></div>
    <hr width="20%"/>
    <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-comments fa-stack-1x fa-inverse"></i>
    </span>
</div>
<div id="comments" class="comments-area">
    <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" width="100%"></div>
</div>
