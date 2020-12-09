<div class="grid-x align-center" style="margin: 2rem 0">
	<div class="cell medium-6 large-4">
		<form role="search" method="get" class="search-form" action="/">
			<label>
				<span class="screen-reader-text"><?php echo get_field('sidebar_search_title', 'options');?>:</span>
				<input type="search" class="search-field" placeholder="Search …" value="<?php echo $_GET['s']?>" name="s">
			</label>
			<input type="submit" class="search-submit button" value="Search">
			<input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE;?>">
		</form>
	</div>
</div>