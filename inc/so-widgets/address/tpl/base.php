<div class="media-list address">
    <?php if(!empty($instance['address'])): ?>
        <div class="media">
            <i class="pull-left fa fa-home"></i>
            <div class="media-body">
                <strong><?php _e('Address:','siteorigin-widgets')?></strong><br>
                <?php echo esc_html($instance['address']);?>
            </div>
        </div>
    <?php endif;?>
     <?php if(!empty($instance['telephone'])): ?>
        <div class="media">
            <i class="pull-left fa fa-phone"></i>
            <div class="media-body">
                <strong><?php _e('Telephone:','siteorigin-widgets')?></strong><br>
                <?php echo esc_html($instance['telephone']);?>
            </div>
        </div>
    <?php endif;?>
     <?php if(!empty($instance['fax'])): ?>
        <div class="media">
            <i class="pull-left fa fa-envelope-o"></i>
            <div class="media-body">
                <strong><?php _e('Fax:','siteorigin-widgets')?></strong><br>
                <?php echo esc_html($instance['fax']);?>
            </div>
        </div>
    <?php endif;?>
     <?php if(!empty($instance['text'])): ?>
        <div class="media">
            <div class="media-body">
                <?php echo esc_attr($instance['text']);?>
            </div>
        </div>
    <?php endif;?>
     <?php if(!empty($instance['service_email'])): ?>
        <div class="media">
            <div class="media-body">
                <strong><?php _e('Customer Service:','siteorigin-widgets')?></strong><br>
                <a href="mailto:<?php echo esc_html($instance['service_email']);?>"><?php echo esc_html($instance['service_email']);?></a>
            </div>
        </div>
    <?php endif;?>
     <?php if(!empty($instance['extra_email'])): ?>
        <div class="media">
            <div class="media-body">
                <strong><?php _e('Returns and Refunds:','siteorigin-widgets')?></strong><br>
                <a href="mailto:<?php echo esc_html($instance['extra_email']);?>"><?php echo esc_html($instance['extra_email']);?></a>
            </div>
        </div>
    <?php endif;?>
</div>

