<?php
/**
* Cart Page
*
* @author 		WooThemes
* @package 	WooCommerce/Templates
* @version     2.3.8
*/

if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
} $index=1;
?>
<?php if (!is_user_logged_in()) : ?>  
         
     <?php wc_get_template( 'myaccount/form-login.php' ); ?>
   
<?php $index++;endif;?>
<h3 class="block-title alt"><i class="fa fa-angle-down"></i><?php echo $index.'. Orders';?></h3>
<?php wc_print_notices();
do_action( 'woocommerce_before_cart' ); ?>
<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
  <?php do_action( 'woocommerce_before_cart_table' ); ?>
  <div class="row orders">
  <div  class="col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th><?php _e( 'Image', 'woocommerce' ); ?></th>
          <th><?php _e( 'Quantity', 'woocommerce' ); ?></th>
          <th><?php _e( 'Product Name', 'woocommerce' ); ?></th>
          <th><?php _e( 'Total', 'woocommerce' ); ?></th>
        </tr>
      </thead>
      <tbody>
          <?php do_action( 'woocommerce_before_cart_contents' ); ?>
          <?php
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
              ?>
          <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
            <td class="image"><?php
                          $thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(array(70,100)), $cart_item, $cart_item_key );
                          if ( ! $_product->is_visible() )
                              echo $thumbnail;
                          else
                              printf( '<a class="media-link" href="%s"><i class="fa fa-plus"></i>%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                      ?>
               </td>
            <td class="quantity"><?php
                          if ( $_product->is_sold_individually() ) {
                              $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                          } else {
                              $product_quantity = woocommerce_quantity_input( array(
                                  'input_name'  => "cart[{$cart_item_key}][qty]",
                                  'input_value' => $cart_item['quantity'],
                                  'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                  'min_value'   => '0'
                              ), $_product, false );
                          }

                          echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                      ?></td>
            <td class="description"><h4><?php
                          if ( ! $_product->is_visible() )
                              echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                          else
                              echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

                          // Meta data
                          echo WC()->cart->get_item_data( $cart_item );

                          // Backorder notification
                          if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                              echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
                      ?></h4>
                      <?php  $size = sizeof( get_the_terms( get_the_ID(), 'product_cat' ) );
                      echo $_product->get_categories( ', ', '<span class="posted_in">' . _n( 'by', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );?>
                      </td>
            <td class="total"><?php
                          echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                          
                  
                          echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                      
              
                      ?></td>
          </tr>
          <?php
          }
      }
?>
        </tbody>
      </table>
    </div>
    <?php
      do_action( 'woocommerce_cart_contents' );
      ?>
    <div class="col-md-4">
      <?php do_action( 'woocommerce_cart_collaterals' ); ?>
     
    </div>
    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </tbody>
    </table>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </div>
  </form>
  <?php do_action( 'woocommerce_after_cart' ); ?>


 <?php do_action('woocommerce_proceed_to_checkout'); ?>

  
             
 
               
           
      
			 
			 
            