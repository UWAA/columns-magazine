$('.drawer').drawer({
    class: {
        nav: 'drawer-nav',
        toggle: 'drawer-toggle',
        overlay: 'drawer-overlay',
        open: 'drawer-open',
        close: 'drawer-close',
        dropdown: 'dropdown-toggle'
    },
    iscroll: {
        // Configuring the iScroll
        // https://github.com/cubiq/iscroll#configuring-the-iscroll
        mouseWheel: true,
        preventDefault: false
    },
    showOverlay: true
});


$('.filter-item').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active')        
});

//Find any of the drawer menus with an "active status"
$('#FilterSearch').click(function (e) {

    var filterValue = '';

    $('.filter-item').filter('.active').each(function () {
        filterValue += $(this).data('value')
    });

    console.log(filterValue);
});