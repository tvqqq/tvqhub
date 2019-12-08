<form class="form-inline justify-content-center mb-5" method="get" action="<?php echo home_url('/') ?>">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..."
               aria-describedby="button-search" name="s" id="search" value="<?php echo get_search_query(); ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" id="button-search" type="submit" id="searchsubmit"
                    value="<?php esc_attr_e('Search', 'tvqwp') ?>"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
