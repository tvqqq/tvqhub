<?php
$qod = tvqhub_get_data_qod();
?>

<div class="border-qod">
    <div class="bg-qod text-center">
        <div class="quote mb-1"><?php echo $qod->quote ?></div>
        <div class="text-muted">-&nbsp;<span><?php echo $qod->author ?></span>&nbsp;<i class="fas fa-feather-alt"></i></div>
    </div>
</div>
