<?php 

if( !function_exists('dokan_extend_post_input_box') ) {

	function dokan_extend_post_input_box( $meta_key, $attr = array(), $type = 'text' ) {
	    $placeholder = isset( $attr['placeholder'] ) ? esc_attr( $attr['placeholder'] ) : '';
	    $class       = isset( $attr['class'] ) ? esc_attr( $attr['class'] ) : 'dokan-form-control';
	    $name        = isset( $attr['name'] ) ? esc_attr( $attr['name'] ) : $meta_key;
	    $size        = isset( $attr['size'] ) ? $attr['size'] : 30;
	    $required    = isset( $attr['required'] ) ? 'required' : '';

	    switch ( $type ) {
	        case 'text':
	            ?>
	            <input <?php echo esc_attr( $required ); ?> type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="" class="<?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">
	            <?php
	            break;

	        case 'price':
	            ?>
	            <input <?php echo esc_attr( $required ); ?> type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="" class="wc_input_price <?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">
	            <?php
	            break;

	        case 'decimal':
	            ?>
	            <input <?php echo esc_attr( $required ); ?> type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="" class="wc_input_decimal <?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">
	            <?php
	            break;

	        case 'textarea':
	            $rows = isset( $attr['rows'] ) ? absint( $attr['rows'] ) : 4;
	            ?>
	            <textarea <?php echo esc_attr( $required ); ?> name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" rows="<?php echo esc_attr( $rows ); ?>" class="<?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>"></textarea>
	            <?php
	            break;

	        case 'checkbox':
	            $label = isset( $attr['label'] ) ? $attr['label'] : '';
	            $class = ( $class == 'dokan-form-control' ) ? '' : $class;
	            ?>

	            <label class="<?php echo esc_attr( $class ); ?>" for="<?php echo esc_attr( $name ); ?>">
	                <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="no">
	                <input <?php echo esc_attr( $required ); ?> name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="yes" type="checkbox">
	                <?php echo esc_html( $label ); ?>
	            </label>

	            <?php
	            break;

	        case 'select':
	            $options = is_array( $attr['options'] ) ? $attr['options'] : array();
	            ?>
	            <select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="<?php echo esc_attr( $class ); ?>">
	                <?php foreach ( $options as $key => $label ) { ?>
	                    <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></option>
	                <?php } ?>
	            </select>

	            <?php
	            break;

	        case 'number':
	            $min = isset( $attr['min'] ) ? $attr['min'] : 0;
	            $step = isset( $attr['step'] ) ? $attr['step'] : 'any';
	            ?>
	            <input <?php echo esc_attr( $required ); ?> type="number" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="" class="<?php echo esc_attr( $class ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" min="<?php echo esc_attr( $min ); ?>" step="<?php echo esc_attr( $step ); ?>" size="<?php echo esc_attr( $size ); ?>">
	            <?php
	            break;

	        case 'radio':
	            $options = is_array( $attr['options'] ) ? $attr['options'] : array();
	            foreach ( $options as $key => $label ) {
	                ?>
	                <label class="<?php echo esc_attr( $class ); ?>" for="<?php echo esc_attr( $key ); ?>">
	                    <input name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" type="radio">
	                    <?php echo esc_html( $label ); ?>
	                </label>

	                <?php
	            }
	            break;
	    }
	}
}


function dokan_extended_get_template_part( $slug, $name = '', $args = array() ) {
    $defaults = array(
        'pro' => false,
    );

    $args = wp_parse_args( $args, $defaults );

    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $template = '';

    // Look in yourtheme/dokan/slug-name.php and yourtheme/dokan/slug.php
    $template = locate_template( array( dokanextend()->template_path() . "{$slug}-{$name}.php", dokanextend()->template_path() . "{$slug}.php" ) );

    /**
     * Change template directory path filter
     *
     * @since 2.5.3
     */
    $template_path = apply_filters( 'dokan_extended_set_template_path', dokanextend()->plugin_path() . '/templates', $template, $args );

    // Get default slug-name.php
    if ( ! $template && $name && file_exists( $template_path . "/{$slug}-{$name}.php" ) ) {
        $template = $template_path . "/{$slug}-{$name}.php";
    }

    if ( ! $template && ! $name && file_exists( $template_path . "/{$slug}.php" ) ) {
        $template = $template_path . "/{$slug}.php";
    }

    // Allow 3rd party plugin filter template file from their plugin
    $template = apply_filters( 'dokan_extended_get_template_part', $template, $slug, $name );
    if ( $template ) {
        include $template;
    }
}


add_action( 'woocommerce_single_product_summary', 'bbloomer_show_return_policy', 20 );
 
function bbloomer_show_return_policy() {
	global $product;
	if( $product instanceof WC_Product ) {
		$minimum_allowed_quantity         = get_post_meta( $product->get_id(), 'minimum_allowed_quantity', true );
	    $maximum_allowed_quantity         = get_post_meta( $product->get_id(), 'maximum_allowed_quantity', true );
	    $group_of_quantity                = get_post_meta( $product->get_id(), 'group_of_quantity', true );

	    if( $minimum_allowed_quantity != '' ) {
	    	echo sprintf( '<p> Minimum Order Quantity %s </p>', $minimum_allowed_quantity );
	    }

	    if( $minimum_allowed_quantity != '' ) {
	    	echo sprintf( '<p> Groups of %s </p>', $group_of_quantity );
	    }
	}
}

// Check items.
// add_action( 'woocommerce_check_cart_items', 'dokan_extended_check_cart_items'  );

function dokan_extended_check_cart_items() {

}

// Quantity selelectors (2.0+).
// remove_filter( 'woocommerce_quantity_input_args', array('WC_Min_Max_Quantities', 'update_quantity_args' ), 10 );
// add_filter( 'woocommerce_quantity_input_args', 'dokan_extended_update_quantity_args', 9, 2 );
// remove_filter( 'woocommerce_available_variation', array( 'WC_Min_Max_Quantities', 'available_variation' ), 10 );
// add_filter( 'woocommerce_available_variation', 'dokan_extended_available_variation', 10, 3 );

function dokan_extended_update_quantity_args( $data, $product ) {

	return $data;
}

function dokan_extended_available_variation( $data, $product, $variation ) {

	return $data;
}

// Prevent add to cart..
// remove_filter( 'woocommerce_add_to_cart_validation', array( 'WC_Min_Max_Quantities', 'add_to_cart' ), 10 );
// add_filter( 'woocommerce_add_to_cart_validation','dokan_extended_add_to_cart', 10, 4 );

function dokan_extended_add_to_cart( $pass, $product_id, $quantity, $variation_id = 0 ) {

	return $pass;
}


// Show a notice when items would have to be on back order because of min/max.
// add_filter( 'woocommerce_get_availability', 'dokan_extended_maybe_show_backorder_message', 10, 2 );
// remove_filter( 'woocommerce_get_availability', array( 'WC_Min_Max_Quantities', 'maybe_show_backorder_message' ), 10, 2 );

function dokan_extended_maybe_show_backorder_message( $args, $product ) {

	return $args;
}