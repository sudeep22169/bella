<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h3 class="block-title">
    <span>
	<?php _e( 'SHOPPING CART', 'woocommerce' ); ?>
    </span>
    </h3>
    
     <div class="shopping-cart">
	<table>

		<tbody>
          <tr>
			<td><?php _e( 'SUB-TOTAL:', 'woocommerce' ); ?></td>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>
            
            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?> 

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
         <tr>
          <?php if ( is_cart() ) : ?>
			<td><?php woocommerce_shipping_calculator(); ?></td>
		<?php endif; ?>
        
        </tr>

		<?php endif; ?>
        </tbody>
        <tfoot>
        	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr>
			<td><?php _e( 'Order Total', 'woocommerce' ); ?></td>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>
        
        
          </tfoot>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
        	</table>
         <div class="form-group">
            <textarea class="form-control" placeholder="Send a Message"></textarea>
         </div>
              
                <div class="form-group">
				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						 <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php _e( 'Enter your coupon code', 'woocommerce' ); ?>" /> 
                         	</div>
                            </div>    
                         <input type="submit" class="btn btn-theme btn-theme-dark btn-block" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

				
				<?php } ?>

		<!--		<input type="submit" class="button" name="update_cart" value="<?php  //_e( 'Update Cart', 'woocommerce' ); ?>" />  -->

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			
     
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		
     <div class="form-group">
		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>
      </div>        

		<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php echo wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

	


	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php

			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
				: '';

			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

		?></small></p>
	<?php endif; ?>
    </div>

<!--	<div class="wc-proceed-to-checkout">

		<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>

	</div>  -->

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
