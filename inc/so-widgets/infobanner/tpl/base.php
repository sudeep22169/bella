
<?php
global $bella_options;
if( $bella_options['rtl_css'] == 1){

    $style = "pull-left";

}

else
{
    $style = 'pull-right'; 

}
?>
<div class=" shop-info-banners">
    <div class="block">
        <div class="media">
            <div class="<?php echo $style; ?>">
            <?php $icon_styles = array();

                echo siteorigin_widget_get_icon($instance['icon'],'');                        
            ?>  
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo esc_attr($instance['title']); ?></h4>
                <?php echo esc_attr($instance['subtitle']); ?>
            </div>
        </div>
    </div>
</div>





