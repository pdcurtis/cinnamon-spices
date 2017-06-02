(function() {
    // Check for comment-box
    var form = document.getElementById('comment-form-master');

    function createForm(parent) {
        var form_wrapper = document.createElement('div'),
            new_form = document.createElement('form'),
            send_button = document.createElement('a')
            cancel_button = send_button.cloneNode(false),
            new_textarea = document.createElement('textarea');

        // form wrapper
        form_wrapper.setAttribute('class', 'cs-comment-form cs-comment-child');
        form_wrapper.setAttribute('id', 'comment-form-reply');

        if (parent.getAttribute('data-depth') >= 2) {
            form_wrapper.classList.add('cs-comment-no-indent');
        }

        // Send Button
        send_button.setAttribute('class', 'cs-button cs-button-sm');
        send_button.innerHTML = 'Submit';

        // Cancel Button
        cancel_button.setAttribute('class', 'cs-button cs-button-sm cs-button-cancel');
        cancel_button.innerHTML = 'Cancel';

        // Text box
        new_textarea.setAttribute('name', 'reply_body');
        new_textarea.setAttribute('rows', '4');
        new_textarea.setAttribute('placeholder', 'Reply here.....');

        // Build Form
        new_form.appendChild(new_textarea);
        new_form.appendChild(send_button);
        new_form.appendChild(cancel_button);
        form_wrapper.appendChild(new_form);

        // Insert after original post
        parent.insertBefore(form_wrapper, parent.firstElementChild.nextSibling);
    }

    if (form) {
        var container = document.getElementById('comments'),
            // clear = document.getElementById('form_clear'),
            header = document.getElementById('form_header'),
            parent_id = document.getElementById('parent_id');

        // Reply link functionality
        container.addEventListener('click', function(e) {
            var target = e.target,
                container = target.parentNode.parentNode.parentNode.parentNode.parentNode, // What a magical beast!!
                reply_form = document.getElementById("comment-form-reply");

            if (target.classList.contains('cs-button-cancel') && target.parentNode.parentNode === reply_form) {
                reply_form.parentNode.removeChild(reply_form);
            }

            if (target.classList.contains('reply')) {
                e.preventDefault();

                // Remove existing reply form
                if (reply_form) {
                    reply_form.parentNode.removeChild(reply_form);
                }

                createForm(container);

                // var comment = target.getAttribute('data-id'),
                //     name = target.getAttribute('data-name');
                //
                // Set parent_id for reply post
                // parent_id.setAttribute('value', comment);
            }
        });
    }
})();
