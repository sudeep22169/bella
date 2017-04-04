<?php global $bella_options;?>
  <div class="row thumbnails portfolio">
     <?php $custom_taxterms = wp_get_object_terms( $post->ID, 'portfolio_categories', array('fields' => 'ids') );
      // arguments
      $args = array(
      'post_type' => 'portfolio',
      'post_status' => 'publish',
      'posts_per_page' => 3, // you may edit this number
      'orderby' => 'rand',
      'tax_query' => array(
          array(
              'taxonomy' => 'portfolio_categories',
              'field' => 'id',
              'terms' => $custom_taxterms,
              
          )
      ),
      'post__not_in' => array ($post->ID),
      );
      $related_items = new WP_Query( $args );  
          if( $related_items->have_posts() ) :
        
            while( $related_items->have_posts() )  :  
          
            $related_items->the_post(); ?>
            <?php 
             $terms = get_the_terms($post->ID, 'portfolio_categories' );
            if ($terms && ! is_wp_error($terms)) :
              $term_slugs_arr = array();
              $num=count($terms);
              foreach ($terms as $term) {
                $term_slugs_arr[] = $term->slug;
              }
              $terms_slug_str = join( " ", $term_slugs_arr);
            endif;?>
          
             <div class="col-sm-6 col-md-3">
                <div class="thumbnail no-border no-padding">
                  <div class="media">
                       <?php the_post_thumbnail('portfolio-related-thumbnails'); ?> 
                       <div class="caption hovered">  
                         <div class="caption-wrapper div-table">
                            <div class="caption-inner div-cell">
                             <h3 class="caption-title"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h3>
                             <p class="caption-category">
                            <?php if($terms!=null)
                            foreach ($terms as $term) {
                                    $num--;?>
                                  <a href="<?php the_permalink();?>"><?php echo $term->slug;?></a>
                            <?php if($num!=0)
                                  echo ',';
                            }?> </p>
                            <p class="caption-buttons">
                                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
                                <a href="<?php the_permalink();?>" class="btn caption-link"><i class="fa fa-link"></i></a>
                            </p>
                        </div>
                       </div>
                   </div> 
                </div>
              </div>
           </div>
        <?php endwhile;
      endif
     ?>                
    
    </div> 