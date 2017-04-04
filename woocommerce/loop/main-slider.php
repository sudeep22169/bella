<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $bella_options;
?>
<div class="main-slider sub">
    <div class="owl-carousel" id="main-slider">
        <!-- Slide 1 -->
        <?php if(isset($bella_options['woocommerce_slider1']['url'])&& $bella_options['woocommerce_slider1']['url']!=''):?>
        <div class="item slide1 sub">
            <img class="slide-img" src="<?php echo esc_url($bella_options['woocommerce_slider1']['url']); ?>" alt=""/>
            <div class="caption">
                <div class="container">
                    <div class="div-table">
                        <div class="div-cell">
                            <div class="caption-content">
                                <h2 class="caption-title"><span><?php echo esc_attr($bella_options['slider1_title']);?></span></h2>
                                <h3 class="caption-subtitle"><span><?php echo esc_attr($bella_options['slider1_subtitle']);?></span></h3>
                                <p class="caption-text">
                                    <a class="btn btn-theme" href="<?php echo esc_url($bella_options['slider1_buttonurl'])?>"><?php echo esc_attr($bella_options['slider1_button'])?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Slide 1 -->
		<?php endif;?>
        <!-- Slide 2 -->
        <?php if(isset($bella_options['woocommerce_slider2'])&& $bella_options['woocommerce_slider2']['url']!=''):?>
        <div class="item slide2 sub">
            <img class="slide-img" src="<?php echo esc_url($bella_options['woocommerce_slider2']['url']); ?>" alt=""/>
            <div class="caption">
                <div class="container">
                    <div class="div-table">
                        <div class="div-cell">
                            <div class="caption-content">
                                <h2 class="caption-title"><span><?php echo esc_attr($bella_options['slider2_title']);?></span></h2>
                                <h3 class="caption-subtitle"><span><?php echo esc_attr($bella_options['slider2_subtitle']);?></span></h3>
                                <p class="caption-text">
                                    <a class="btn btn-theme" href="<?php echo esc_url($bella_options['slider2_buttonurl'])?>"><?php echo esc_attr($bella_options['slider2_button']);?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Slide 2 -->
<?php endif;?>

    </div>
</div>
