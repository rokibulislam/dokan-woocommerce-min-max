<?php

class DokanMinMax {

    public function __construct() {
      add_action( 'dokan_new_product_after_product_tags', [ $this, 'add_min_max_field' ], 10 );


      add_action( 'dokan_new_product_added',[ $this,'save_min_max_meta' ], 10, 2 );
      add_action( 'dokan_product_updated', [ $this, 'save_min_max_meta' ] , 10, 2 );

      add_action('dokan_product_edit_after_product_tags', [ $this, 'edit_min_max_field' ],99,2);

    }

    public function add_min_max_field(){ 
      dokan_extended_get_template_part( 'products/min-max-qty', '', []);
    } 

    public function save_min_max_meta($product_id, $postdata){

      if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
        return;
      }

      if ( ! empty( $postdata['minimum_allowed_quantity'] ) ) {
          update_post_meta( $product_id, 'minimum_allowed_quantity', $postdata['minimum_allowed_quantity'] );
      }

      if ( ! empty( $postdata['maximum_allowed_quantity'] ) ) {
          update_post_meta( $product_id, 'maximum_allowed_quantity', $postdata['maximum_allowed_quantity'] );
      }

      if ( ! empty( $postdata['group_of_quantity'] ) ) {
          update_post_meta( $product_id, 'group_of_quantity', $postdata['group_of_quantity'] );
      }

      if ( ! empty( $postdata['allow_combination'] ) ) {
          update_post_meta( $product_id, 'allow_combination', $postdata['allow_combination'] );
      }

      if ( ! empty( $postdata['minmax_do_not_count'] ) ) {
          update_post_meta( $product_id, 'minmax_do_not_count', $postdata['minmax_do_not_count'] );
      }

      if ( ! empty( $postdata['minmax_cart_exclude'] ) ) {
          update_post_meta( $product_id, 'minmax_cart_exclude', $postdata['minmax_cart_exclude'] );
      }

      if ( ! empty( $postdata['minmax_category_group_of_exclude'] ) ) {
          update_post_meta( $product_id, 'minmax_category_group_of_exclude', $postdata['minmax_category_group_of_exclude'] );
      }

    }

    public function edit_min_max_field($post, $post_id){

      $minimum_allowed_quantity         = get_post_meta( $post_id, 'minimum_allowed_quantity', true );
      $maximum_allowed_quantity         = get_post_meta( $post_id, 'maximum_allowed_quantity', true );
      $group_of_quantity                = get_post_meta( $post_id, 'group_of_quantity', true );
      $allow_combination                = get_post_meta( $post_id, 'allow_combination', true );
      $minmax_do_not_count              = get_post_meta( $post_id, 'minmax_do_not_count', true );
      $minmax_cart_exclude              = get_post_meta( $post_id, 'minmax_cart_exclude', true );
      $minmax_category_group_of_exclude = get_post_meta( $post_id, 'minmax_category_group_of_exclude', true );

      dokan_extended_get_template_part( 'products/edit/min-max-qty', '', [
        'post_id'                               => $post_id,
        'minimum_allowed_quantity'              => $minimum_allowed_quantity,
        'maximum_allowed_quantity'              => $maximum_allowed_quantity,
        'group_of_quantity'                     => $group_of_quantity,
        'allow_combination'                     => $allow_combination,
        'minmax_do_not_count'                   => $minmax_do_not_count,
        'minmax_cart_exclude'                   => $minmax_cart_exclude,
        'minmax_category_group_of_exclude'      => $minmax_category_group_of_exclude,
      ]);

    }
}

