<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>       
<?php  global $bella_options; ?>
    </div><!--content-area-->
      <!--Begin Footer-->
      <footer class="footer">
       <div class="footer-widgets" <?php if(isset($bella_options['footer-on']) && $bella_options['footer-on']!=1) echo 'style="display:none;"';?>>
            <!-- BEGIN BOTTOM FOOTER -->
            <div class="container">
                <?php get_template_part('partials/footer-layout'); ?>
                        
            </div>

          <!-- <p id="back-top"><a href="#home"><i class="fa fa-angle-up"></i></a></p>  -->     
       </div>
       
       <div class="footer-meta" <?php if(isset($bella_options['secondfooter-on']) && $bella_options['secondfooter-on']!=1) echo 'style="display:none;"';?> >
                                  
       		<div class="container">
	            <?php if(isset($bella_options['footer-logo']['url']) && $bella_options['footer-logo']['url']!='') :  ?> 
	            <!-- BEGIN: LOGO FOOTER -->
	            <div class="logo-footer">
	                 <img src="<?php echo esc_url($bella_options['footer-logo']['url']); ?>" data-at2x="<?php echo esc_url($bella_options['footer-retinalogo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
	                 
	                 <ul class="contacts-footer">
	                    <?php if(isset($bella_options['footer-email']) && $bella_options['footer-email']!='') :  ?> 
	                 	<li><i class="fa fa-envelope-o"></i> <?php echo esc_attr($bella_options['footer-email']); ?></li> 
	                    <?php endif; ?>
	                    <?php if(isset($bella_options['footer-phone']) && $bella_options['footer-phone']!='') :  ?> 
	                 	<li><i class="fa fa-phone"></i> <?php echo esc_attr($bella_options['footer-phone']); ?></li>
	                    <?php endif; ?>
	                 
	                 </ul>
	                 
	            </div><!--logo footer-->
	            <?php endif; ?>
                  <div class="row">

                            <div class="col-sm-6">
                             <?php if(isset($bella_options['footer_text'])) :  ?> 
                                <div class="copyright">
                                <?php  echo wp_kses_post($bella_options['footer_text']); ?>
                                </div>
                        <?php endif; ?>
                            </div>
                        <?php if (isset($bella_options['visa-icons'])) : ?> 
                            <div class="col-sm-6">
                                <div class="payments">
                                    <ul>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/visa.jpg'?>" alt=""/></li>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/mastercard.jpg'?>" alt=""/></li>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/paypal.jpg'?>" alt=""/></li>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/american-express.jpg'?>" alt=""/></li>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/visa-electron.jpg'?>" alt=""/></li>
                                        <li><img src="<?php echo get_template_directory_uri().'/assets/img/preview/payments/maestro.jpg'?>" alt=""/></li>
                                    </ul>
                                </div><!--payments-->
                            </div><!--col-sm-6-->
                        <?php endif;?>

                </div><!--row-->
                
	             
	        </div>
	        <!-- END CONTAINER -->
	   </div><!-- END BOTTOM FOOTER -->
	  </footer>
        <!--End Footer-->
      <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
     </div><!--wrapper-->
    <?php if(isset($bella_options['meta_javascript']) && $bella_options['meta_javascript']!='') 
    echo $bella_options['meta_javascript']; ?>  
    <?php wp_footer(); ?>
    </body>
</html>