(function() {
    var container = document.getElementById('comments'),
        form = document.getElementById('comment_form'),
        clear = document.getElementById('form_clear'),
        header = document.getElementById('form_header'),
        parent_id = document.getElementById('parent_id');

    clear.addEventListener('click', function(e) {
        e.preventDefault();

        header.innerHTML = 'Leave A Comment.';
        parent_id.setAttribute('value', '0');
        form.reset();
    });

    container.addEventListener('click', function(e) {
        var target = e.target;

        if (target.classList.contains('reply')) {
            var comment = target.getAttribute('data-id'),
                name = target.getAttribute('data-name');

            e.preventDefault();

            // Move to comment form
            window.location.hash = 'comment-box';

            // Indicate who commenter is responding to
            header.innerHTML = 'Reply to ' + name + ',';

            // Set parent_id for reply post
            parent_id.setAttribute('value', comment);
        }
    });
})();
