jQuery(function(){
    jQuery('.search-form-trigger button').on(
        'click',
        function(e) {
            jQuery('.search-form-wrapper').slideToggle('slow');
        }
    )
});