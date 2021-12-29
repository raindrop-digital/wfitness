jQuery(document).ready(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        $block.find('.testimonial-carousel-items').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplaySpeed: 6000,
                autoplay: true,
                infinite: true,
                pauseOnHover: true,
                speed: 800,
                arrows: true,
                dots: true,
                rtl: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
            }
        }]
    });   
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.testimonial-carousel').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=slider', initializeBlock );
    }
});