$(document).ready(function () {
    //Skin switcher
    var current_skin = "skin-yellow";
    $('.skin-colors [data-skin]').click(function (e) {
        e.preventDefault();
        var skinName = $(this).data('skin');
        $('body').removeClass(current_skin);
        $('body').addClass(skinName);
        current_skin = skinName;
    });

    //Layout switcher
    var current_layout = "";
    $('.layout-select [data-layout]').click(function (e) {
        e.preventDefault();
        var layoutName = $(this).data('layout');
        $('body').removeClass(current_layout);
        $('body').addClass(layoutName);
        current_layout = layoutName;
    });

    //LSidebar switcher
    var sidebar_layout = "sidebar-mini";
    $('.sidebar-select [data-sidebar]').click(function (e) {
        e.preventDefault();
        var SidebarName = $(this).data('sidebar');
        $('body').removeClass(sidebar_layout);
        $('body').addClass(SidebarName);
        sidebar_layout = SidebarName;
    });

});