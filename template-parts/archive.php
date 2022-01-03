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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (get_field('video_id') && has_post_thumbnail()) : ?>
	<a class="watch-now" data-open="video-modal" data-video-html="<?php echo htmlentities($videoHtml, ENT_QUOTES);?>" onclick="showVideo(this)" data-post-link="<?php echo get_the_permalink(); ?>">
		<?php echo the_post_thumbnail('archive-image'); ?>
		<div class="overlay"></div>
		<i class="fas fa-play"></i>

	</a>
	<?php endif; ?>

	<div class="date"><?php echo get_the_date('j M Y'); ?></div>
	<h3 class="page-title"><?php the_title();?></h3>
	<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
	
	<a class="read-more" href="<?php the_permalink(); ?>"><?php the_field('read_more_text', 'option'); ?></a>
		
</article><!-- #post-<?php the_ID(); ?> -->
