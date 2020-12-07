<div class="dokan-form-group show_if_simple show_if_variable">
    <label for=""> <?php echo __('Minimum quantity','');  ?> </label>
    <input type="number" class="dokan-form-control" id="minimum_allowed_quantity" name="minimum_allowed_quantity" 
          min ="0" step ="1" placeholder="<?php esc_attr_e( 'Minimum quantity', 'dokan-lite' ); ?>"/>
</div>

<div class="dokan-form-group show_if_simple show_if_variable">
    <label for=""> <?php echo __('Maximum quantity',''); ?>  </label>
    <input type="number" class="dokan-form-control" id="maximum_allowed_quantity" name="maximum_allowed_quantity" 
          min ="0" step ="1" placeholder="<?php esc_attr_e( 'Maximun quantity', 'dokan-lite' ); ?>"/>
</div>

<div class="dokan-form-group show_if_simple show_if_variable">
    <label for=""> <?php echo __('Group of...',''); ?>  </label>
    <input type="number" class="dokan-form-control" id="group_of_quantity" name="group_of_quantity" 
          min ="0" step ="1" placeholder="<?php esc_attr_e( '', 'dokan-lite' ); ?>"/>
</div>

<div class="dokan-form-group show_if_variable">
  <?php dokan_extend_post_input_box( 'allow_combination', [
    'label' => 'Allow Combination'
  ], 'checkbox' ); ?> 
</div>

<div class="dokan-form-group show_if_simple show_if_variable">
  <?php dokan_extend_post_input_box( 'minmax_do_not_count', [
    'label' => 'Order rules: Do not count'
  ], 'checkbox' ); ?> 
</div>

<div class="dokan-form-group show_if_simple show_if_variable">
  <?php dokan_extend_post_input_box( 'minmax_cart_exclude', [
    'label' => 'Order rules: Exclude'
  ], 'checkbox' ); ?> 
</div>

<div class="dokan-form-group show_if_simple show_if_variable">
  <?php 
    dokan_extend_post_input_box( 'minmax_category_group_of_exclude', [
        'label' => 'Category rules: Exclude'
      ], 'checkbox' 
    ); 
  ?> 
</div>