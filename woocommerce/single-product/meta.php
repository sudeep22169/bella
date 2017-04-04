<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product,$bella_options;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?><?php do_action( 'woocommerce_product_meta_start' ); ?>
<table class="prod-meta-tbl">
	<tr>
    <?php $cat=$product->get_categories( ' - ', '<td class="title">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) .'</td><td>' , '</td>' ); ?>
	<?php echo esc_url($cat);
	echo $cat;?>
    <tr>
        <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
              <td class="title"><?php _e( 'Product Code:', 'woocommerce' ); ?></td>
              <td><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></td>
		<?php endif; ?>
     </tr>

	</tr>
    <tr>
   <?php echo $product->get_tags( ' - ', '<td class="title">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) .'</td><td>','</td>' ); ?>

	
	</tr>
    <tr>
	<?php //echo $product->get_product o( ', ', '<td class="title">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</td>' ); ?>
	</tr>
</table>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

 <hr class="page-divider small"/>
 
  <ul class="social-icons">
      <?php if (!empty($bella_options['social_facebook'])) : ?>
        <li><a class="facebook" href="<?php  echo esc_url($bella_options['social_facebook']); ?>"  title=""><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_twitter'])) : ?>
        <li><a class="twitter" href="<?php  echo esc_url($bella_options['social_twitter']); ?>"  title=""><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_googlep'])) : ?>
        <li><a class="google" href="<?php  echo esc_url($bella_options['social_googlep']); ?>" title=""><i class="fa fa-google"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_pinterest'])) : ?>
        <li><a class="pinterest" href="<?php  echo esc_url($bella_options['social_pinterest']); ?>"  title=""><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_linkedin'])) : ?>
        <li><a class="linkedin" href="<?php  echo esc_url($bella_options['social_linkedin']); ?>"  title=""><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_instagram'])) : ?>
        <li><a class="instagram" href="<?php  echo esc_url($bella_options['social_instagram']); ?>"  title=""><i class="fa fa-instagram"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_dribbble'])) : ?>
        <li><a class="dribbble" href="<?php  echo esc_url($bella_options['social_dribbble']); ?>" title=""><i class="fa fa-dribbble"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_tumblr'])) : ?>
        <li><a class="tumblr" href="<?php  echo esc_url($bella_options['social_tumblr']); ?>" title=""><i class="fa fa-tumblr"></i></a></li>
        <?php endif; ?><?php if (!empty($bella_options['social_skype'])) : ?>
        <li><a class="skype" href="<?php  echo esc_url($bella_options['social_skype']); ?>" title=""><i class="fa fa-skype"></i></a></li>
        <?php endif; ?>                           
  </ul><!-- end right -->    