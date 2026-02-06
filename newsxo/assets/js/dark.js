(function($) {
    "use strict"; 
  
    function siteModeToggle(siteModeVal) {
        $.removeCookie('newsxo-site-mode-cookie', {
            path: '/'
        });
        var updateVal;
        if (siteModeVal === 'defaultcolor') {
            updateVal = 'dark';
        } else {
            updateVal = 'defaultcolor';
        }
        $("#mode-switcher").removeClass(siteModeVal);
        $("#mode-switcher").addClass(updateVal);
        $('body').removeClass(siteModeVal);
        $('body').addClass(updateVal);
        var exDate = new Date();
        exDate.setTime(exDate.getTime() + (3600 * 1000));
        $.cookie('newsxo-site-mode-cookie', updateVal, {
            expires: exDate,
            path: '/'
        });
    }

    $("#mode-switcher").click(function(event) {
        event.preventDefault();
        var siteModeClass = $(this).attr('class');
        var siteModeAttr = $(this).data('skin-mode');  

        if ($(this).hasClass(siteModeAttr)) {
            siteModeToggle(siteModeAttr);
        } else {
            siteModeToggle(siteModeClass);
        }
    });
  
})(jQuery);