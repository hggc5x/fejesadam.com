<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Photo_Perfect
 */

?>
<?php
	global $photo_perfect_post_count;
	$odd_or_even = ( 0 === $photo_perfect_post_count % 2 ) ? 'even' : 'odd' ;
	// Increase count.
	$photo_perfect_post_count++;
	?>
  <article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-' . $odd_or_even ); ?>>

		<?php if ( has_post_thumbnail() && 'odd' === $odd_or_even ) :  ?>
        <div class="thumb-archive">
	        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
        </div>
		<?php endif ?>
    <div class="archive-content">

      <header class="entry-header">
			<?php if ( 'post' === get_post_type() ) : ?>
            <?php photo_perfect_show_post_categories(); ?>
			<?php endif; ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
          <div class="entry-meta">
            <?php photo_perfect_posted_on(); ?>
          </div><!-- .entry-meta -->
			<?php endif; ?>
      </header>
      <div class="entry-content">
		<?php the_excerpt(); ?>
     </div>
    </div>
    <?php if ( has_post_thumbnail() && 'even' === $odd_or_even ) :  ?>
      <div class="thumb-archive">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
      </div>
    <?php endif ?>


</article><!-- #post-## -->
