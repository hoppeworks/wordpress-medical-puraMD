'use strict';

jQuery(document).ready(function ($) {
    if (!$('.product-type-composite').length) {
        return;
    }

    $('.product-type-composite').each(function () {
        wooco_init($(this));
        wooco_init_seletor();
    });
});

jQuery(document).on('woosq_loaded', function () {
    // composite products in quick view popup
    wooco_init(jQuery('#woosq-popup .product-type-composite'));
    wooco_init_seletor();
});

jQuery(document).on('click touch', '.single_add_to_cart_button', function (e) {
    var $this = jQuery(this);

    if ($this.hasClass('wooco-disabled')) {
        if ($this.hasClass('wooco-selection')) {
            alert(wooco_vars.alert_selection);
        } else if ($this.hasClass('wooco-min')) {
            alert(wooco_vars.alert_min.replace('[min]', $wooco_components.attr('data-min')));
        } else if ($this.hasClass('wooco-max')) {
            alert(wooco_vars.alert_max.replace('[max]', $wooco_components.attr('data-max')));
        }
        e.preventDefault();
    }
});

jQuery('body').on('keyup change', '.wooco_component_product_qty_input', function () {
    var _this = jQuery(this);
    var _val = parseInt(_this.val());
    var _min = parseInt(_this.attr('min'));
    var _max = parseInt(_this.attr('max'));
    var _this_composite = _this.closest('.product-type-composite');

    if ((
        _val < _min
    ) || isNaN(_val)) {
        _val = _min;
        jQuery(this).val(_val);
    }

    if (_val > _max) {
        _val = _max;
        jQuery(this).val(_val);
    }

    jQuery(this).closest('.wooco_component_product').attr('data-qty', _val);
    wooco_init(_this_composite);
});

function wooco_init($wooco_wrap) {
    var $wooco_components = $wooco_wrap.find('.wooco-components');
    var $wooco_btn = $wooco_wrap.find('.single_add_to_cart_button');

    var is_selection = false;
    var is_min = false;
    var is_max = false;
    var qty = 0;
    var qty_min = parseInt($wooco_components.attr('data-min'));
    var qty_max = parseInt($wooco_components.attr('data-max'));

    $wooco_components.find('.wooco_component_product').each(function () {
        var _this = jQuery(this);

        if (_this.attr('data-id') > 0) {
            qty += parseInt(_this.attr('data-qty'));
        }

        if ((
            _this.attr('data-optional') == 'no'
        ) && (
            _this.attr('data-id') <= 0
        )) {
            is_selection = true;
        }
    });

    if (is_selection) {
        $wooco_btn.addClass('wooco-selection');
    } else {
        $wooco_btn.removeClass('wooco-selection');
    }

    if (qty < qty_min) {
        is_min = true;
        $wooco_btn.addClass('wooco-min');
    } else {
        $wooco_btn.removeClass('wooco-min');
    }

    if (qty > qty_max) {
        is_max = true;
        $wooco_btn.addClass('wooco-max');
    } else {
        $wooco_btn.removeClass('wooco-max');
    }

    if (is_selection || is_min || is_max) {
        $wooco_btn.addClass('wooco-disabled');
    } else {
        $wooco_btn.removeClass('wooco-disabled');
    }

    wooco_calc_price($wooco_wrap);
    wooco_save_ids($wooco_wrap);
}

function wooco_init_seletor() {
    if (wooco_vars.selector == 'ddslick') {
        jQuery('.wooco_component_product_select').each(function () {
            var _this = jQuery(this);
            var _this_selection = _this.closest('.wooco_component_product_selection');
            var _this_component = _this.closest('.wooco_component_product');
            var _this_composite = _this.closest('.product-type-composite');

            if (_this.val() != '') {
                var _selected_default = jQuery("option:selected", this);
                wooco_selected(_selected_default, _this_selection, _this_component);
                wooco_init(_this_composite);
            }

            _this.ddslick({
                width: '100%',
                onSelected: function (data) {
                    var _selected = jQuery(data.original[0].children[data.selectedIndex]);
                    wooco_selected(_selected, _this_selection, _this_component);
                    wooco_init(_this_composite);
                }
            });
        });
    } else if (wooco_vars.selector == 'select2') {
        jQuery('.wooco_component_product_select').each(function () {
            var _this = jQuery(this);
            var _this_selection = _this.closest('.wooco_component_product_selection');
            var _this_component = _this.closest('.wooco_component_product');
            var _this_composite = _this.closest('.product-type-composite');

            if (_this.val() != '') {
                var _selected_default = jQuery("option:selected", this);

                wooco_selected(_selected_default, _this_selection, _this_component);
                wooco_init(_this_composite);
            }

            _this.select2({
                templateResult: wooco_select2_state,
                width: '100%',
                containerCssClass: 'wpc-select2-container',
                dropdownCssClass: 'wpc-select2-dropdown'
            });
        });

        jQuery('.wooco_component_product_select').on('select2:select', function (e) {
            var _this = jQuery(this);
            var _this_selection = _this.closest('.wooco_component_product_selection');
            var _this_component = _this.closest('.wooco_component_product');
            var _this_composite = _this.closest('.product-type-composite');
            var _selected = jQuery(e.params.data.element);

            wooco_selected(_selected, _this_selection, _this_component);
            wooco_init(_this_composite);
        });
    } else {
        jQuery('.wooco_component_product_select').each(function () {
            //check on start
            var _this = jQuery(this);
            var _this_selection = _this.closest('.wooco_component_product_selection');
            var _this_component = _this.closest('.wooco_component_product');
            var _this_composite = _this.closest('.product-type-composite');
            var _selected = jQuery("option:selected", this);

            wooco_selected(_selected, _this_selection, _this_component);
            wooco_init(_this_composite);
        });

        jQuery('body').on('change', '.wooco_component_product_select', function () {
            //check on select
            var _this = jQuery(this);
            var _this_selection = _this.closest('.wooco_component_product_selection');
            var _this_component = _this.closest('.wooco_component_product');
            var _this_composite = _this.closest('.product-type-composite');
            var _selected = jQuery("option:selected", this);

            wooco_selected(_selected, _this_selection, _this_component);
            wooco_init(_this_composite);
        });
    }
}

function wooco_selected(selected, selection, component) {
    var selected_id = selected.attr('value');
    var selected_pid = selected.attr('data-pid');
    var selected_price = selected.attr('data-price');
    var selected_link = selected.attr('data-link');
    var selected_img = selected.attr('data-imagesrc');
    var selected_desc = selected.attr('data-description');

    component.attr('data-id', selected_id);
    component.attr('data-price', selected_price);

    if (selected_pid == '0') {
        // get parent ID for quick view
        selected_pid = selected_id;
    }

    if (wooco_vars.product_link != 'no') {
        selection.find('.wooco_component_product_link').remove();
        if (selected_link != '') {
            if (wooco_vars.product_link == 'yes_popup') {
                selection.append('<a class="wooco_component_product_link woosq-btn" data-id="' + selected_pid + '" href="' + selected_link + '" target="_blank"> &nbsp; </a>');
            } else {
                selection.append('<a class="wooco_component_product_link" href="' + selected_link + '" target="_blank"> &nbsp; </a>');
            }
        }
    }

    component.find('.wooco_component_product_image').html('<img src="' + selected_img + '"/>');
    component.find('.wooco_component_product_price').html(selected_desc);

    jQuery(document).trigger('wooco_selected', [selected, selection, component]);
}

function wooco_select2_state(state) {
    if (!state.id) {
        return state.text;
    }

    var $state = new Object();

    if (jQuery(state.element).attr('data-imagesrc') != '') {
        $state = jQuery(
            '<span class="image"><img src="' + jQuery(state.element).attr('data-imagesrc') + '"/></span><span class="info"><span>' + state.text + '</span> <span>' + jQuery(state.element).attr('data-description') + '</span></span>'
        );
    } else {
        $state = jQuery(
            '<span class="info"><span>' + state.text + '</span> <span>' + jQuery(state.element).attr('data-description') + '</span></span>'
        );
    }

    return $state;
}

function wooco_calc_price($wooco_wrap) {
    var $wooco_components = $wooco_wrap.find('.wooco-components');
    var $wooco_total = $wooco_wrap.find('.wooco-total');
    var total = 0;

    if ((
        $wooco_components.attr('data-pricing') == 'only'
    ) && (
        $wooco_components.attr('data-price') > 0
    )) {
        total = Number($wooco_components.attr('data-price'));
    } else {
        // calc price
        $wooco_components.find('.wooco_component_product').each(function () {
            var _this = jQuery(this);

            if ((
                _this.attr('data-price') > 0
            ) && (
                _this.attr('data-qty') > 0
            )) {
                total += Number(_this.attr('data-price')) * Number(_this.attr('data-qty'));
            }
        });

        // discount
        if ((
            $wooco_components.attr('data-percent') > 0
        ) && (
            $wooco_components.attr('data-percent') < 100
        )) {
            total = total * (
                100 - Number($wooco_components.attr('data-percent'))
            ) / 100;
        }

        if ($wooco_components.attr('data-pricing') == 'include') {
            total += Number($wooco_components.attr('data-price'));
        }
    }

    var total_html = '<span class="woocommerce-Price-amount amount">';
    var total_formatted = wooco_format_money(total, wooco_vars.price_decimals, '', wooco_vars.price_thousand_separator, wooco_vars.price_decimal_separator);

    switch (wooco_vars.price_format) {
        case '%1$s%2$s':
            //left
            total_html += '<span class="woocommerce-Price-currencySymbol">' + wooco_vars.currency_symbol + '</span>' + total_formatted;
            break;
        case '%1$s %2$s':
            //left with space
            total_html += '<span class="woocommerce-Price-currencySymbol">' + wooco_vars.currency_symbol + '</span> ' + total_formatted;
            break;
        case '%2$s%1$s':
            //right
            total_html += total_formatted + '<span class="woocommerce-Price-currencySymbol">' + wooco_vars.currency_symbol + '</span>';
            break;
        case '%2$s %1$s':
            //right with space
            total_html += total_formatted + ' <span class="woocommerce-Price-currencySymbol">' + wooco_vars.currency_symbol + '</span>';
            break;
        default:
            //default
            total_html += '<span class="woocommerce-Price-currencySymbol">' + wooco_vars.currency_symbol + '</span> ' + total_formatted;
    }

    total_html += '</span>';

    if ((
        $wooco_components.attr('data-pricing') != 'only'
    ) && (
        parseFloat($wooco_components.attr('data-percent')) > 0
    ) && (
        parseFloat($wooco_components.attr('data-percent')) < 100
    )) {
        total_html += ' <small class="woocommerce-price-suffix">' + wooco_vars.saved_text.replace('[d]', wooco_round(parseFloat($wooco_components.attr('data-percent'))) + '%') + '</small>';
    }

    $wooco_total.html(wooco_vars.total_text + ' ' + total_html).slideDown();

    if (wooco_vars.change_price != 'no') {
        // change the main price
        var price_selector = '.summary > .price';

        if ((wooco_vars.price_selector != null) &&
            (wooco_vars.price_selector != '')) {
            price_selector = wooco_vars.price_selector;
        }

        $wooco_wrap.find(price_selector).html(total_html);
    }

    jQuery(document).trigger('wooco_calc_price', [total, total_formatted, total_html]);
}

function wooco_save_ids($wooco_wrap) {
    var $wooco_components = $wooco_wrap.find('.wooco-components');
    var $wooco_ids = $wooco_wrap.find('.wooco-ids');
    var wooco_ids = Array();

    $wooco_components.find('.wooco_component_product').each(function () {
        var _this = jQuery(this);

        if ((
            _this.attr('data-id') > 0
        ) && (
            _this.attr('data-qty') > 0
        )) {
            wooco_ids.push(_this.attr('data-id') + '/' + _this.attr('data-qty') + '/' + _this.attr('data-new-price'));
        }
    });

    $wooco_ids.val(wooco_ids.join(','));
}

function wooco_round(num) {
    return +(
        Math.round(num + "e+2") + "e-2"
    );
}

function wooco_format_money(number, places, symbol, thousand, decimal) {
    number = number || 0;
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "$";
    thousand = thousand || ",";
    decimal = decimal || ".";
    var negative = number < 0 ? "-" : "",
        i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
        j = 0;
    if (i.length > 3) {
        j = i.length % 3;
    }
    return symbol + negative + (
        j ? i.substr(0, j) + thousand : ""
    ) + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (
        places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : ""
    );
}