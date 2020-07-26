<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Perfect
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
    <?php
	  /**
	   * Hook - photo_perfect_single_image hook.
	   *
	   * @hooked photo_perfect_add_image_in_single_display -  10
	   */
	  do_action( 'photo_perfect_single_image' );
	?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span>' . esc_html__( 'Pages:', 'photo-perfect' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php photo_perfect_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
