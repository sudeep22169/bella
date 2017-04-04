<?php if($instance['style']=='alt')
    $style='alt-font';
    elseif($instance['style']=='big-text')
    $style='alt-font big-text';
    else
    $style='';
?>
<div class="thumbnail no-border no-padding thumbnail-banner <?php echo $style;?>">
    <div class="media">
        <?php  $image=wp_get_attachment_image_src($instance['background_image'], 'full'); ?>
        <?php if( !empty( $instance['btnurl'] ) ) echo '<a  href="' . esc_url( $instance['btnurl'] ) . '" ' . ( $instance['new_window'] ? 'target="_blank"' : '' ) . ' class="media-link" >'; ?>
            <img src="<?php echo $image[0]; ?>" alt=""/>
            <div class="caption text-<?php echo $instance['align'] ?>">
                <div class="caption-wrapper div-table">
                <div class="caption-inner div-cell">
                    <h2 class="caption-title"><span><?php echo esc_attr($instance['title']); ?></span></h2>
                    <h3 class="caption-sub-title"><span><?php echo esc_attr($instance['subtitle']); ?></span></h3>
                    <?php if( !empty( $instance['btnurl'] ) ) : ?>
                    <span class="btn btn-theme btn-theme-sm"><?php echo wp_kses_post( $instance['btntext'] ) ?></span>
                    <?php endif; ?>
                </div>
                </div>
            </div>
         <?php if( !empty( $instance['btnurl'] ) ) echo '</a>'; ?>
    </div>
</div>

	





