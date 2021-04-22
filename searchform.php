<form action="<?php echo site_url('/funds/');?>" method="get" class="search-form">
	<div class="grid-x align-right">
		<div class="cell small-12 medium-9 large-6">
			<div class="input-group">  
  				<input type="text" name="fund-name" id="search" value="<?php the_search_query(); ?>" placeholder="Search Funds"/>
  				<div class="input-group-button">
    				<input type="submit" value="go" id="submit"></input>
  				</div>
			</div>
		</div>		    
	</div>
</form>