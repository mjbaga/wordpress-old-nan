<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<div class="search-bar" data-search="/search/">
	<div class="container">
		<div class="input-form">
			<label for="<?php print $unique_id; ?>" class="vh">Search</label>
			<input placeholder="Enter search term and press enter..." name="searcbar" class="input-text" value="<?php echo get_search_query(); ?>">
		</div>
	</div>
</div>