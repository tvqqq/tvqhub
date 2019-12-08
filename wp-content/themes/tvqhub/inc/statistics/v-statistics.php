<?php
$stat = tvqhub_statistics();
?>

<div class="row no-gutters">
    <div class="col">
        <div class="card border-info">
            <div class="card-body text-center p-2">
                <h4><strong><?php echo $stat['days'] ?></strong></h4>
                <h6>days <small><i class="fas fa-info-circle" data-toggle="tooltip" title="since <?php echo $stat['since'] ?>"></i></small></h6>
            </div>
        </div>
    </div>
    <div class="col mx-2">
        <div class="card border-primary">
            <div class="card-body text-center p-2">
                <h4><strong><?php echo $stat['posts'] ?></strong></h4>
                <h6>posts</h6>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-success">
            <div class="card-body text-center p-2">
                <h4><strong><?php echo $stat['views'] ?></strong></h4>
                <h6>views</h6>
            </div>
        </div>
    </div>
</div>
