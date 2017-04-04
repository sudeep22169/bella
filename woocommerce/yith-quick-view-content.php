<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

<div class="product-single">

	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php do_action( 'yith_wcqv_product_image' ); ?>

		<div class="col-md-6 summary entry-summary">
			<?php do_action( 'yith_wcqv_product_summary' ); ?>
		</div>

	</div>

</div>

<?php endwhile; // end of the loop.