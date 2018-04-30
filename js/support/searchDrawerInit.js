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



var URL = new Uri(location);
//debug
console.log(URL);
// var searchQuery = URL.params.s;  //doing with PHP
var catQuery = URL.getQueryParamValue('cat');



$('.filter-item').click(function (e) {
    e.stopPropagation();
    $(this).toggleClass('active')
    //toggle parent UL to be active too
    $(".search-container").find("[data-cat_id=" + $(this).data('cat_id') + "]").not($(this)).toggleClass('active');
});


if (catQuery) {    
    
    var activeCategoriesFromURL = catQuery.split(",");

    activeCategoriesFromURL.forEach(function (element) {
        $(".search-container").find("[data-cat_id=" + element + "]").toggleClass('active');
    });
}

//Find any of the drawer menus with an "active status"
$('.columns-search-input-submit').click(function (e) {
    
    var filterValues = [];

    $('.drawer-menu .filter-item').filter('.active').each(function () {
        filterValues.push($(this).data('cat_id'));        
    });
    
    console.log(filterValues);


    var searchQuery = $(".columns-search-input-field").val();
    
    console.log(searchQuery);

   

    newURL = URL.clone()                
                .deleteQueryParam('cat');

    if (filterValues.length > 0) {        
            newURL.replaceQueryParam('cat', filterValues.join(","));
    }

    if (searchQuery) {
        newURL.replaceQueryParam('s', searchQuery)
    }

     location.replace(newURL)

     


});

//TODO

$('.search-filter-item.active').click(function (e) {
    $(".columns-search-input-field").val("");
    
});

//Debounced search term replace in the active filter area.

function updateSearchTerms(value) {
    
    
}

$(".columns-search-input-field").on('keyup', _.debounce(function (element) {

    console.log(element.currentTarget.value)

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

// var lazyLayout = _.debounce(calculateLayout, 300);
// $(window).resize(lazyLayout);


