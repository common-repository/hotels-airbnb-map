function handle_widget_loading() {
    jQuery('.check-date').each(function (index) {
        if (index) {
            if (!jQuery(this).hasClass("loaded-datepicker")) {
                jQuery(this)
                    .daterangepicker({
                        minDate: new Date().toLocaleDateString()
                    })
                    .addClass("loaded-datepicker");
            }
        }
    });

    jQuery('.map-color').each(function (index) {
        if (index) {
            if (!jQuery(this).hasClass("loaded-colorpicker")) {
                jQuery(this)
                    .spectrum({
                        showInput: true,
                        preferredFormat: 'hex',
                    })
                    .addClass("loaded-colorpicker");
            }
        }
    });
}

jQuery(document).ready(handle_widget_loading);
jQuery(document).on('widget-added widget-updated', handle_widget_loading);
