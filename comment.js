(function() {
    var container = document.getElementById('comments'),
    commentRows = document.getElementsByClassName('cs-comment-row');

    container.addEventListener('click', function(e) {
        var target = e.target;
        if (target.classList.contains('reply')) {
            var comment = target.getAttribute('data-id'),
                parent = document.getElementById('parent_id');

            e.preventDefault();
            parent.setAttribute('value', comment);
        }
    });
})();
