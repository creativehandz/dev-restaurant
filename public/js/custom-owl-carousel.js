(function($) {
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            items: 3, // Number of items to display
            loop: true, // Infinite loop
            margin: 10, // Margin between items
            nav: false, // Show next/prev buttons
            dots:false,
            autoplay: false, // Enable autoplay
            autoplayTimeout: 3000, // Autoplay interval
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        // Add your show-more and show-less functionality here
        // document.querySelectorAll('.review-text').forEach(function(reviewTextContainer) {
        //     const fullTextElement = reviewTextContainer.querySelector('.full-text');
        //     const fullText = fullTextElement.textContent.trim();

        //     if (fullText.length > 100) {
        //         const shortText = fullText.slice(0, 100) + '...';
        //         const shortTextElement = document.createElement('p');
        //         shortTextElement.classList.add('short-text');
        //         shortTextElement.textContent = shortText;

        //         reviewTextContainer.insertBefore(shortTextElement, fullTextElement);
        //         fullTextElement.style.display = 'none';

        //         reviewTextContainer.querySelector('.show-more').style.display = 'inline';
        //         reviewTextContainer.querySelector('.show-less').style.display = 'none';

        //         reviewTextContainer.querySelector('.show-more').addEventListener('click', function() {
        //             shortTextElement.style.display = 'none';
        //             fullTextElement.style.display = 'block';
        //             this.style.display = 'none';
        //             reviewTextContainer.querySelector('.show-less').style.display = 'inline';
        //         });

        //         reviewTextContainer.querySelector('.show-less').addEventListener('click', function() {
        //             shortTextElement.style.display = 'block';
        //             fullTextElement.style.display = 'none';
        //             this.style.display = 'none';
        //             reviewTextContainer.querySelector('.show-more').style.display = 'inline';
        //         });
        //     }
        // });
    });
})(jQuery);
