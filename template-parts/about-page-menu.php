<div class="text-center">
	<ul id="about-menu-small" class="vertical menu accordion-menu show-for-small-only about-menu" data-accordion-menu>
		<li>
			<a href="#"><span><?php the_title(); ?></span></a>

			<ul class="menu vertical nested">
				<li class="accordion-divider"></li>
				<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'about-menu',
						'container'		=> false,
						'items_wrap' => '%3$s'
					)
				);
				?>
			</ul>
		</li>
	</ul>

	<ul id="about-menu-medium" class="menu horizontal show-for-medium about-menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location'	=> 'about-menu',
				'container'		=> false,
				'items_wrap' => '%3$s'
			)
		);
		?>
	</ul>

</div>