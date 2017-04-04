<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
<?php  global $flagfooter ; $check_quote=0;?>

    <?php if(!is_single()):?>  
        <article  <?php post_class("post-wrap"); ?>>
    <?php  else:   ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class("post-wrap post-single"); ?>>
    <?php endif;?>
     <div class="post-media">     
        
        <?php if ( has_post_format('gallery') ) :  
            if ( get_post_gallery() ) :
                $gallery = get_post_gallery( get_the_ID(), false ); ?>               
                <div class="owl-carousel img-carousel">
                    <?php foreach( $gallery['src'] AS $src ):?>
                        <div class="item"><a href="<?php echo esc_url($src); ?>" data-gal="prettyPhoto"><img class="img-responsive" src="<?php echo esc_url($src);; ?>" /></a></div>        
                    <?php endforeach;?>
                </div>
            <?php   endif;?>
        <?php   endif;  ?>
        
        <?php if (has_post_format('quote')) :  ?>        
            <blockquote><?php echo  the_content(); ?></blockquote>   
            <?php echo esc_attr(get_post_meta( $post->ID, 'q_author', true )); ?>
            <?php $check_quote=1;?>        
        
        <?php else : ?>                      
            <?php if (has_post_thumbnail() && !has_post_format('video') && !has_post_format('quote') && !has_post_format('audio')&&(!is_single() || !is_page())) :       
            $att = get_post_meta(get_the_ID(),'_thumbnail_id',true);
            $thumb = get_post($att);
            if (is_object($thumb)) { $att_ID = $thumb->ID; $att_url = $thumb->guid; }
            else { $att_ID = $post->ID; $att_url = $post->guid; }
            $att_title = (!empty(get_post($att_ID)->post_excerpt)) ? get_post($att_ID)->post_excerpt : get_the_title($att_ID); ?>
            
            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())) ?>" data-gal="prettyPhoto">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt'=>'','class'=>"",'title'=> '')); ?>
            </a>
        <?php endif; ?>

        <?php if (has_post_format('link')) :?>
            <div class="post-link">
                <span class="link-title"><?php echo esc_attr(get_post_meta( $post->ID, 'link_title', true )); ?></span>
                <a class="alert alert-success" href="<?php echo esc_attr(get_post_meta( $post->ID, 'l_url', true )); ?>"><?php echo esc_attr(get_post_meta( $post->ID, 'l_url', true )); ?></a>
            </div>
        <?php endif; ?>     
       
        <?php if (has_post_format('video')) : 
            $videoID = get_post_meta( $post->ID, 'video_id', true );         
            if (has_post_thumbnail()):?>                                    
                <a href="<?php echo esc_url($videoID); ?>" data-gal="prettyPhoto" class="media-link">
                    <span class="btn btn-play"><i class="fa fa-play"></i></span>
                    <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" alt="">        
                </a>        
            <?php else:
                $videoID = get_post_meta( $post->ID, 'video_id', true ); ?>      
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?php echo esc_url($videoID);?>"></iframe>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if (has_post_format('audio')) : 
            $audioID = get_post_meta( $post->ID, 'audio_id', true ); 
            echo wp_oembed_get(  $audioID ); 
        endif; ?>
        <?php endif; ?>                                    

    </div>  
    <?php if(bella_detect_woocommerce()!=true ) : ?>                  
    <div class="post-header">
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
         
        <div class="post-meta">
            <?php _e('By ','bella')?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author() ?></a><?php _e(' / ','bella')?> 
            <?php echo get_the_date('jS M Y') ?><?php _e(' / in ','bella')?>
            <?php if (get_the_category()) : ?>                        
                <?php the_category(',');
            endif; ?><?php _e(' / ','bella')?>
            <a href="<?php the_permalink(); ?>">
                <?php echo get_comments_number(); 
                if (get_comments_number()>1): echo ' comments';
                else: echo ' comment'; endif;?> 
            </a> 
        </div>
        
    </div>
    <?php endif;?>
     <?php if ($check_quote==0) : ?>
        <div class="post-body">
            <div class="post-excerpt">
            <?php // If displaying a single post or a page
            if (is_single() OR is_page()) :

            if(has_post_format('gallery')):
                $postContentStr = apply_filters('the_content', strip_shortcodes($post->post_content));
                echo wp_kses_post($postContentStr);
            else:
                the_content(); ?>
<br>

            <?php endif;

            wp_link_pages(array(
            'next_or_number' => 'number',
            'nextpagelink' => __('Next page', 'dikka'),
            'previouspagelink' => __('Previous page', 'dikka'),
            'pagelink' => '%',
            'link_before' => '<span class="ft-btn">',
            'link_after' => '</span>',
            'before' => '<div class="clearfix"></div>' . __('Pages:', 'dikka') . ' <div class="ft-article-pages">',
            'after' => '</div>'
            ));

            else :
                
                    the_excerpt ();
            endif; ?>  
            </div>
        </div>
      <?php endif; ?>
      <?php if (!is_single() && (bella_detect_woocommerce()!=true)):?>
            <div class="post-footer">
                <span class="post-read-more"><a href="<?php echo the_permalink();?>" class="btn btn-theme btn-theme-transparent btn-icon-left"><i class="fa fa-file-text-o"></i><?php _e('Read more','dikka')?></a></span>
            </div>
      <?php endif;?>
     </article>     
