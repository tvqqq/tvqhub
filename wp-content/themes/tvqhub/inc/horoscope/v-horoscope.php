<div class="row mb-3">
    <div class="col-12 d-flex flex-column text-center">
        <span>Chọn <strong>tháng</strong></span>
        <div class="input-group align-self-center w-25">
            <select class="custom-select" id="thang">
                <option value="0" selected>----Tháng----</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-12 d-flex flex-column text-center mt-3 mb-1">
        <span>Chọn <strong>ngày</strong></span>
        <div class="input-group align-self-center w-25">
            <select class="custom-select" id="ngay">
                <option value="0" selected>----Ngày----</option>
            </select>
        </div>
    </div>
</div>
<div class="d-block text-center">
    <button id="xem" class="btn btn-primary btn-lg text-center w-25">Tra cứu</button>
    <br/>
    <div id="error" class="alert alert-danger d-none text-center mt-2 w-25">Chọn ngày tháng sinh nhật đi nàooo!</div>
</div>
<div id="thong-tin" class="text-center d-none">
    <hr width="25%"/>
    <img class="sticker" src="" width="100px"/>
    <p></p>
    <strong><h4 id="ten-chom-sao" class="text-danger"></h4></strong>
    <h5 id="ngay-sinh"></h5>
    <p id="mo-ta"></p>
</div>
<script src="<?php echo get_template_directory_uri() . '/inc/horoscope/horoscope.js' ?>"></script>

