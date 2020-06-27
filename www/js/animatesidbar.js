$('#sidebarCollapse').click(function() {
    if ($(window).width() > 500) { //your chosen mobile res
      $('.list-unstyled components mb-5').toggle(300);
    } else {
      $('.active').animate({
        width: 'toggle'
      }, 350);
    }
});