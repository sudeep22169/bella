

<div class="testimonials-carousel">

    <div class="owl-carousel" id="testimonials">
        <?php foreach( $instance['testimonials'] as $i => $testimonial ) : ?>
            <div class="testimonial">
                <div class="testimonial-text"><?php echo  wp_kses_post($testimonial['text']);?></div>
                <div class="testimonial-name"><?php echo  wp_kses_post($testimonial['name']);?></div>
            </div>
        <?php endforeach;?>
       
    </div>
</div>