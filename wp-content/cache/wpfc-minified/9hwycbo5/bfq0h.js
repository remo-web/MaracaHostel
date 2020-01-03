// source --> https://maracahostel.com.br/wp-content/plugins/pixelyoursite/js/public.js 
jQuery(document).ready(function( $ ) {

    if (typeof pys_fb_pixel_options === 'undefined') {
        return;
    }

    // load FB pixel
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.agent='dvpixelyoursite';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');

    var fbAddToCart = function ($button) {

        var data = {
            action: 'pys_woo_addtocart_params',
            product_id: undefined,
            variation_id: undefined,
            quantity: 1
        };

        $.each($button.data(), function (key, value) {
            data[key] = value;
        });

        var $variations_form = $button.closest('form.variations_form.cart'),
            $single_form = $button.closest('form.cart');

        if ($variations_form.length === 1) {
            data.product_id = parseInt($single_form.find('*[name="add-to-cart"]').val());
            data.variation_id = parseInt($variations_form.find('input[name="variation_id"]').val());
            data.quantity = parseInt($variations_form.find('input[name="quantity"]').val());
        } else if ($single_form.length === 1) {
            data.product_id = parseInt($single_form.find('*[name="add-to-cart"]').val());
            data.quantity = parseInt($single_form.find('input[name="quantity"]').val());
        }

        $.ajax({
            url: pys_fb_pixel_options.ajax_url,
            data: data,
            dataType: 'json',
            async: false,
            success: function (response) {

                if (!response || response.error) {
                    return;
                }

                fbq('track', 'AddToCart', response.data);

            }
        });

    };

    /**
     * WooCommerce AddToCart on button
     */
    if (pys_fb_pixel_options.woo.addtocart_enabled && typeof wc_add_to_cart_params !== 'undefined'
        && wc_add_to_cart_params.cart_redirect_after_add !== 'yes') {

        $(document.body).on('added_to_cart', function (e, fragments, cart_hash, $button) {
            fbAddToCart($button);
        });

    }

    regularEvents();
    customCodeEvents();

    // EDD AddToCart
    $('.edd-add-to-cart').click(function () {

        try {

            // extract pixel event ids from classes like 'pys-event-id-{UNIQUE ID}'
            var classes = $.grep(this.className.split(" "), function (element, index) {
                return element.indexOf('pys-event-id-') === 0;
            });

            // verify that we have at least one matching class
            if (typeof classes == 'undefined' || classes.length == 0) {
                return;
            }

            // extract event id from class name
            var regexp = /pys-event-id-(.*)/;
            var event_id = regexp.exec(classes[0]);

            if (event_id == null) {
                return;
            }

            evaluateEventByID(event_id[1], pys_edd_ajax_events);

        } catch (e) {
            console.log(e);
        }

    });

    /**
     * Process Init, General, Search, Standard (except custom code), WooCommerce (except AJAX AddToCart, Affiliate and
     * PayPal events. In case if delay param is present - event will be fired after desired timeout.
     */
    function regularEvents() {

        if( typeof pys_events == 'undefined' ) {
            return;
        }

        for( var i = 0; i < pys_events.length; i++ ) {

            var eventData = pys_events[i];

            if( eventData.hasOwnProperty('delay') == false || eventData.delay == 0 ) {

                fbq( eventData.type, eventData.name, eventData.params );

            } else {

                setTimeout( function( type, name, params ) {
                    fbq( type, name, params );
                }, eventData.delay * 1000, eventData.type, eventData.name, eventData.params );

            }

        }

    }

    /**
     * Process only custom code Standard events.
     */
    function customCodeEvents() {

        if( typeof pys_customEvents == 'undefined' ) {
            return;
        }

        $.each( pys_customEvents, function( index, code ) {
            eval( code );
        } );

    }

    /**
     * Fire event with {eventID} from =events= events list. In case of event data have =custom= property, code will be
     * evaluated without regular Facebook pixel call.
     */
    function evaluateEventByID( eventID, events ) {

        if( typeof events == 'undefined' || events.length == 0 ) {
            return;
        }

        // try to find required event
        if( events.hasOwnProperty( eventID ) == false ) {
            return;
        }

        var eventData = events[ eventID ];

        if( eventData.hasOwnProperty( 'custom' ) ) {

            eval( eventData.custom );

        } else {

            fbq( eventData.type, eventData.name, eventData.params );

        }

    }

});
// source --> https://maracahostel.com.br/wp-content/plugins/Ultimate_VC_Addons/assets/min-js/ultimate-params.min.js 
jQuery(document).ready(function(a){var b="",c="",d="",e="",f="",g="";jQuery(".ult-responsive").each(function(h,i){var j=jQuery(this),k=j.attr("data-responsive-json-new"),l=j.data("ultimate-target"),m="",n="",o="",p="",q="",r="";void 0===k&&null==k||a.each(a.parseJSON(k),function(a,b){var c=a;if(void 0!==b&&null!=b){var d=b.split(";");jQuery.each(d,function(a,b){if(void 0!==b||null!=b){var d=b.split(":");switch(d[0]){case"large_screen":m+=c+":"+d[1]+";";break;case"desktop":n+=c+":"+d[1]+";";break;case"tablet":o+=c+":"+d[1]+";";break;case"tablet_portrait":p+=c+":"+d[1]+";";break;case"mobile_landscape":q+=c+":"+d[1]+";";break;case"mobile":r+=c+":"+d[1]+";"}}})}}),""!=r&&(g+=l+"{"+r+"}"),""!=q&&(f+=l+"{"+q+"}"),""!=p&&(e+=l+"{"+p+"}"),""!=o&&(d+=l+"{"+o+"}"),""!=n&&(c+=l+"{"+n+"}"),""!=m&&(b+=l+"{"+m+"}")});var h="<style>/** Ultimate: Media Responsive **/ ";h+=c,h+="@media (max-width: 1199px) { "+d+"}",h+="@media (max-width: 991px)  { "+e+"}",h+="@media (max-width: 767px)  { "+f+"}",h+="@media (max-width: 479px)  { "+g+"}",h+="/** Ultimate: Media Responsive - **/</style>",jQuery("head").append(h)});