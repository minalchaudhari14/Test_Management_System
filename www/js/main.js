(function ($) {
    "use strict";
    var fullHeight = function () {
        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        if ($('#sidebar').hasClass('active')) {
            $('#img').hide();
            $('#admin').hide();
            $('#email').hide();
            $('#mbno').hide();
            $('#dashboard').hide();
            $('#studinfo').hide();
            $('#courseinfo').hide();
            $('#course').hide();
            $('#batch').hide();
            $('#subject').hide();
            $('#quesbank').hide();
            $('#testcreation').hide();
            $('#quesset').hide();
            $('#settings').hide();
            $('#pass').hide();
            $('#logout').hide();
          
        } else if ($('#sidebar').toggleClass('active').removeClass('active')) {
           $('#img').show();
            $('#admin').show();
            $('#email').show();
            $('#mbno').show();
            $('#dashboard').show();
            $('#studinfo').show();
            $('#courseinfo').show();
            $('#course').show();
            $('#batch').show();
            $('#subject').show();
            $('#quesbank').show();
            $('#testcreation').show();
            $('#quesset').show();
            $('#settings').show();
            $('#pass').show();
            $('#logout').show();
        }

    });
//    $('#nav-toggle').click(function(e) {
//  e.stopPropagation();
//  $(".menu").toggleClass('bar')
//});
$('body').click(function(e) {
//    if ($('.sidebar').hasClass('active')) {
        $(".sidebar").toggleClass('active')
//    }
})
})(jQuery);
