<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Photo_Perfect
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
           <h2><?php esc_html_e( '404', 'photo-perfect' ); ?></h2>
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photo-perfect' ); ?></h1>

				</header><!-- .page-header -->

				<div class="page-content">

          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'photo-perfect' ); ?></p>

			<?php get_search_form(); ?>

			<?php
			wp_nav_menu( array(
				'theme_location' => 'notfound',
				'depth'          => 1,
				'fallback_cb'    => false,
				'container'      => 'div',
				'container_id'   => 'quick-links-404',
				)
			);
			?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
