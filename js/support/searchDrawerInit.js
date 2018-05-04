
// Initiate the Drawer Search Menu
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

// Scrape out and understand what's happening with the URI, so we can turn-on the filter buttons.
var URL = new Uri(location);

var catQuery = URL.getQueryParamValue('cat');

if (catQuery) {
    var activeCategoriesFromURL = catQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").toggleClass('active');
    });
}


// Toggles active state on filters, does not dropdown more menu items.  

$('.filter-item').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active')
    //toggle parent UL to be active too
    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
});



// Search/Filter Submit Button Handler.  
$('.columns-search-input-submit').click(function (e) {    
    
    // Determine currently active filters
    var filterValues = [];

    $('.drawer-menu .filter-item').filter('.active').each(function () {
        filterValues.push($(this).data('cat_id'));        
    });

    // Gets the value of the search box
    var searchQuery = $(".columns-search-input-field").val();      

   
    // Builds a new URL and refreshes the page.
    var newURL = URL.clone()
                .setPath('/search') // pagination?
                .deleteQueryParam('cat');
    
                // newURL.uriParts.directory = "/";
                
                

    if (filterValues.length > 0) {        
            newURL.replaceQueryParam('cat', filterValues.join(","));
    }

    if (searchQuery) {
        newURL.replaceQueryParam('s', searchQuery)
    }

    
    location.replace(newURL.toString())
});

// UI Elements

// Clears out the search bars if the search filter itself is cleared.
$('.search-filter-item.active').click(function (e) {
    $(".columns-search-input-field").val("");
    URL.replaceQueryParam('s', "");
});

//Debounced search term replace in the active filter area.
$(".columns-search-input-field").on('keyup', _.debounce(function (element) {
    console.log('updating search');

    switch (element.currentTarget.value) {
        case "":
            $(".search-filter-item").removeClass("active");
            break;       
            
    
        default:

            $(".columns-search-input-field").not($(this).each(function () {
                $(".columns-search-input-field").val(element.currentTarget.value)
                $(".search-filter-item").html(element.currentTarget.value).addClass("active");
            }))

            break;
    }
    
}, 500));



