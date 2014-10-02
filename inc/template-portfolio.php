<?php 
/*
Template Name: Portfolio
*/
get_header(); ?>
 
  <div id="page">
 
      <ul id="filters" class="portfolio-filters">
        <?php
            $terms = get_terms("portfolio-categories");
            $count = count($terms);
                echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">All</a></li>';
            if ( $count > 0 ){
 
                foreach ( $terms as $term ) {
 
                    $termname = strtolower($term->name);
                    $termname = str_replace(' ', '-', $termname);
                    echo '<li><a href="javascript:void(0)" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
                }
            }
        ?>
    </ul>
 
    <div id="portfolio">
 
    <?php 
       $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
       $loop = new WP_Query( $args );
         while ( $loop->have_posts() ) : $loop->the_post(); 
 
       $terms = get_the_terms( $post->ID, 'portfolio-categories' );						
            if ( $terms && ! is_wp_error( $terms ) ) : 
 
                $links = array();
 
                foreach ( $terms as $term ) {
                    $links[] = $term->name;
                }
 
                $tax_links = join( " ", str_replace(' ', '-', $links));          
                $tax = strtolower($tax_links);
            else :	
	        $tax = '';					
            endif; 
 
        echo '<div class="all portfolio-item '. $tax .'">';
        if (has_post_thumbnail()) {
            echo '<div class="thumbnail clear">';
            echo '<a href="' . get_permalink() . '" title="' . __('Read ', 'marcus-thompson') . get_the_title() . '" rel="bookmark">';
            echo the_post_thumbnail();
            echo '</a>';
            echo '</div>';
        }
        echo '<div>'. the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ). '</div>';
        echo '<div>'. the_excerpt() .'</div>';
        echo '</div>'; 
      endwhile; ?>
 
   </div><!-- #portfolio -->
 
  </div><!-- #page -->
 
<?php get_footer(); ?>


