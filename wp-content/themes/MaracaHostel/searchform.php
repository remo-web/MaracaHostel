<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
    <div class="input-group">
        <input type="text" value="" name="s" class="form-control" placeholder="<?php esc_html_e('Search', 'zozothemes'); ?>" />
        <span class="input-group-btn">
            <button class="btn btn-search" type="submit"><?php esc_html_e('Go', 'zozothemes'); ?></button>
        </span>
    </div>
</form>