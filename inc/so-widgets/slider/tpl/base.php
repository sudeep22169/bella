<div class="main-slider">
    <div class="owl-carousel" id="main-slider">   
    <?php foreach($instance['frames'] as $frame) :  
     $i=$frame['id'];
    $image=wp_get_attachment_image_src($frame['background_image'], 'full');
    ?>    
    <div class="item slide<?php echo $i; ?> <?php if($i==2) echo 'alt'; elseif($i==3) echo 'dark'; ?> ">
        <img class="slide-img" src="<?php echo $image[0]; ?>" alt=""/>
        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <div class="caption-content">
                            <h2 class="caption-title"><?php echo nl2br(esc_attr($frame['layertitle'])); ?></h2>
                            <h3 class="caption-subtitle"><?php echo ($i==3||$i==2)?'<span>':''; ?><?php echo nl2br(esc_attr($frame['layersubtitle'])); ?><?php echo ($i==3||$i==2)?'</span>':''; ?></h3>
                            <?php if(!empty($frame['saleprice']) && !empty($frame['regularprice'])):?>
                                <div class="price">
                                    <span><?php echo $frame['currency']?></span><ins><?php echo $frame['saleprice']?></ins>
                                    <span><?php echo $frame['currency']?></span><del><?php echo $frame['regularprice']?></del>
                                </div>
                            <?php endif;?>
                            <p class="caption-text">
                                <?php if( !empty( $frame['btneurl'] ) ) echo '<a  href="' . esc_url( $frame['btneurl'] ) . '" ' . ( $frame['new_window'] ? 'target="_blank"' : '' ) . ' class="btn btn-theme" >'; ?>
                                <?php echo wp_kses_post( $frame['btntext'] ) ?>
                                <?php if( !empty( $frame['btneurl'] ) ) echo '</a>'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  endforeach; ?>        
    </div>
</div>         

