<div class="dokan-form-group show_if_simple">

	<p class="form-field <?php echo 'percentage' === $type ? 'hidden' : ''; ?>" data-tiered-price-type-fixed
   data-tiered-price-type>
	<label><?php esc_attr_e( 'Tiered price', 'tier-pricing-table' ); ?></label>
	<span data-price-rules-wrapper>
		<?php if ( ! empty( $price_rules_fixed ) ) : ?>
			<?php foreach ( $price_rules_fixed as $amount => $price ) : ?>
				<span data-price-rules-container>
					<span data-price-rules-input-wrapper>
						<input type="number" value="<?php echo esc_attr( $amount ); ?>" min="2"
							   placeholder="<?php esc_attr_e( 'Quantity', 'tier-pricing-table' ); ?>"
							   class="price-quantity-rule price-quantity-rule--<?php echo esc_attr($prefix); ?>"
							   name="tiered_price_fixed_quantity_<?php echo esc_attr($prefix); ?>[]">
						<input type="text" value="<?php echo esc_attr( wc_format_localized_price( $price ) ); ?>"
							   placeholder="<?php esc_attr_e( 'Price', 'tier-pricing-table' ); ?>"
							   class="wc_input_price price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_fixed_price_<?php echo esc_attr($prefix); ?>[]">
					</span>
					<span class="notice-dismiss remove-price-rule" data-remove-price-rule> remove </span>
					<br>
					<br>
				</span>

			<?php endforeach; ?>
		<?php endif; ?>

		<span data-price-rules-container>
			<span data-price-rules-input-wrapper>
				<input type="number" min="2" placeholder="<?php esc_attr_e( 'Quantity', 'tier-pricing-table' ); ?>"
					   class="price-quantity-rule price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_fixed_quantity_<?php echo esc_attr($prefix); ?>[]">
				<input type="text" placeholder="<?php esc_attr_e( 'Price', 'tier-pricing-table' ); ?>"
					   class="wc_input_price  price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_fixed_price_<?php echo esc_attr($prefix); ?>[]">
			</span>
			<span class="notice-dismiss remove-price-rule" data-remove-price-rule> </span>
			<br>
			<br>
		</span>
	<button data-add-new-price-rule class="button"><?php esc_attr_e( 'New tier', 'tier-pricing-table' ); ?></button>
	</span>
</p>

<p class="form-field <?php echo 'fixed' === $type ? 'hidden' : ''; ?>" data-tiered-price-type-percentage
   data-tiered-price-type>
	<label><?php esc_attr_e( 'Tiered price', 'tier-pricing-table' ); ?></label>
	<span data-price-rules-wrapper>
		<?php if ( ! empty( $price_rules_percentage ) ) : ?>
			<?php foreach ( $price_rules_percentage as $amount => $discount ) : ?>
				<span data-price-rules-container>
					<span data-price-rules-input-wrapper>
						<input type="number" value="<?php echo esc_attr( $amount ); ?>" min="2"
							   placeholder="<?php esc_attr_e( 'Quantity', 'tier-pricing-table' ); ?>"
							   class="price-quantity-rule price-quantity-rule--<?php echo esc_attr($prefix); ?>"
							   name="tiered_price_percent_quantity_<?php echo esc_attr($prefix); ?>[]">
						<input type="number" value="<?php echo esc_attr( $discount ); ?>" max="99"
							   placeholder="<?php esc_attr_e( 'Percent discount', 'tier-pricing-table' ); ?>"
							   class="price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_percent_discount_<?php echo esc_attr($prefix); ?>[]"
							   step="any">
					</span>
					<span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
					<br>
					<br>
				</span>

			<?php endforeach; ?>
		<?php endif; ?>

		<span data-price-rules-container>
			<span data-price-rules-input-wrapper>
				<input type="number" min="2" placeholder="<?php esc_attr_e( 'Quantity', 'tier-pricing-table' ); ?>"
					   class="price-quantity-rule price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_percent_quantity_<?php echo esc_attr($prefix); ?>[]">
				<input type="number" max="99"
					   placeholder="<?php esc_attr_e( 'Percent discount', 'tier-pricing-table' ); ?>"
					   class="price-quantity-rule--<?php echo esc_attr($prefix); ?>" name="tiered_price_percent_discount_<?php echo esc_attr($prefix); ?>[]" step="any">
			</span>
			<span class="notice-dismiss remove-price-rule" data-remove-price-rule></span>
			<br>
			<br>
		</span>
	<button data-add-new-price-rule class="button"><?php esc_attr_e( 'New tier', 'tier-pricing-table' ); ?></button>

	</span>
</p>
</div>