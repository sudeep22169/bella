<div class="message-box <?php echo $instance['style'] ?>" style="background-color:<?php echo $instance['color']?>;">
    <div class="message-box-inner">
    	<?php if($instance['style']=='alt'):?>
    		<?php if( !empty( $instance['btnurl'] ) ) echo '<a  href="' . esc_url( $instance['btnurl'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) . ' class="btn btn-theme btn-theme-sm pull-right" >'; ?>
      		 	<?php echo $instance['btntext']?>
      		 <?php if( !empty( $instance['btnurl'] ) ) echo '</a>'; ?>
    		
    	<?php endif;?>
        <h2><?php echo wp_kses_post( $instance['text'] ) ?></h2>
    </div>
</div>
