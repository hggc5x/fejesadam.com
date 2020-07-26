<?php
/**
 * Template part for displaying posts in masonry.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Perfect
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-entry' ); ?>>
	<?php
	$featured_image_full_url = '';
	if ( has_post_thumbnail() ) {
		$featured_image_full_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	}
	?>

  <div class="masonry-thumbnail post-item">
		<?php if ( has_post_thumbnail() ) :  ?>
        <a href="<?php echo esc_url( $featured_image_full_url ); ?>" class="post-thumb popup-link">
			<?php the_post_thumbnail( 'large' ); ?>
        </a>
		<?php else : ?>
			<?php
			$no_image_url = '';
			$random_number = rand( 1, 2 );
			$no_image_url = get_template_directory_uri() . '/images/no-image-'. esc_attr( $random_number ). '.png';
			?>
        <a href="<?php the_permalink(); ?>" class="post-thumb">
          <img src="<?php echo esc_url( $no_image_url );?>" alt="<?php the_title_attribute(); ?>" />
        </a>
		<?php endif ?>
    <div class="post-content">
			<?php if ( ! empty( $featured_image_full_url ) ) :  ?>
        <a href="<?php echo esc_url( $featured_image_full_url ); ?>" class="popup-link"><i class="fa fa-eye"></i></a>
			<?php endif ?>
      <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </div>
  </div><!-- .masonry-thumbnail -->

</article><!-- #post-## -->
