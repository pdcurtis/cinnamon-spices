(function() {
    var form = document.getElementById('comment-form-master');

    // Create Reply Form
    function createForm(parent, userInfo) {
        var formWrapper = document.createElement('div'),
            newForm = document.createElement('form'),
            newTextarea = document.createElement('textarea'),
            buttonSend = document.createElement('a')
            buttonCancel = buttonSend.cloneNode(false),
            userLink = buttonSend.cloneNode(false),
            userAvatar = document.createElement('img')
            userWrapper = formWrapper.cloneNode(false);

        // Form Wrapper
        formWrapper.setAttribute('class', 'cs-comment-form cs-comment-form-reply cs-comment-child cs-media');
        formWrapper.setAttribute('id', 'comment-form-reply');

        if (parent.getAttribute('data-depth') >= 2) {
            formWrapper.classList.add('cs-comment-no-indent');
        }

        // Form
        newForm.setAttribute('class', 'cs-media-content');

        // User Avatar
        userWrapper.setAttribute('class', 'cs-comment-image cs-media-image');

        userLink.setAttribute('class', 'url');
        userLink.setAttribute('target', '_blank');
        userLink.href = user.link;

        userAvatar.setAttribute('class', 'avatar avatar-50 photo');
        userAvatar.setAttribute('alt', user.name);
        userAvatar.src = user.avatar;

        userLink.appendChild(userAvatar);
        userWrapper.appendChild(userLink);

        // Send Button
        buttonSend.setAttribute('class', 'cs-button cs-button-sm');
        buttonSend.innerHTML = 'Submit';

        // Cancel Button
        buttonCancel.setAttribute('class', 'cs-button cs-button-sm cs-button-cancel');
        buttonCancel.innerHTML = 'Cancel';

        // Text box
        newTextarea.setAttribute('name', 'reply_body');
        newTextarea.setAttribute('rows', '4');
        newTextarea.setAttribute('placeholder', 'Reply here.....');

        // Build Form
        newForm.appendChild(newTextarea);
        newForm.appendChild(buttonSend);
        newForm.appendChild(buttonCancel);

        formWrapper.appendChild(userWrapper);
        formWrapper.appendChild(newForm);

        // Insert after original post
        parent.insertBefore(formWrapper, parent.firstElementChild.nextSibling);
    }

    if (form) {
        var container = document.getElementById('comments'),
            // clear = document.getElementById('form_clear'),
            header = document.getElementById('form_header'),
            parent_id = document.getElementById('parent_id'),
            user;

        function assignUser(data) {
            user = data;
        }

        ajaxCall({}, 'GET', '/comment/get_user', assignUser);

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

                createForm(container, user);

                // var comment = target.getAttribute('data-id'),
                //     name = target.getAttribute('data-name');
                //
                // Set parent_id for reply post
                // parent_id.setAttribute('value', comment);
            }
        });
    }
})();
