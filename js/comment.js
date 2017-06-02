(function() {
    var form = document.getElementById('form-master');


    // Create SUBMIT / CANCEL buttons
    function createButtons(parent) {
        var buttonSend = document.createElement('a'),
            buttonCancel = buttonSend.cloneNode(false);

        // Send Button
        buttonSend.setAttribute('class', 'cs-button cs-button-sm submit');
        buttonSend.innerHTML = 'Submit';

        // Cancel Button
        buttonCancel.setAttribute('class', 'cs-button cs-button-sm cs-button-cancel cancel');
        buttonCancel.innerHTML = 'Cancel';

        parent.appendChild(buttonSend);
        parent.appendChild(buttonCancel);
    }

    // Create Reply Form
    function createForm(parent, userInfo) {
        var formWrapper = document.createElement('div'),
            newForm = document.createElement('form'),
            newTextarea = document.createElement('textarea'),
            userLink = document.createElement('a'),
            userAvatar = document.createElement('img'),
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
        userLink.href = userInfo.link;

        userAvatar.setAttribute('class', 'avatar avatar-50 photo');
        userAvatar.setAttribute('alt', userInfo.name);
        userAvatar.src = userInfo.avatar;

        userLink.appendChild(userAvatar);
        userWrapper.appendChild(userLink);

        // Text box
        newTextarea.setAttribute('name', 'reply_body');
        newTextarea.setAttribute('rows', '4');
        newTextarea.setAttribute('placeholder', 'Reply here.....');

        // Build Form
        newForm.appendChild(newTextarea);
        createButtons(newForm);

        formWrapper.appendChild(userWrapper);
        formWrapper.appendChild(newForm);

        // Insert after original post
        parent.insertBefore(formWrapper, parent.firstElementChild.nextSibling);
    }

    function removeButtons(sibling) {
        var buttonList = sibling.parentNode.querySelectorAll('.cs-button'),
            i;

        for (i = 0; i < buttonList.length; i++) {
            buttonList[i].parentNode.removeChild(buttonList[i]);
        }

        sibling.parentNode.classList.remove('active');
    }

    if (form) {
        var comments = document.getElementById('comment-box'),
            masterBody = document.getElementById('master-body'),
            replyForm = document.getElementById("comment-form-reply"),
            masterButtons,
            user;

        function assignUser(data) {
            user = data;
        }

        ajaxCall({}, 'GET', '/comment/get_user', assignUser);

        // Master Comment functionality
        masterBody.addEventListener('focus', function(e) {
            replyForm = document.getElementById("comment-form-reply");
            
            if (!masterButtons) {
                createButtons(masterBody.parentNode);
                masterBody.parentNode.classList.add('active');
                masterButtons = masterBody.parentNode.querySelectorAll('.cs-button');

                if (replyForm) {
                    replyForm.parentNode.removeChild(replyForm);
                }
            }
        });

        // Reply link functionality
        comments.addEventListener('click', function(e) {
            var target = e.target,
                replyForm = document.getElementById("comment-form-reply"),
                container = target.parentNode.parentNode.parentNode.parentNode.parentNode; // What a magical beast!!

            if (target.classList.contains('cancel')) {
                if (target.parentNode.parentNode === replyForm) {
                    console.log('fire');
                    replyForm.parentNode.removeChild(replyForm);
                }

                if (target.parentNode === form) {
                    console.log('fire 2')
                    removeButtons(masterBody);
                    masterButtons = null;
                }
            }

            if (target.classList.contains('reply')) {
                e.preventDefault();

                if (form.classList.contains('active')) {
                    removeButtons(masterBody);
                    masterButtons = null;
                }

                // Remove existing reply form
                if (replyForm) {
                    replyForm.parentNode.removeChild(replyForm);
                }

                createForm(container, user);
            }
        });
    }
})();
