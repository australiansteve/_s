<?php
$videoType = get_field('video_type');
$videoId = get_field('video_id');

if ($videoId) :
	if ($videoType == 'vimeo') :
		$videoHtml = "<iframe class=\"responsive\" src='https://player.vimeo.com/video/".$videoId."?color=c02c8b&title=0&byline=0&portrait=0&autoplay=1&loop=0&autopause=0&muted=0&controls=1&background=0' frameborder='0' allow='autoplay; fullscreen; picture-in-picture' muted autoplay></iframe>";

	elseif ($videoType == 'youtube') :
		$videoHtml = "<iframe class='responsive' src='https://www.youtube.com/embed/".$videoId."?autoplay=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope' allowfullscreen></iframe>";
	endif;
endif;

$column_1_class = $args['post_count'] % 2 == 0 ? 'medium-order-2' : 'medium-order-1';
$column_2_class = $args['post_count'] % 2 == 0 ? 'medium-order-1' : 'medium-order-2';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x" data-equalizer="featured-post-<?php echo get_the_ID();?>">
		<div class="medium-6 <?php echo $column_1_class;?>">
			<?php if (get_field('video_id') && has_post_thumbnail()) : ?>
				<a class="watch-now" data-open="video-modal" data-video-html="<?php echo htmlentities($videoHtml, ENT_QUOTES);?>" onclick="showVideo(this)" data-post-link="<?php echo get_the_permalink(); ?>"  data-equalizer-watch="featured-post-<?php echo get_the_ID();?>">
					<?php echo the_post_thumbnail('archive-image'); ?>
					<div class="overlay"></div>
					<i class="fas fa-play"></i>
				</a>
			<?php endif; ?>
		</div>
		<div class="medium-6 <?php echo $column_2_class;?>">
			<div class="grid-y align-center" data-equalizer-watch="featured-post-<?php echo get_the_ID();?>" >
				<div class="cell text-center">
					<h3 class="page-title"><a class="read-more" href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
