<?php
/**
 * @package MarcusThompson
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="index-box">
            <?php 
            if (has_post_thumbnail()) {
                echo '<div class="small-index-thumbnail clear">';
                echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'marcus-thompson') . get_the_title() . '" rel="bookmark">';
                echo the_post_thumbnail('index-thumb');
                echo '</a>';
                echo '</div>';
            }
            ?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php marcus_thompson_posted_on(); ?>
                        <?php 
                            if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                                echo '<span class="comments-link">';
                                comments_popup_link( __( 'Leave a comment', 'marcus-thompson' ), __( '1 Comment', 'marcus-thompson' ), __( '% Comments', 'marcus-thompson' ) );
                                echo '</span>';
                            }
                        ?>
                        <?php edit_post_link( __( 'Edit', 'marcus-thompson' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'marcus-thompson' ),
				'after'  => '</div>',
			) );
		?>
	<footer class="entry-footer continue-reading">
    <?php echo '<a href="' . get_permalink() . '" title="' . __('Continue Reading ', 'marcus-thompson') . get_the_title() . '" rel="bookmark">Continue Reading<i class="fa fa-arrow-circle-o-right"></i></a>'; ?>
</footer><!-- .entry-footer -->
	</footer><!-- .entry-footer -->
        </div><!-- .index-box -->
</article><!-- #post-## -->