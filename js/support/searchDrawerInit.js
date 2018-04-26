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

//http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
function parseURL(url) {
    var a = document.createElement('a');
    a.href = url;
    return {
        source: url,
        protocol: a.protocol.replace(':', ''),
        host: a.hostname,
        port: a.port,
        query: a.search,
        params: (function () {
            var ret = {},
                seg = a.search.replace(/^\?/, '').split('&'),
                len = seg.length, i = 0, s;
            for (; i < len; i++) {
                if (!seg[i]) { continue; }
                s = seg[i].split('=');
                ret[s[0]] = s[1];
            }
            return ret;
        })(),
        file: (a.pathname.match(/\/([^\/?#]+)$/i) || [, ''])[1],
        hash: a.hash.replace('#', ''),
        path: a.pathname.replace(/^([^\/])/, '/$1'),
        relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [, ''])[1],
        segments: a.pathname.replace(/^\//, '').split('/')
    };
}

var URL = parseURL(location);
var searchQuery = URL.params.s;

if (searchQuery) {
    var searchQueryFilter = "?s=" + searchQuery;
}

$('.filter-item').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active')
});


//Find any of the drawer menus with an "active status"
$('#FilterSearch').click(function (e) {

    var filterValue = '&cat=';

    $('.filter-item').filter('.active').each(function () {
        filterValue += $(this).data('cat_id');
        filterValue += ",";
    });

        
    location.replace(location.origin + searchQueryFilter + filterValue)
});