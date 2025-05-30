/**
*
* -----------------------------------------------------------------------------
*
* Template : RS Construction - Construction & Building HTML Template
* Author : rs-theme
* Author URI : http://www.Enstructura Consultant Pvt Ltd/
*
* -----------------------------------------------------------------------------
*
**/

jQuery(document).ready(function($) {
    'use strict';

    // Get the form.
    var form = $('#get-quote');

    // Get the messages div.
    var formMessage = $('#form-message');

    $(form).submit(function(event){
        event.preventDefault();
        var $form = $(this);

        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(data) {
                var $elm = $('<div/>').attr('id','form-message');
                $elm.html(data);

                $.magnificPopup({
                    items: {
                        src: $elm.html(),
                        type: 'inline'
                    }
                });

            },
            error: function(error) {
                // Do something with the error
            }
        });
    });

});