<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Perfect
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		<?php
		/**
		 * Hook - photo_perfect_action_before_loop.
		 *
		 * @hooked: photo_perfect_add_masonry_wrap_start - 10
		 */
		do_action( 'photo_perfect_action_before_loop' );
		?>

			<?php while ( have_posts() ) : the_post(); ?>

		<?php
		  /**
		   * Hook - photo_perfect_action_loop.
		   *
		   * @hooked: photo_perfect_load_archive_loop_content - 10
		   */
		  do_action( 'photo_perfect_action_loop' );
		?>

			<?php endwhile; ?>

		<?php
		/**
		 * Hook - photo_perfect_action_after_loop.
		 *
		 * @hooked: photo_perfect_add_masonry_wrap_end - 10
		 */
		do_action( 'photo_perfect_action_after_loop' );
		?>

		<?php
		/**
		 * Hook - photo_perfect_action_posts_navigation.
		 *
		 * @hooked: photo_perfect_custom_posts_navigation - 10
		 */
		do_action( 'photo_perfect_action_posts_navigation' );?>


		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - photo_perfect_action_sidebar.
	 *
	 * @hooked: photo_perfect_add_sidebar - 10
	 */
	do_action( 'photo_perfect_action_sidebar' );
?>
<?php get_footer(); ?>
