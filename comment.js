(function() {
    var container = document.getElementById('comments');

    container.addEventListener('click', function(e) {
        var target = e.target;

        if (target.classList.contains('reply')) {
            var comment = target.getAttribute('data-id'),
                parent = document.getElementById('parent_id');

            e.preventDefault();

            // Move to comment form
            window.location.hash = 'comment-box';

            // Set parent_id for reply post
            parent.setAttribute('value', comment);
        }
    });
})();
