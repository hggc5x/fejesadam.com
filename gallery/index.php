<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Perfect
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

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
