<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo_Perfect
 */

	/**
	 * Hook - photo_perfect_action_after_content
	 *
	 * @hooked photo_perfect_content_end - 10
	 */
	do_action( 'photo_perfect_action_after_content' );
?>

	<?php
	/**
	 * Hook - photo_perfect_action_before_footer.
	 *
	 * @hooked photo_perfect_footer_start - 10
	 */
	do_action( 'photo_perfect_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - photo_perfect_action_footer.
	   *
	   * @hooked photo_perfect_footer_copyright - 10
	   */
	  do_action( 'photo_perfect_action_footer' );
	?>
	<?php
	/**
	 * Hook - photo_perfect_action_after_footer.
	 *
	 * @hooked photo_perfect_footer_end - 10
	 */
	do_action( 'photo_perfect_action_after_footer' );
	?>

<?php
	/**
	 * Hook - photo_perfect_action_after.
	 *
	 * @hooked photo_perfect_page_end - 10
	 * @hooked photo_perfect_footer_goto_top - 20
	 */
	do_action( 'photo_perfect_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
