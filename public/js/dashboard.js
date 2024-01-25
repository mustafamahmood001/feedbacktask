// Session Message out
$(document).ready(function() {
    // Set a timeout to remove the alert after 5 seconds
    setTimeout(function() {
        $('#alertMessage').fadeOut('slow', function() {
            // Remove the element after fade-out
            $(this).remove();
        });
    }, 2000);
});

function toggleVoteCount() {
    var voteCountInput = document.getElementById('vote_count');
    voteCountInput.disabled = !voteCountInput.disabled;
}