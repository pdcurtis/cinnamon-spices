(function() {
    var form = document.getElementById('form-master'),

        // Blank Nodes for cloning
        a = document.createElement('a'),
        div = document.createElement('div'),
        img = document.createElement('img'),
        span = document.createElement('span');

    // Element Creation funcs
    function createAvatar(parent, person) {
        var userLink = a.cloneNode(false),
            userAvatar = img.cloneNode(false);

        userLink.setAttribute('class', 'url');
        userLink.setAttribute('target', '_blank');
        userLink.href = person.link;

        userAvatar.setAttribute('class', 'avatar avatar-50 photo');
        userAvatar.setAttribute('alt', person.name);
        userAvatar.src = person.avatar;

        userLink.appendChild(userAvatar);
        parent.appendChild(userLink);
    }

    function createButtons(parent) {
        var buttonSend = a.cloneNode(false),
            buttonCancel = a.cloneNode(false);

        // Send Button
        buttonSend.setAttribute('class', 'cs-button cs-button-sm submit');
        buttonSend.href = '#';
        buttonSend.innerHTML = 'Submit';

        // Cancel Button
        buttonCancel.setAttribute('class', 'cs-button cs-button-sm cs-button-cancel cancel');
        buttonCancel.href = '#';
        buttonCancel.innerHTML = 'Cancel';

        parent.appendChild(buttonSend);
        parent.appendChild(buttonCancel);
    }

    function createTextarea(parent, person) {
        var area = document.createElement('textarea');

        area.setAttribute('name', 'body');
        area.setAttribute('rows', '4');
        area.setAttribute('placeholder', 'Reply to ' + person + ' here.....');

        parent.appendChild(area);
    }

    // Create Reply Form
    function createForm(parent, userInfo, parentUser, parentId) {
        var formWrapper = div.cloneNode(false),
            avatarWrapper = div.cloneNode(false),
            newForm = document.createElement('form');

        // Wrapper
        formWrapper.setAttribute('class', 'cs-comment-form cs-comment-form-reply cs-comment-child cs-media');
        formWrapper.setAttribute('id', 'form-reply');

        // Set no indent to maintain depth limitations
        if (parent.getAttribute('data-depth') >= 2) {
            formWrapper.classList.add('cs-comment-no-indent');
        }

        // Form
        newForm.setAttribute('class', 'cs-media-content');
        newForm.setAttribute('data-parent', parentId);

        // Avatar Wrapper
        avatarWrapper.setAttribute('class', 'cs-comment-image cs-media-image');

        // Build Form
        createAvatar(avatarWrapper, userInfo);
        createTextarea(newForm, parentUser);
        createButtons(newForm);
        formWrapper.appendChild(avatarWrapper);
        formWrapper.appendChild(newForm);

        // Insert after original post
        parent.insertBefore(formWrapper, parent.firstElementChild.nextSibling);
    }

    function createReply(parent, userInfo, userMessage, before) {
        var replyWrapper = div.cloneNode(false),
            commentWrapper = div.cloneNode(false),
            commentAuthor = div.cloneNode(false),
            commentBody = div.cloneNode(false),
            avatarWrapper = div.cloneNode(false),
            contentWrapper = div.cloneNode(false),
            authorName = span.cloneNode(false),
            authorDate = span.cloneNode(false),
            authorLink = a.cloneNode(false),
            authorSpacer = document.createTextNode('-'),
            message = document.createTextNode(userMessage),
            isChild = (before === true) ? 'cs-comment-parent' : 'cs-comment-child';

        replyWrapper.setAttribute('class', isChild);
        if (parent.getAttribute('data-depth') >= 2) {
            replyWrapper.classList.add('cs-comment-no-indent');
        }

        commentWrapper.setAttribute('class', 'cs-comment cs-media');

        avatarWrapper.setAttribute('class', 'cs-media-image cs-comment-image');

        contentWrapper.setAttribute('class', 'cs-media-content cs-flex-column cs-flex-grow');
        commentAuthor.setAttribute('class', 'cs-comment-author cs-flex-row');

        authorLink.setAttribute('class', 'url');
        authorLink.setAttribute('target', '_blank');
        authorLink.href = userInfo.link;

        authorName.setAttribute('class', 'cs-comment-author-name');
        authorName.appendChild(document.createTextNode(user.name));

        authorDate.setAttribute('class', 'cs-comment-date');
        authorDate.appendChild(document.createTextNode('1 second ago'));

        authorLink.appendChild(authorName);
        commentAuthor.appendChild(authorLink);
        commentAuthor.appendChild(authorSpacer);
        commentAuthor.appendChild(authorDate);

        commentBody.setAttribute('class', 'cs-comment-text');

        commentBody.appendChild(message);

        contentWrapper.appendChild(commentAuthor);
        contentWrapper.appendChild(commentBody);

        createAvatar(avatarWrapper, userInfo);

        commentWrapper.appendChild(avatarWrapper);
        commentWrapper.appendChild(contentWrapper);

        replyWrapper.appendChild(commentWrapper);

        if (before) {
            parent.insertBefore(replyWrapper, parent.firstElementChild);
        } else {
            parent.insertBefore(replyWrapper, parent.firstElementChild.nextSibling);
        }
    }

    // Remove Element Funcs
    function removeButtons(sibling) {
        var buttonList = sibling.parentNode.querySelectorAll('.cs-button');

        for (var i = 0; i < buttonList.length; i++) {
            buttonList[i].parentNode.removeChild(buttonList[i]);
        }

        masterButtons = null;
        sibling.value = "";
    }

    function removeForm(item) {
        item.parentNode.removeChild(item);
    }

    // Check to see if master form exists.
    // This implies the user is logged in going forward.
    if (form) {
        var comments = document.getElementById('comment-box'),
            masterBody = document.getElementById('master-body'),
            replyForm = document.getElementById("form-reply"),
            type = comments.getAttribute('data-type'),
            spice = comments.getAttribute('data-spice'),
            masterButtons = null,
            user;

        function assignUser(data) {
            user = data;
        }

        ajaxCall({}, 'GET', '/comment/get_user', assignUser);

        // Master Comment functionality
        masterBody.addEventListener('focus', function(e) {
            replyForm = document.getElementById("form-reply");

            if (!masterButtons) {
                createButtons(masterBody.parentNode);
                masterButtons = masterBody.parentNode.querySelectorAll('.cs-button');

                if (replyForm) {
                    removeForm(replyForm);
                }
            }
        });


        comments.addEventListener('click', function(e) {
            var target = e.target,
                replyForm = document.getElementById("form-reply"),
                replyParentId = target.getAttribute('data-id') || target.parentNode.getAttribute('data-parent'),
                container = target.parentNode.parentNode.parentNode.parentNode.parentNode; // What a magical beast!!

            // Cancel Button functionality
            if (target.classList.contains('cancel')) {
                e.preventDefault();

                if (target.parentNode.parentNode === replyForm) {
                    removeForm(replyForm);
                } else if (target.parentNode === form) {
                    removeButtons(masterBody);
                }
            }

            // Submit Button functionality
            if (target.classList.contains('submit')) {
                var commentBody = document.getElementById('comments');
                    submitName = user.name,
                    submitParent = (target.parentNode === form) ? '0' : replyParentId,
                    submitMessage = target.parentNode.body.value,
                    submit = {
                        name: submitName,
                        parent_id: submitParent,
                        body: submitMessage
                    };

                e.preventDefault();
                if (submitMessage) {
                    var submitLocation = (target.parentNode === form) ? commentBody : target.parentNode.parentNode.parentNode,
                        submitBefore = false;
                    if (target.parentNode === form) {
                        removeButtons(masterBody);
                        submitBefore = true;
                    } else {
                        removeForm(replyForm);
                    }

                    createReply(submitLocation, user, submitMessage, submitBefore);
                    
                    ajaxCall(submit, 'POST', '/comment/submit/'+type+'/'+spice);
                }
            }

            // Reply link functionality
            if (target.classList.contains('reply')) {
                var replyParentName = target.getAttribute('data-name');
                e.preventDefault();

                if (masterButtons) {
                    removeButtons(masterBody);
                }

                if (replyForm) {
                    removeForm(replyForm);
                }

                createForm(container, user, replyParentName, replyParentId);
            }
        });
    }
})();
