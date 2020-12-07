
jQuery(document).ready(function () {

    jQuery(document).on('click', '[data-add-new-price-rule]', function (e) {
        e.preventDefault();

        var newRuleInputs = jQuery(e.target).parent().find('[data-price-rules-input-wrapper]').first().clone();

        jQuery('<span data-price-rules-container></span>').insertBefore(jQuery(e.target))
            .append(newRuleInputs)
            .append('<span class="notice-dismiss remove-price-rule" data-remove-price-rule style="vertical-align: middle"> remove </span>')
            .append('<br><br>');

        newRuleInputs.children('input').val('');

        recalculateIndexes(jQuery(e.target).closest('[data-price-rules-wrapper]'));
    });

    jQuery('body').on('click', '.remove-price-rule', function (e) {
        e.preventDefault();

        var element = jQuery(e.target.parentElement);
        var wrapper = element.parent('[data-price-rules-wrapper]');
        var containers = wrapper.find('[data-price-rules-container]');

        if ((containers.length) < 2) {
            containers.find('input').val('');
            return;
        }

        jQuery('[data-price-rules-wrapper] .wc_input_price').trigger('change');

        element.remove();

        recalculateIndexes(wrapper);
    });

    function recalculateIndexes(container) {

        var fieldsName = [
            'tiered_price_percent_quantity',
            'tiered_price_percent_discount',
            'tiered_price_fixed_quantity',
            'tiered_price_fixed_price'
        ];

        for (var key in fieldsName) {
            if (fieldsName.hasOwnProperty(key)) {
                var name = fieldsName[key];

                jQuery.each(jQuery(container.find('input[name^="' + name + '"]')), function (index, el) {
                    var currentName = jQuery(el).attr('name');

                    var newName = currentName.replace(/\[\d*\]$/, '[' + index + ']');

                    jQuery(el).attr('name', newName);
                });
            }
        }

    }
});