
(function($){
    $(document).ready(function() {
        $( "#main-fab" ).click(function() {
            $( ".inner-fabs" ).toggleClass( "show" )
        });
    });

    $('.mr_menu_toggle_mobile').on('click', function(e) {
        $('body').addClass('mr_menu_active');
        e.stopPropagation();
        e.preventDefault();
    });
})(jQuery);
