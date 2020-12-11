<!-- <div class="dokan-form-group">
    <input type="hidden" name="minimum_allowed_quantity" id="dokan-edit-product-id" value="<?php //echo esc_attr( $post_id ); ?>"/>
    <label for="minimum_allowed_quantity" class="form-label"><?php //esc_html_e( 'Minimum quantity', 'dokan-lite' ); ?></label>
    <?php //dokan_post_input_box( $post_id, 'minimum_allowed_quantity', array( 'min' => "0", 'step' => "1", 'placeholder' => __( 'Minimum quantity', 'dokan-lite' ), 'value' => $minimum_allowed_quantity ), 'number' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Minimum quantity!', 'dokan-lite' ); ?>
    </div>
</div>  -->

<div class="dokan-form-group">
    <input type="hidden" name="maximum_allowed_quantity" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="maximum_allowed_quantity" class="form-label"><?php esc_html_e( 'Maximum quantity', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'maximum_allowed_quantity', array( 'min' => "0", 'step' => "1", 'placeholder' => __( 'Maximum quantity', 'dokan-lite' ), 'value' => $maximum_allowed_quantity ), 'number' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php // esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 


<div class="dokan-form-group">
    <input type="hidden" name="group_of_quantity" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="group_of_quantity" class="form-label"><?php esc_html_e( 'Group of...', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'group_of_quantity', array( 'min' => "0", 'step' => "1", 'placeholder' => __( '', 'dokan-lite' ), 'value' => $group_of_quantity ), 'number' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 

<div class="dokan-form-group">
    <input type="hidden" name="allow_combination" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="allow_combination" class="form-label"><?php esc_html_e( 'Allow Combination', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'allow_combination', array( 'placeholder' => __( '', 'dokan-lite' ), 'value' => $allow_combination ), 'checkbox' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 

<div class="dokan-form-group">
    <input type="hidden" name="minmax_do_not_count" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="minmax_do_not_count" class="form-label"><?php esc_html_e( 'Order rules: Do not count', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'minmax_do_not_count', array( 'placeholder' => __( '', 'dokan-lite' ), 'value' => $minmax_do_not_count ), 'checkbox' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 

<div class="dokan-form-group">
    <input type="hidden" name="minmax_cart_exclude" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="minmax_cart_exclude" class="form-label"><?php esc_html_e( 'Order rules: Exclude', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'minmax_cart_exclude', array( 'placeholder' => __( '', 'dokan-lite' ), 'value' => $minmax_cart_exclude ), 'checkbox' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 

<div class="dokan-form-group">
    <input type="hidden" name="minmax_cart_exclude" id="dokan-edit-product-id" value="<?php echo esc_attr( $post_id ); ?>"/>
    <label for="minmax_category_group_of_exclude" class="form-label"><?php esc_html_e( 'Category rules: Exclude', 'dokan-lite' ); ?></label>
    <?php dokan_post_input_box( $post_id, 'minmax_category_group_of_exclude', array( 'placeholder' => __( '', 'dokan-lite' ), 'value' => $minmax_category_group_of_exclude ), 'checkbox' ); ?>
    <div class="dokan-product-title-alert dokan-hide">
     <?php //esc_html_e( 'Please enter Maximum quantity!', 'dokan-lite' ); ?>
    </div>
</div> 