<?php // Exit if accessed directly

if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>



<?php if (comments_open()) : ?>

 <section class="page-section no-padding-bottom">

		  <?php if ( post_password_required() ):?>

          <p class="nocomments">This post is password protected. Enter the password to view comments.</p>

          <?php

          return;

          endif;

        $ncom = get_comments_number();

      if ( have_comments() ) : ?>

             <h4 class="block-title"><span><?php _e('Comments','bella');?><span class="thin">

                <?php echo '(';	if ($ncom==1) { _e('1', 'bella'); echo ' Comment';}  

                else{echo sprintf (__('%s','bella'), $ncom); echo ' Comments';}

                echo ')';?></span></span>

             </h4>                     

         <?php if ($ncom >= get_option('comments_per_page') && get_option('page_comments')) : ?>

                <nav id="comment-nav-above">

                    <?php paginate_comments_links(); ?>

                </nav>

          <?php endif; ?>

           

           <div class="comments">

             <?php                                         

              $args = array (

              'paged' => true,

              'avatar_size'       => 70,

              'style'             => 'div',

              'callback'=> 'bella_comment',

              'end-callback'  => 'bella_comment_end',

              'per_page' =>'8',

              );

              wp_list_comments($args);  ?>      

                                          

           </div>

           

         <?php if ($ncom >= get_option('comments_per_page') && get_option( 'page_comments' ) ) : ?>

                <nav id="comment-nav-below">

                    <?php paginate_comments_links(); ?>

                </nav>

         <?php endif; ?>

          <?php else : ?>

           

          <?php if ('open' == $post->comment_status) : ?>

        

           

          <?php else : // comments are closed ?>

          <!-- If comments are closed. -->

          <p class="nocomments"><?php _e('Comments are closed.','bella')?></p>

           

          <?php endif; ?>

          <?php endif; ?>

          <?php if ('open' == $post->comment_status) : ?>    

              

                <?php

                  $commenter = wp_get_current_commenter();



                  $comment_form = array(

                    'title_reply'          =>  __( '<h4 class="block-title">Submit Your Comment</h4>', 'bella' )  ,

                    'title_reply_to'       => __( 'Leave a Reply to %s', 'bella' ),

                    'comment_notes_before' => '',

                    'comment_notes_after'  => '',

                    'fields'               => array(

                      'author' => '<div class="form-group"><input type="text" name="author" title="comments-form-name" class="form-control" placeholder="Your name and surname" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '"   tabindex="1" aria-required="true" /></div>',

      

                      'email'  => '<div class="form-group"><input type="text"placeholder="Your email adress"  name="email" class="form-control" title="comments-form-email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"  tabindex="2" aria-required="true"/></div>',

                    ),

                    'label_submit'  => '',

                    'logged_in_as' =>  sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','bella'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink($post->ID) ) ) ),

                    'comment_field' => ''

                  );

                  $comment_form['comment_field'] .= '<div class="form-group"><textarea name="comment"  placeholder="Your message"class="form-control" title="comments-form-comments" id="comment"  rows="6" tabindex="4"></textarea></div>

                           

                                                <div class="form-group"><button name="submit" class="btn btn-theme btn-theme-transparent btn-icon-left" type="submit" id="submit" tabindex="5"  ><i class="fa fa-comment"></i>Send Comment</button> </div>';

                  
                  ob_start();
                  comment_form(  $comment_form  );
                  echo str_replace('class="comment-form"','class="comments-form "',ob_get_clean());

                ?>

             

         

      <?php endif; ?> 

       

  </section>	



<?php endif;?>