<?php

/**

 * Display single product reviews (comments)

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     2.3.2

 */

global $product;



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



if ( ! comments_open() ) {

	return;

}



?>

<div id="reviews">

	<div id="comments">

		<h2><?php

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )

				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );

			else

				_e( 'Reviews', 'woocommerce' );

		?></h2>



		<?php if ( have_comments() ) : ?>

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



			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

				echo '<nav class="woocommerce-pagination">';

				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(

					'prev_text' => '&larr;',

					'next_text' => '&rarr;',

					'type'      => 'list',

				) ) );

				echo '</nav>';

			endif; ?>



		<?php else : ?>



			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>



		<?php endif; ?>

	</div>



	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>



		

		 

				<?php

					$commenter = wp_get_current_commenter();



					$comment_form = array(						

						'title_reply'          => '<h4 class="block-title">Add a Review</h4>',

						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),

						'comment_notes_before' => '',

						

						'fields'               => array(

							'author' => '<div class="form-group"><input id="author" name="author" type="text" placeholder="Your name and surname" class="form-control" title="comments-form-name" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div>',

							'email'  => '<div class="form-group"><input id="email" name="email" type="text" placeholder="Your email adress" class="form-control" title="comments-form-email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',

						),

						'comment_notes_after' => '<div class="form-group"><button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left" id="submit"><i class="fa fa-comment"></i>'.__('Review').'</button>' ,

    

						

						'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','dikka'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink($post->ID) ) ) ) . '</p>',

            

						'comment_field' => ''

					);

                      

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">

							<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>

							<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>

							<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>

							<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>

							<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>

							<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>

						</select></p>';

					}

                   

					$comment_form['comment_field'] .= '<div class="form-group"><textarea id="comment" placeholder="Your message" class="form-control" name="comment"  rows="6" aria-required="true"></textarea></div>';



				
					ob_start();
                  	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                  	echo str_replace('class="comment-form"','class="comments-form "',ob_get_clean());

				?>

			



	<?php else : ?>



		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>



	<?php endif; ?>



	<div class="clear"></div>

</div>

