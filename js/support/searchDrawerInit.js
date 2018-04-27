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
//debug
console.log(URL);
var searchQuery = URL.params.s;
var catQuery = URL.params.cat;


if (searchQuery) {
    var searchQueryFilter = "?s=" + searchQuery;
}

$('.filter-item').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active')
    //toggle parent UL to be active too
    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
});


// readURI for active cats and set those to active in menu

if (catQuery) {
    
    var activeCategoriesFromURL = catQuery.split(",");

    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").toggleClass('active');
    });
}

//Find any of the drawer menus with an "active status"
$('#FilterSearch').click(function (e) {
    
    var filterValues = [];

    $('.drawer-menu .filter-item').filter('.active').each(function () {
        filterValues.push($(this).data('cat_id'));        
    });

    if (filterValues.length > 0) {
        var filterValue = '&cat=';
        filterValue += filterValues.join(',');
    } else {
        filterValue = '';
    }

     location.replace(location.origin + searchQueryFilter + filterValue)
});