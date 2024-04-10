$(function(){

 /**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 16,
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    // Create marker instance.
    var marker = new google.maps.Marker({
        position : latLng,
        map: map
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function(){
    $('.acf-map').each(function(){
        var map = initMap( $(this) );
    });
});


$('.commerce-category-block').each(function() {
    var $block = $(this);
    var $productList = $block.find('.product-list');
    var slideWidth = ($productList.find('.product-item').outerWidth(true) * 
    3) ; // Width of 3 items
    var slideIndex = 0;
    var totalSlides = Math.ceil($productList.find('.product-item').length / 3); // Calculate total slides

    // $block.find('.commerce-carousel').css('overflow-x', 'scroll');
    // $block.find('.commerce-carousel').width(slideWidth * totalSlides); // Adjust width to fit all slides

    updateButtons();

    function updateButtons() {
        $block.find('.prev-btn').toggle(slideIndex > 0); // Show previous button if not on first slide
        $block.find('.next-btn').toggle(slideIndex < totalSlides - 1); // Show next button if not on last slide
    }

    $block.find('.prev-btn').click(function() {
        if (slideIndex > 0) {
            slideIndex--;
            $productList.animate({
                left: '+=' + slideWidth
            });
            updateButtons();
        }
    });

    $block.find('.next-btn').click(function() {
        if (slideIndex < totalSlides - 1) {
            slideIndex++;
            $productList.animate({
                left: '-=' + slideWidth
            });
            updateButtons();
        }
    });


    //add to cart button

    $('.product-item').hover(
        function() {
            $(this).find('.add-to-cart-btn').css('transform', 'translateY(0%)');
        },
        function() {
            $(this).find('.add-to-cart-btn').css('transform', 'translateY(30%)');
        }
    );
});




    
});






