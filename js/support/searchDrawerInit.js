jQuery(document).ready(function ($) {




    $('.issue-row').flickity({
        cellSelector: '.carousel-cell',
        cellAlign: 'left',
        pageDots: false,
        contain: true,
        setGallerySize: false,        
        dragThreshold: 10
    });

    
    });

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


// TODO Need to debounce this so you can't click too many times on the drawer button
// $('#filterToggle').click(_.debounce(function () {
//     $('.search-results').toggleClass('opened');
// }, 300)); 

$('#filterToggle').click(function name(params) {
    $('.search-results').toggleClass('opened');   
});


// Scrape out and understand what's happening with the URI, so we can turn-on the filter buttons.
var URL = new Uri(location);

var catQuery = URL.getQueryParamValue('cat');
var issueQuery = URL.getQueryParamValue('issue');

if (catQuery) {
    var activeCategoriesFromURL = catQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").toggleClass('active');
    });
}

if (issueQuery) {
    var activeCategoriesFromURL = issueQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-issue=" + element + "]").toggleClass('active');
    });
}


// Toggles active state on filters, does not dropdown more menu items.  

$('.filter-item').click(function (e) {
    e.stopPropagation();
    var $isLoneParent = $(this).parent().hasClass('lone-parent');    
    var $isParentCategory = $(this).hasClass('parent-category');
    var $isElementActive = $(this).parent().hasClass('active');

    var $filterParent = $(this).parents('.drawer-dropdown');
    var $isFilterParentActive = $filterParent.hasClass('active');       
    
    var $filterSiblings = $(this).parent().siblings();
    var $areOtherFiltersActive = $filterSiblings.hasClass('active');

    
    if ($isParentCategory) {
        console.log('parent is dropdown');
        return;        
    }

    

    if ( $isLoneParent ) {
        console.log('no parent');
        $(this).parent().toggleClass('active');
    }

    
    console.log($filterParent); 

    
    
    console.log("active state: " + $isElementActive);

    //shouldn't happen
    if(!$isFilterParentActive && !$areOtherFiltersActive && !$isElementActive) {
        $filterParent.addClass('active');
        $(this).parent().addClass('active');        
    }

    if (!$isFilterParentActive && !$areOtherFiltersActive && !$isElementActive) {
        $filterParent.addClass('active');
        $(this).parent().addClass('active');
    }

    if ($isFilterParentActive && $areOtherFiltersActive && $isElementActive) {
        $(this).parent().removeClass('active');
    }

    if ($isFilterParentActive && $areOtherFiltersActive && !$isElementActive) {
        $(this).parent().addClass('active');
    }
    
    if ($isFilterParentActive && !$areOtherFiltersActive && $isElementActive) {
        $filterParent.removeClass('active');
        $(this).parent().removeClass('active');
    }

    if ($isFilterParentActive && !$areOtherFiltersActive && $isElementActive) {
        $filterParent.removeClass('active');
        $(this).parent().removeClass('active');
    }

    if ($isFilterParentActive && !$areOtherFiltersActive && !$isElementActive) {        
        $(this).parent().addClass('active');
    }

    if ($isFilterParentActive && !$areOtherFiltersActive && $isElementActive) {
        $filterParent.removeClass('active');
        $(this).parent().removeClass('active');
    }
    
    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
    $(".search-container").find("[data-issue=" + $(this).data('issue') + "]").not($(this)).toggleClass('active');
});



// Search/Filter Submit Button Handler.  
$('.columns-search-input-submit').click(function (e) {    
    
    // Determine currently active filters
    var filterValues = [];
    var issueFilters = [];

    $('.drawer-menu .category-filter').filter('.active').each(function () {
        filterValues.push($(this).data('cat_id'));        
    });

    $('.drawer-menu .issue-filter').filter('.active').each(function () {
        issueFilters.push($(this).data('issue'));
    });

    // Gets the value of the search box
    var searchQuery = $(".columns-search-input-field").val();      

   
    // Builds a new URL and refreshes the page.
    var newURL = URL.clone()
                .setPath('/search') // pagination?
                .deleteQueryParam('cat')
                .deleteQueryParam('issue');
                
                
                

    if (filterValues.length > 0) {        
            newURL.replaceQueryParam('cat', filterValues.join(","));
    }

    if (issueFilters.length > 0) {
        newURL.replaceQueryParam('issue', issueFilters.join(","));
    }

    if (searchQuery) {
        newURL.replaceQueryParam('search', searchQuery)
    }

    
    location.replace(newURL.toString())
});

// UI Elements

// Clears out the search bars if the search filter itself is cleared.
$('.search-filter-item.active').click(function (e) {
    $(".columns-search-input-field").val("");
    URL.replaceQueryParam('search', "");
});

//Debounced search term replace in the active filter area.
$(".columns-search-input-field").on('keyup', _.debounce(function (element) {
    console.log('updating search');

    switch (element.currentTarget.value) {
        case "":
            $(".search-filter-item").html(element.currentTarget.value).removeClass("active");
            break;       
            
    
        default:

            $(".columns-search-input-field").not($(this).each(function () {
                $(".columns-search-input-field").val(element.currentTarget.value)
                $(".search-filter-item").html(element.currentTarget.value).addClass("active");
            }))

            break;
    }
    
}, 500));



