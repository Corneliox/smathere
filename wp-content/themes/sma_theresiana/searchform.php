<?php
/**
 * Template for displaying search forms in SMA Theresiana theme
 *
 * @package sma_theresiana
 */

?>
<form role="search" method="get" class="th-header-search th-custom-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="width:100%; max-width:400px; background: rgba(0,0,0,0.05); padding: 8px 16px;">
	<input type="search" class="th-header-search__field" style="width: 100%; color: var(--th-gray-900);" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'sma-theresiana' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="th-header-search__submit" style="color: var(--th-green-600);" aria-label="Submit Search">
		<i class="fa fa-search" aria-hidden="true"></i>
	</button>
</form>
