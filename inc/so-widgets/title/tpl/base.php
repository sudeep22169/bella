<?php global $bella_options;

if( $bella_options['rtl_css'] == 1){

	$style = "text-align: right";


}

else
{
	$style = 'text-align:'.$instance['align']; 

}
?>
<?php if(!empty( $instance['title']['heading'])):?>
    <h<?php  echo $instance['title']['size'];?> style="<?php echo $style;?>" class="section-title <?php echo $instance['bigtitle']?'section-title-lg':''?>">
    <?php if(!empty($instance['line']))  : ?>
        <span>
        <?php endif; ?>
            <?php  echo $instance['title']['heading'];?>
        <?php if(!empty($instance['line']))  : ?>
        </span>
        <?php endif; ?>
    </h<?php  echo $instance['title']['size'];?>>
<?php endif;?>

