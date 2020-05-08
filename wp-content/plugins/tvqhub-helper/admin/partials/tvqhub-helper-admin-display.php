<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://tvqhub.com
 * @since      1.0.0
 *
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container-fluid">
    <h2 class="my-3"><?php echo $this->plugin_name_display ?></h2>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-2fa-tab" data-toggle="tab" href="#nav-2fa" role="tab" aria-controls="nav-2fa" aria-selected="true">2FA</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-2fa" role="tabpanel" aria-labelledby="nav-2fa-tab">
            <?php include_once plugin_dir_path(dirname(__FILE__)) . 'partials/2fa.php' ?>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>
</div>
