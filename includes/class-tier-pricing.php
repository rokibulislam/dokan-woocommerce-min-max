<?php 

use TierPricingTable\PriceManager;

class DokanTierPriceing {

    public function __construct() {
        
        add_action( 'dokan_new_product_after_product_tags', [ $this, 'tier_product_price_field' ], 9 );

        add_action( 'dokan_new_product_added', [ $this, 'save_tier_price_product_meta' ], 11, 2 );
        add_action( 'dokan_product_updated', [ $this, 'save_tier_price_product_meta' ], 11, 2 );

        add_action('dokan_product_edit_after_product_tags', [ $this, 'edit_tier_product_price_field' ],9,2);

        add_action( 'dokan_variation_options_pricing', [ $this, 'add_tier_variation_priceing' ], 10, 3 );

        // add_action( 'dokan_product_updated', 'save_tier_price_variation_product_meta', 12 );

        // add_action( 'dokan_save_product_variation', 'save_tier_price_variation_product_meta', 12, 2 );


        add_action( 'woocommerce_save_product_variation', [ $this, 'save_tier_price_variation_product_meta' ], 10, 2 );
    }
    

    public function tier_product_price_field(){
        dokan_extended_get_template_part( 'products/tier-pricing', '', [
        	'type' => 'fixed',
        	'prefix' => 'simple'
        ]);
    } 




    public function save_tier_price_product_meta($product_id, $postdata){
        error_log('tier price meta');

        $nonce = isset( $_POST['_simple_product_dokan_tier_nonce'] ) ? sanitize_key( $_POST['_simple_product_dokan_tier_nonce'] ) : false;


        if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
            return;
        }

        $product_type = isset( $postdata['product_type'] ) && in_array( $data['product_type'],
                array( 'simple', 'variable' ) ) ? sanitize_text_field( $data['product_type'] ) : 'simple';

        if ( wp_verify_nonce( $nonce, 'save_simple_product_dokan_tier_price_data' ) &&  $product_type == 'simple' ) {

            $prefix = isset( $postdata['product_type'] ) && in_array( $postdata['product_type'],
                array( 'simple', 'variable' ) ) ? sanitize_text_field( $postdata['product_type'] ) : 'simple';

            $fixedAmounts = isset( $postdata[ 'tiered_price_fixed_quantity_' . $prefix ] ) ? (array) $postdata[ 'tiered_price_fixed_quantity_' . $prefix ] : array();
            $fixedPrices  = ! empty( $postdata[ 'tiered_price_fixed_price_' . $prefix ] ) ? (array) $postdata[ 'tiered_price_fixed_price_' . $prefix ] : array();

            PriceManager::updateFixedPriceRules( $fixedAmounts, $fixedPrices, $product_id );

            $percentageAmounts = isset( $postdata[ 'tiered_price_percent_quantity_' . $prefix ] ) ? (array) $postdata[ 'tiered_price_percent_quantity_' . $prefix ] : array();
            $percentagePrices  = ! empty( $postdata[ 'tiered_price_percent_discount_' . $prefix ] ) ? (array) $postdata[ 'tiered_price_percent_discount_' . $prefix ] : array();

            PriceManager::updatePercentagePriceRules( $percentageAmounts, $percentagePrices, $product_id );

            if ( isset( $postdata[ 'tiered_price_rules_type_' . $prefix ] ) ) {
                PriceManager::updatePriceRulesType( $product_id, sanitize_text_field( $postdata[ 'tiered_price_rules_type_' . $prefix ] ) );
            }
        }
    }


    public function edit_tier_product_price_field($post, $post_id){

        $type = PriceManager::getPricingType( $post_id, 'fixed', 'edit' );

        dokan_extended_get_template_part( 'products/tier-pricing', '', [
            'price_rules_fixed'      => PriceManager::getFixedPriceRules( $post_id, 'edit' ),
            'price_rules_percentage' => PriceManager::getPercentagePriceRules( $post_id, 'edit' ),
            'type'                   => $type,
            'prefix'                 => 'simple',
        ]);
    }


    public function add_tier_variation_priceing( $loop, $variation_data, $variation ) {

        dokan_extended_get_template_part( 'products/edit/tier-pricing-variation', '', [
            'price_rules_fixed'      => PriceManager::getFixedPriceRules( $variation->ID, 'edit' ),
            'price_rules_percentage' => PriceManager::getPercentagePriceRules( $variation->ID, 'edit' ),
            'minimum'                => PriceManager::getProductQtyMin( $variation->ID, 'edit' ),
            'type'                   => PriceManager::getPricingType( $variation->ID, 'fixed', 'edit' ),
            'i'                      => $loop,
            'variation_data'         => $variation_data,
        ]);
    }


    public function save_tier_price_variation_product_meta( $variation_id, $i ) {

        if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
            return;
        }


        $data = $_POST;

        if ( isset( $data['tiered_price_fixed_quantity'][ $i ] ) ) {
            $fixedAmounts = $data['tiered_price_fixed_quantity'][ $i ];
            $fixedPrices  = ! empty( $data['tiered_price_fixed_price'][ $i ] ) ? (array) $data['tiered_price_fixed_price'][ $i ] : array();

            PriceManager::updateFixedPriceRules( $fixedAmounts, $fixedPrices, $variation_id );
        }

        if ( isset( $data['tiered_price_percent_quantity'][ $i ] ) ) {
            $amounts = $data['tiered_price_percent_quantity'][ $i ];
            $prices  = ! empty( $data['tiered_price_percent_discount'][ $i ] ) ? (array) $data['tiered_price_percent_discount'][ $i ] : array();

            PriceManager::updatePercentagePriceRules( $amounts, $prices, $variation_id );
        }

        if ( isset( $_POST['_tiered_pricing_minimum'][ $i ] ) ) {
            $min = intval( $_POST['_tiered_pricing_minimum'][ $i ] );
            $min = $min > 0 ? $min : 1;

            PriceManager::updateProductQtyMin( $variation_id, $min );
        }

        if ( ! empty( $_POST['tiered_price_rules_type'][ $i ] ) ) {
            PriceManager::updatePriceRulesType( $variation_id, sanitize_text_field( $_POST['tiered_price_rules_type'][ $i ] ) );
        }
    }

}