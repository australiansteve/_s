<?php
get_header();

		$sectionId = 'featured_song';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'upcoming_dates';
		$section = get_field($sectionId);
		if ($section && $section['text']) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'artist_bio';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'playlist';
		$section = get_field($sectionId);
		if ($section && $section['embed_code']) {
			include( locate_template( 'template-parts/section-header.php', false, false ) );
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'instagram_feed';
		$section = get_field($sectionId);
		if ($section && $section['shortcode']) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-shortcode.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'contact';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

		$sectionId = 'declarations';
		$section = get_field($sectionId);
		if ($section && $section['text']) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			include( locate_template( 'template-parts/front-page-'.$sectionId.'.php', false, false ) );
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

get_footer();
