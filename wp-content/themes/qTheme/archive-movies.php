<?php get_header(); ?>

<section class="movies-list">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<?php
		// Data
		$movie_title 	= get_post_meta($post->ID, 'q_movie_title', true);
		$movie_att_id 	= attachment_url_to_postid( get_the_post_thumbnail_url() );
		$movie_image 	= wp_get_attachment_image($movie_att_id, 'full');
	?>
		<div class="movies-list__item">
			<figure><?php echo $movie_image; ?></figure>
			<h2><?php echo $movie_title ? $movie_title : 'Movie title'; ?></h2>
			<div><?php the_content(); ?></div>
		</div>
<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>