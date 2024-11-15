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
        document.querySelectorAll('.review-text').forEach(function(reviewTextContainer) {
            const fullTextElement = reviewTextContainer.querySelector('.full-text');
            const fullText = fullTextElement.textContent.trim();
        
            if (fullText.length > 100) {
                const shortText = fullText.slice(0, 100) + '...';
                const shortTextElement = document.createElement('p');
                shortTextElement.classList.add('short-text');
                shortTextElement.textContent = shortText;
        
                // Insert short text and hide full text
                reviewTextContainer.insertBefore(shortTextElement, fullTextElement);
                fullTextElement.style.display = 'none';
        
                const showMore = reviewTextContainer.querySelector('.show-more');
                const showLess = reviewTextContainer.querySelector('.show-less');
        
                if (showMore && showLess) {
                    // Initially set the visibility of the buttons
                    toggleButtons(showMore, showLess, true);
        
                    // Common function to toggle text visibility
                    function toggleText(isShowingFull) {
                        shortTextElement.style.display = isShowingFull ? 'none' : 'block';
                        fullTextElement.style.display = isShowingFull ? 'block' : 'none';
                    }
        
                    // Add event listeners for show more/less buttons
                    showMore.addEventListener('click', function() {
                        toggleText(true);
                        toggleButtons(showMore, showLess, false);
                    });
        
                    showLess.addEventListener('click', function() {
                        toggleText(false);
                        toggleButtons(showMore, showLess, true);
                    });
                }
            }
        
            // Helper function to toggle button visibility
            function toggleButtons(showMore, showLess, showMoreVisible) {
                showMore.style.display = showMoreVisible ? 'inline' : 'none';
                showLess.style.display = showMoreVisible ? 'none' : 'inline';
            }
        });
        

        // Show Reply Form and Set updateTime
        $('.reply-btn').click(function() {
            var reviewId = $(this).data('review-id');
            var replyForm = $('#reply-form-' + reviewId);

            // Set the current timestamp for updateTime
            var currentTime = new Date().toISOString(); // ISO 8601 format
            replyForm.find('.update-time').val(currentTime);

            // Toggle visibility of the reply form
            replyForm.toggle();
        });

        // Hide reply form when the cancel button is clicked
        $('.cancel-reply-btn').click(function() {
            $(this).closest('.reply-form').hide();
        });

        // $('.submit-reply').click(function() {
        //     var button = $(this); // Save reference to the button
        //     var form = button.closest('form');
        //     var reviewId = form.data('review-id');
        //     var formData = form.serialize(); // Serialize form data
        
        //     // Disable button and show spinner
        //     button.prop('disabled', true);
        //     button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
        
        //     $.ajax({
        //         url: '/admin/reviews/reply/' + reviewId,
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             // Handle success (e.g., show a success message)
        //             alert('Reply submitted successfully.');
        //             form.closest('.reply-form').hide(); // Hide the form after successful submission
        //         },
        //         error: function(xhr) {
        //             // Handle errors (e.g., show an error message)
        //             var error = xhr.responseJSON.error || 'An error occurred.';
        //             alert('Error: ' + error);
        //         },
        //         complete: function() {
        //             // Re-enable button and revert text after request completes
        //             button.prop('disabled', false);
        //             button.html('Submit Reply'); // Restore the original text
        //         }
        //     });
        // });

        $('.submit-reply').click(function() {
            var button = $(this); // Save reference to the button
            var form = button.closest('form');
            var reviewId = form.data('review-id');
            var formData = form.serialize(); // Serialize form data
        
            // Disable button and show spinner
            button.prop('disabled', true);
            button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
        
                // Simulate success response and reset form
        setTimeout(function() {
            // Show success alert
            alert('Reply sent successfully.');
            
            // Clear the form fields
            form[0].reset();

            // Hide the reply form after successful "submission"
            form.closest('.reply-form').hide();

            // Re-enable button and revert text
            button.prop('disabled', false);
            button.html('Submit Reply'); // Restore the original text
        }, 500); // Optional delay to simulate processing time
        });
        
    });
})(jQuery);
