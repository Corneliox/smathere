<div class="search-wrapper">
	<form method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<input type="text" name="s" size="20" class="search-textbox" placeholder="<?php esc_attr_e( 'Search...', 'fkidd' ); ?>" tabindex="1" required />
		<button type="submit" class="search-button"></button>
	</form>
</div>