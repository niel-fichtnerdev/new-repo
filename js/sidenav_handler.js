$(document).ready(function() {
    var pageTitle = $(document).attr("title");
    $(".sidenav_icons").each(function() {
        var linkTitle = $(this).data("title");
        
        if (linkTitle === pageTitle) {
            $(this).addClass("active");
        }
    });
});