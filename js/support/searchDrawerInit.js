var columnsScroll;



jQuery(document).ready(function ($) {

    $('.issue-row').flickity({
        cellSelector: '.carousel-cell',
        cellAlign: 'left',
        pageDots: false,
        contain: true,
        setGallerySize: false,        
        dragThreshold: 10
    });

// Initiate the Drawer Search Menu
$('.drawer-nav').drawer({
    class: {
        nav: 'drawer-nav',        
        overlay: 'drawer-overlay',
        open: 'drawer-open',
        close: 'drawer-close',
        dropdown: 'dropdown-toggle'
    },
    iscroll: {
        // Configuring the iScroll
        // https://github.com/cubiq/iscroll#configuring-the-iscroll
        mouseWheel: false,
        disableTouch: false,
        scrollbars: true,
        preventDefault: false
        
        
    },
    showOverlay: false
});

// columnsScroll = new IScroll('.drawer-nav', {
//         // Configuring the iScroll
//         // https://github.com/cubiq/iscroll#configuring-the-iscroll
//         mouseWheel: true,
//         preventDefault: false
//     })




function toggleResultsClass() {    
    $('.drawer').drawer('toggle');
    $('.search-results').toggleClass('opened');    
    
    
    $('.drawer').removeClass("filters-active");
    
    if (hasActiveFilter) {
        $('.drawer').addClass("filters-active");
    }
    

};

$(window).on("resize", function resetDrawer() {
    $('.drawer').drawer('close');
    $('.search-results').removeClass('opened');
});


    
$('#filterToggle').on("click", _.debounce(toggleResultsClass, 700, true));
    

// Scrape out and understand what's happening with the URI, so we can turn-on the filter buttons.
//TODO Global scope - clean up.
var URL = new Uri(location);

var catQuery = URL.getQueryParamValue('cat');
var issueQuery = URL.getQueryParamValue('issue');
var orderQuery = URL.getQueryParamValue('order');
var searchQuery = URL.getQueryParamValue('search');
var hasActiveFilter = false;

if (typeof catQuery !== 'undefined') {
    var activeCategoriesFromURL = catQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").addClass('active');
        $(".category-menu").find("[data-cat_id=" + element + "]").parents('.cat-item').addClass('active');        
        checkParent($(".category-menu").find("[data-cat_id=" + element + "]"))
    });
}

if (typeof issueQuery !== 'undefined') {
    
    var activeCategoriesFromURL = issueQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-issue=" + element + "]").toggleClass('active');
        $(".issue-menu").find("[data-issue=" + element + "]").parent().addClass('active');
        checkParent($(".issue-menu").find("[data-issue=" + element + "]"))
    });
}

if (typeof searchQuery !== 'undefined') {
        
        
        
}


// TODO - Filthy...
$('.current-filter-wrapper>.filter-item').click(function (e) {    
    var $targetMenuItem = $(".drawer-menu").find("[data-cat_id=" + $(this).data('cat_id') + "]");
    var $targetDateItem = $(".drawer-menu").find("[data-issue=" + $(this).data('issue') + "]");
    $targetMenuItem.parent().removeClass('active');
    $targetDateItem.parent().removeClass('active');
    $(this).removeClass('active');
    checkParent($targetMenuItem);
    checkParent($targetDateItem);
});

if(typeof orderQuery !== 'undefined'){
    switch (orderQuery) {
        case 'asc':
            $('.order-oldest span').addClass('current');            
            break;

        case 'desc':
            $('.order-newest span').addClass('current');
        break;
    
        default:
            break;
    }

}



function checkParent($targetElement) {

    var $isLoneParent = $targetElement.parent().hasClass('lone-parent');
    var $isParentCategory = $targetElement.hasClass('parent-category');

    var $filterParent = $targetElement.parents('.drawer-dropdown');
    var $isFilterParentActive = $filterParent.hasClass('active');

    var $filterSiblings = $targetElement.parent().siblings();
    var $areOtherFiltersActive = $filterSiblings.hasClass('active');

    
    hasActiveFilter = false;

    if ($isParentCategory) {        
        return;
    }
    
    if (!$isFilterParentActive && !$areOtherFiltersActive) {
        $filterParent.addClass('active');
        hasActiveFilter = true;
        

    }

    if ($isFilterParentActive && !$areOtherFiltersActive) {
        
        $filterParent.removeClass('active');
        $('.drawer').removeClass("filters-active");
        hasActiveFilter = false;

    }

}



// Toggles active state on filters, does not dropdown more menu items.  

$('.drawer-menu .filter-item').not('.parent-category').click(function (e) {
    e.stopPropagation();    
    $(this).parent().toggleClass('active');    

    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
    $(".search-container").find("[data-issue=" + $(this).data('issue') + "]").not($(this)).toggleClass('active');

    checkParent($(this));

    
    // hasActiveFilter = true;
});

// TODO default "choose/change on new page load"

function sendNewSearch() {
    // Determine currently active filters
    var filterValues = [];
    var issueFilters = [];

    $('.category-menu .cat-item').filter('.active').each(function () {
        filterValues.push($(this).children('.filter-item').data('cat_id'));
    });

    $('.issue-menu .issue-filter').parent().filter('.active').not('.parent-category').each(function () {
        issueFilters.push($(this).children('.issue-filter').data('issue'));
    });

    // Gets the value of the search box
    var searchQuery = $(".columns-search-input-field").val();


    // Builds a new URL and refreshes the page.
    var newURL = URL.clone()
        // .setPath('/search')
        .deleteQueryParam('cat')
        .deleteQueryParam('issue')
        .deleteQueryParam('searchpage')
        .deleteQueryParam('search');


    if (filterValues.length > 0) {
        newURL.replaceQueryParam('cat', filterValues.join(","));
    }

    if (issueFilters.length > 0) {
        newURL.replaceQueryParam('issue', issueFilters.join(","));
    }

    if (searchQuery.length > 0) {        
        newURL.replaceQueryParam('search', searchQuery)
    }

    
    location.replace(newURL.toString())
    
}

// Search/Filter Submit Button Handler.  
$('.columns-search-input-submit').click(function (e) {
sendNewSearch($(this));   
});

    $('.columns-search-form').submit(function (e) {        
        e.preventDefault();
        sendNewSearch();
    })

// UI Elements

// Clears out the search bars if the search filter itself is cleared.
$('.search-filter-item.active').click(function (e) {
    $(".columns-search-input-field").val("");
    URL.replaceQueryParam('search', "");
});

//Debounced search term replace in the active filter area.
$(".columns-search-input-field").on('keyup', _.debounce(function (element) {
    

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

}, 50));  // Potentil issue here because sendNewSearch() uses the first box as it's search value.  On mobile, if you submit too fast it will 

});




