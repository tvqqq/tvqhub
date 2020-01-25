<?php
$menu = get_post_meta(get_the_ID(), '581a_price', true);
$menuArr = json_decode($menu, true);
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row alert alert-danger">

                <div class="col-5">
                    <strong>Tổng tiền:</strong>
                </div>

                <div class="col-7 d-flex justify-content-between">
                    <span><strong class="sum-amount">0</strong>&nbsp;VNĐ</span>
                    <button type="button" class="btn btn-sm btn-danger btn-reset-header btn-reset"><i
                            class="fas fa-redo-alt"></i></button>
                </div>

            </div>
            <div class="main">
                <?php foreach ($menuArr as $key => $item) { ?>
                    <div class="card" id="<?php echo $key ?>">
                        <div class="card-body">
                            <div class="row align-content-between">
                                <div class="col-5">
                                    <strong><?php echo $item['name'] ?>:</strong><br/>
                                    <small>(<?= number_format($item['price']) ?>đ)</small>
                                </div>
                                <div class="col-7">
                                    <div class="d-flex">
                                        <button class="btn btn-secondary btn-sm btn-adjust" data-adjust="minus"><i
                                                class="fas fa-minus-circle"></i>
                                        </button>
                                        <input type="number" class="form-control input-amount" value="0"/>
                                        <button class="btn btn-primary btn-sm btn-adjust" data-adjust="add"><i
                                                class="fas fa-plus-circle"></i>
                                        </button>
                                    </div>
                                    <small class="d-block text-center mt-1"><span
                                            class="dishes-sum-price">0</span>đ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="sum mb-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <div class="row my-1">
                                <div class="col">
                                    <h5><strong><i class="fas fa-funnel-dollar"></i> Tổng tiền:</strong></h5>
                                </div>
                                <div class="col text-right">
                                    <h5><strong class="sum-amount">0</strong>đ</h5>
                                </div>
                            </div>

                            <hr/>

                            <div class="row my-1 align-items-center">
                                <div class="col">
                                    <h6><strong><i class="fas fa-hand-holding-usd"></i> Khách đưa:</strong></h6>
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control input-customer-give" value=""/>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <h6><strong><i class="fas fa-comments-dollar"></i> Tiền thối:</strong></h6>
                                </div>
                                <div class="col text-right">
                                    <h6><strong class="money-back">0</strong>đ</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-button">
                        <div class="row text-center">
                            <div class="col">
                                <button type="button" class="btn btn-lg btn-secondary btn-reset">Reset <i
                                        class="fas fa-redo-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
