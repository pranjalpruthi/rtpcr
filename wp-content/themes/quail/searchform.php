  <form role="search" method="get" class="quick-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="search-field" placeholder="<?php   esc_attr_e ('Search','quail'); ?>" value="<?php echo get_search_query(); ?>" name="s" />  
</form>     