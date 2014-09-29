<?php
/**
 * @package MarcusThompson
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="index-box">
            
	<header class="entry-header">
            
            <?php 
                if (is_sticky ()) {
                    echo '<i class="fa fa-thumb-tack sticky-post"></i>';
                }
            ?>    
            
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'marcus-thompson' ),
				'after'  => '</div>',
			) );
		?>
	<footer class="entry-footer continue-reading">
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
                    
</footer><!-- .entry-footer -->
	</footer><!-- .entry-footer -->
        </div><!-- .index-box -->
</article><!-- #post-## -->