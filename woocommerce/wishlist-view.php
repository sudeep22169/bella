<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */
$url=get_permalink( woocommerce_get_page_id( 'shop' ) );
?>
<section class="page-section color no-padding-bottom">   
  <div class="row wishlist">
    <div class="col-md-12">
        <form id="yith-wcwl-form" action="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'view' . ( $wishlist_meta['is_default'] != 1 ? '/' . $wishlist_meta['wishlist_token'] : '' ) ) ) ?>" method="post">
<!-- TITLE -->
  
  <!-- WISHLIST TABLE -->
  
          <table class="table">
            <thead>
              <tr>
                <th><?php _e('Image','bella')?></th>
                <th><?php _e('Product Name','bella')?></th>
                <th><?php _e('Unit Price','bella')?></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
        if( count( $wishlist_items ) > 0 ) :
            foreach( $wishlist_items as $item ) :
                global $product;
	            if( function_exists( 'wc_get_product' ) ) {
		            $product = wc_get_product( $item['prod_id'] );
	            }
	            else{
		            $product = get_product( $item['prod_id'] );
	            }

                if( $product !== false && $product->exists() ) :
	                $availability = $product->get_availability();
	                $stock_status = $availability['class'];
	                ?>
              <tr id="yith-wcwl-row-<?php echo $item['prod_id'] ?>" data-row-id="<?php echo $item['prod_id'] ?>">
                <td class="image"><a  class="media-link "href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><i class="fa fa-plus"></i> <?php echo $product->get_image(array(70,100)) ?> </a></td>
                <td class="description"><h4> <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a> </h4>
                      <?php
                $size = sizeof( get_the_terms( get_the_ID(), 'product_cat' ) );
                echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'by', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );?>
                </td>
                <?php if( $show_price ) : ?>
                <td class="price"><?php
                    if( $product->price != '0' ) {
                        $wc_price = function_exists('wc_price') ? 'wc_price' : 'woocommerce_price';

                        if( $price_excl_tax ) {
                            echo apply_filters( 'woocommerce_cart_item_price_html', $wc_price( $product->get_price_excluding_tax() ), $item, '' );
                        }
                        else {
                            echo apply_filters( 'woocommerce_cart_item_price_html', $wc_price( $product->get_price() ), $item, '' );
                        }
                    }
                    else {
                        echo apply_filters( 'yith_free_text', __( 'Free!', 'yit' ) );
                    }
                    ?></td>
                <?php endif ?>
                <?php /*if( $show_stock_status ) : ?>
                            <td class="product-stock-status">
                                <?php
                                if( $stock_status == 'out-of-stock' ) {
                                    $stock_status = "Out";
                                    echo '<span class="wishlist-out-of-stock">' . __( 'Out of Stock', 'yit' ) . '</span>';
                                } else {
                                    $stock_status = "In";
                                    echo '<span class="wishlist-in-stock">' . __( 'In Stock', 'yit' ) . '</span>';
                                }
                                ?>
                            </td>
                        <?php endif */?>
                <?php if( $show_add_to_cart ) : ?>
                <td class="add"><?php if( isset( $stock_status ) && $stock_status != 'Out' ): ?>
                  <?php
                   global $product;
                    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn btn-theme btn-theme-dark btn-icon-left %s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>',
                            esc_url( $product->add_to_cart_url() ),
                            esc_attr( $product->id ),
                            esc_attr( $product->get_sku() ),
                            esc_attr( isset( $quantity ) ? $quantity : 1 ),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            esc_attr( $product->product_type ),
                            esc_html( $product->add_to_cart_text() )
                        ),
                    $product );
                    ?>
                  <?php endif ?></td>
                <?php if( $is_user_owner ): ?>
                <td class="total"><div> <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove remove_from_wishlist" title="<?php _e( 'Remove this product', 'yit' ) ?>">&times;</a> </div></td>
                <?php endif; ?>
                <?php endif ?>
              </tr>
              <?php
                endif;
            endforeach;
        else: ?>
              <?php
        endif;

        if( ! empty( $page_links ) ) : ?>
              <tr>
                <td colspan="6"><?php echo $page_links ?></td>
              </tr>
              <?php endif ?>
              <?php /*if( $is_user_logged_in ): ?>
            <tfoot>
            <tr>
                <?php if ( $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ) : ?>
                    <td colspan="<?php echo ( $is_user_logged_in && $is_user_owner && $show_ask_estimate_button && $count > 0 ) ? 4 : 6 ?>">
                        <?php yith_wcwl_get_template( 'share.php', $share_atts ); ?>
                    </td>
                <?php endif; ?>

                <?php
                if ( $is_user_owner && $show_ask_estimate_button && $count > 0 ): ?>
                    <td colspan="<?php echo ( $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ) ? 2 : 6 ?>">
                        <a href="<?php echo $ask_estimate_url ?>" class="btn button ask-an-estimate-button">
                            <?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
                            <?php _e( 'Ask an estimate of costs', 'yit' ) ?>
                        </a>
                    </td>
                <?php
                endif;

                do_action( 'yith_wcwl_after_wishlist_share' );
                ?>
            </tr>
            </tfoot>
        <?php endif; */?>
                </tr>
              
            </tbody>
          </table>
          <a class="btn btn-theme btn-theme-transparent btn-icon-left btn-continue-shopping" href="<?php echo $url; ?>"><i class="fa fa-shopping-cart"></i>Continue shopping</a>
          <?php wp_nonce_field( 'yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist' ); ?>
          <?php if( $wishlist_meta['is_default'] != 1 ): ?>
          <input type="hidden" value="<?php echo $wishlist_meta['wishlist_token'] ?>" name="wishlist_id" id="wishlist_id">
          <?php endif; ?>
          <?php do_action( 'yith_wcwl_after_wishlist' ); ?>
      
        </form>
      </div>
    </div>

</section>
