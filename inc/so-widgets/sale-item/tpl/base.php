   
<?php  $image=wp_get_attachment_image_src($instance['background_image'], 'full');?>

    <div class="thumbnail no-border no-padding category">
        <div class="media">
            <?php echo '<a  href="' . esc_url( $instance['btneurl'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) . ' class="media-link" >'; ?>
                <img  src="<?php echo $image[0]; ?>" alt=""/>
                <div class="caption">
                    <div class="caption-wrapper div-table">
                        <div class="caption-inner div-cell">
                            <div class="sale"><span><?php _e('%','bella')?><?php echo wp_kses_post($instance['sale']).' Sale';?></span></div>
                            <h4 class="caption-title"><span><?php echo wp_kses_post( $instance['title'] ) ?></span></h4>
                            <div class="items"><span><?php echo wp_kses_post( $instance['item'] ).' Item(s)';?></span></div>
                            <div class="buttons">
                                <span class="btn btn-theme btn-theme-transparent"><?php echo wp_kses_post( $instance['btntext'] ) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
