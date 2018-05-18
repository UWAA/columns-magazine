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
$('.drawer').drawer({
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
        mouseWheel: true,
        preventDefault: false
    },
    showOverlay: true
});



function toggleResultsClass() {    
    $('.drawer').drawer('toggle');
    $('.search-results').toggleClass('opened');
    console.log($('#filterToggle').html());
};


    
$('#filterToggle').on("click", _.debounce(toggleResultsClass, 700, true));
    

// Scrape out and understand what's happening with the URI, so we can turn-on the filter buttons.
//TODO Global scope - clean up.
var URL = new Uri(location);

var catQuery = URL.getQueryParamValue('cat');
var issueQuery = URL.getQueryParamValue('issue');
var orderQuery = URL.getQueryParamValue('order');

if (typeof catQuery !== 'undefined') {
    var activeCategoriesFromURL = catQuery.split(",");
    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").addClass('active');
        $(".category-menu").find("[data-cat_id=" + element + "]").parent().addClass('active');
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



$('.current-filter-wrapper>.filter-item').click(function (e) {
    console.log($(this).data('cat_id'));
    var $targetMenuItem = $(".drawer-menu").find("[data-cat_id=" + $(this).data('cat_id') + "]");
    $targetMenuItem.parent().removeClass('active');
    $(this).removeClass('active');
    checkParent($targetMenuItem);
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


    if ($isParentCategory) {
        return;
    }

    if ($isLoneParent) {
        console.log('no parent');

    }


    if (!$isFilterParentActive && !$areOtherFiltersActive) {
        $filterParent.addClass('active');

    }

    if ($isFilterParentActive && !$areOtherFiltersActive) {
        $filterParent.removeClass('active');

    }




    console.log($filterParent);

}



// Toggles active state on filters, does not dropdown more menu items.  

$('.drawer-menu .filter-item').click(function (e) {
    e.stopPropagation();
    $(this).parent().toggleClass('active');

    checkParent($(this));

    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
    $(".search-container").find("[data-issue=" + $(this).data('issue') + "]").not($(this)).toggleClass('active');
});



// Search/Filter Submit Button Handler.  
$('.columns-search-input-submit').click(function (e) {

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

});




