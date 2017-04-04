<div class="partners-carousel">
    <div class="owl-carousel" id="partners">
		<?php foreach( $instance['images'] as $i => $image ) : 
		$src = wp_get_attachment_image_src($image['client_image'], 'full');?>
		<?php 
		$alt = get_post_meta($image['client_image'], '_wp_attachment_image_alt', true);
		?>
		                <img src="<?php echo $src[0];?>" alt="<?php echo $alt; ?>">
		 <?php endforeach;?>
	</div>
</div>
