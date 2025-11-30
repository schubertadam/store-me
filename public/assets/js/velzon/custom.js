/**
 * Updates the 'page' parameter in the browser's URL Query String without causing a full page reload,
 * and preserves all other existing query parameters (like 'perPage' or 'search').
 *
 * This function is designed to work in conjunction with Livewire pagination logic
 * to ensure URL state is preserved across component updates.
 *
 * @param {number} newPage The desired page number to set in the URL.
 * @returns {void}
 */
function updatePageQuery(newPage) {
    // 1. Create a URL object from the current browser location.
    // This makes it easy to manipulate query parameters.
    const url = new URL(window.location.href);

    // 2. Set the 'page' parameter to the new value.
    // URLSearchParams automatically handles parameter existence.
    url.searchParams.set('page', newPage);

    // 3. Implement Livewire's 'except' logic: If the page is 1, remove the parameter for a cleaner URL.
    if (newPage === 1) {
        url.searchParams.delete('page');
    }

    // 4. Update the browser's history and URL bar without triggering a page navigation/refresh (AJAX friendly).
    // The url.toString() method returns the full URL with all preserved parameters.
    history.pushState(null, '', url.toString());
}

/**
 * Global Livewire error handler that intercepts failed AJAX requests (messages)
 * to automatically manage expired sessions or CSRF tokens.
 *
 * It listens for the 'message.failed' hook and checks for the HTTP 419 status code.
 *
 * @returns {void}
 */
document.addEventListener('livewire:initialized', () => {
    // Registers a hook to run when a Livewire AJAX request fails.
    Livewire.hook('message.failed', ({ response }) => {

        // Check if the response exists and the HTTP status code is 419 (Page Expired/CSRF Token Mismatch).
        if (response && response.status === 419) {

            // 1. Alert the user about the session expiry.
            alert('Your session has expired. Please log in again!');

            // 2. Redirect the user to the designated login route.
            window.location.href = '{{ route("login.index") }}';

            // 3. Stop the standard Livewire error notification from being displayed.
            return false;
        }
    });
});
