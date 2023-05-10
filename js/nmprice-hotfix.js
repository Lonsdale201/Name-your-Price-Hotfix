jQuery(document).ready(function ($) {
    if (typeof wc_nyp_format_number !== 'undefined') {
        var original_wc_nyp_format_number = wc_nyp_format_number;

        wc_nyp_format_number = function (t, e) {
            var original_thousands_sep = woocommerce_nyp_params.currency_format_thousand_sep;

            // Kick off the thousand separator
            woocommerce_nyp_params.currency_format_thousand_sep = '';

            // Call the original wc_nyp_format_number function  with the modified setup
            var result = original_wc_nyp_format_number(t, e);

            // get beck the original thousad separator - KABOOOM 
            woocommerce_nyp_params.currency_format_thousand_sep = original_thousands_sep;

            return result;
        };
    }
});
