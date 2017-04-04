<?php
/**
 * Menu item custom fields example
 *
 * Copy this file into your wp-content/mu-plugins directory.
 *
 * @package Menu_Item_Custom_Fields
 * @version 0.1.0
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 *
 *
 * Plugin name: Menu Item Custom Fields Example
 * Plugin URI: https://github.com/kucrut/wp-menu-item-custom-fields
 * Description: Example usage of Menu Item Custom Fields in plugins/themes
 * Version: 0.1.0
 * Author: Dzikri Aziz
 * Author URI: http://kucrut.org/
 * License: GPL v2
 * Text Domain: my-plugin
 */
 
 
/**
 * Sample menu item metadata
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Learn_Menu_Item_Custom_Fields {
 
    /**
     * Initialize plugin
     */
    public static function init() {
        add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
        add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
        add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
    }
 
 
    /**
     * Save custom field value
     *
     * @wp_hook action wp_update_nav_menu_item
     *
     * @param int   $menu_id         Nav menu ID
     * @param int   $menu_item_db_id Menu item ID
     * @param array $menu_item_args  Menu item data
     */
    public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
        check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );
        // Sanitize
        if ( ! empty( $_POST['menu-item-custom-field'][ $menu_item_db_id ]['col'] ) ) {
            // Do some checks here...
            $col_value = $_POST['menu-item-custom-field'][ $menu_item_db_id ]['col'];
        }
        else {
            $col_value = '';
        }
 
        // Update
        if ( ! empty( $col_value ) ) {
            update_post_meta( $menu_item_db_id, 'col', $col_value );
        }
        else {
            delete_post_meta( $menu_item_db_id, 'col' );
        }

        if ( ! empty( $_POST['menu-item-custom-field'][ $menu_item_db_id ]['size'] ) ) {
            // Do some checks here...
            $size_value = $_POST['menu-item-custom-field'][ $menu_item_db_id ]['size'];
        }
        else {
            $size_value = '';
        }
 
        // Update
        if ( ! empty( $size_value ) ) {
            update_post_meta( $menu_item_db_id, 'size', $size_value );
        }
        else {
            delete_post_meta( $menu_item_db_id, 'size' );
        }
        
        if ( ! empty( $_POST['menu-item-custom-field'][ $menu_item_db_id ]['icon'] ) ) {
            // Do some checks here...
            $icon_value = $_POST['menu-item-custom-field'][ $menu_item_db_id ]['icon'];
        }
        else {
            $icon_value = '';
        }
 
        // Update
        if ( ! empty( $icon_value ) ) {
            update_post_meta( $menu_item_db_id, 'icon', $icon_value );
        }
        else {
            delete_post_meta( $menu_item_db_id, 'icon' );
        }
    }
 
 
    /**
     * Print field
     *
     * @param object $item  Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args  Menu item args.
     * @param int    $id    Nav menu ID.
     *
     * @return string Form fields
     */
    public static function _fields( $id, $item, $depth, $args ) {
        $col=esc_attr(get_post_meta($item->ID,'col',true));
        $size=esc_attr(get_post_meta($item->ID,'size',true));
        $icon=esc_attr(get_post_meta($item->ID,'icon',true));
        
        ?>

            <p class="field-custom description description-wide">
                <label for="edit-menu-item-custom-<?php echo $item->ID; ?>">
                    <?php _e( 'Dropdown Menu Column' ); ?><br />
                    <select id="edit-menu-item-custom-field-<?php echo $item->ID; ?>-col " class="widefat code edit-menu-item-col" name="menu-item-custom-field[<?php echo $item->ID; ?>][col]"  />
                        <option value="1" <?php selected( esc_attr( $col ), 1 ); ?>><?php _e('1','learn'); ?></option>
                        <option value="2" <?php selected( esc_attr( $col ), 2 ); ?>><?php _e('2','learn'); ?></option>
                        <option value="3" <?php selected( esc_attr( $col), 3 ); ?>><?php _e('3','learn'); ?></option>
                    </select>
                </label>
            </p>

            <p class="field-custom description description-wide">
                <label for="edit-menu-item-custom-<?php echo $item->ID; ?>">
                    <?php _e( 'Dropdown Menu Size' ); ?><br />
                    <select id="edit-menu-item-custom-field-<?php echo $item->ID; ?>-size " class="widefat code edit-menu-item-size" name="menu-item-custom-field[<?php echo $item->ID; ?>][size]"  />
                        <option value="simple" <?php selected( esc_attr( $size ), 'simple' ); ?>><?php _e('Simple','learn'); ?></option>
                        <option value="half" <?php selected( esc_attr( $size ), 'half' ); ?>><?php _e('Half','learn'); ?></option>
                        <option value="full" <?php selected( esc_attr( $size), 'full' ); ?>><?php _e('Full','learn'); ?></option>
                    </select>
                </label>
            </p>

             <p class="field-custom description description-wide">
                <label for="edit-menu-item-custom-<?php echo $item->ID; ?>">
                    <?php _e( 'Fontello Icon ' ); ?><br />
                    <input type="text" id="edit-menu-item-custom-field-<?php echo $item->ID; ?>-icon" class="widefat code edit-menu-item-icon" name="menu-item-custom-field[<?php echo $item->ID; ?>][icon]" value="<?php echo esc_attr( $size); ?>" /> 
                </label>
            </p>

        <?php
    }
 
 
    /**
     * Add our field to the screen options toggle
     *
     * To make this work, the field wrapper must have the class 'field-custom'
     *
     * @param array $columns Menu item columns
     * @return array
     */
    public static function _columns( $columns ) {
        $columns['col'] = __( 'Numbers of columns in menu', 'col' );
        $columns['size'] = __( 'Size of Dropdown menu', 'size' );
        $columns['icon'] = __( 'Icon in menu', 'icon' );
        
        return $columns;
    }
}
Learn_Menu_Item_Custom_Fields::init();