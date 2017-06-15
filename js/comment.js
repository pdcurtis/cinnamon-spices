(function() {
    var form = document.getElementById('form-master'),
        count = document.getElementById('count'),

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

        console.log(userInfo);

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

        avatarWrapper.setAttribute('class', 'cs-media-image cs-comment-image');
        createAvatar(avatarWrapper, userInfo);

        authorName.setAttribute('class', 'cs-comment-author-name');
        authorName.appendChild(document.createTextNode(userInfo.name));

        authorDate.setAttribute('class', 'cs-comment-date');
        authorDate.appendChild(document.createTextNode('1 second ago'));

        authorLink.setAttribute('class', 'url');
        authorLink.setAttribute('target', '_blank');
        authorLink.href = userInfo.link;
        authorLink.appendChild(authorName);

        commentAuthor.setAttribute('class', 'cs-comment-author cs-flex-row');
        commentAuthor.appendChild(authorLink);
        commentAuthor.appendChild(authorSpacer);
        commentAuthor.appendChild(authorDate);

        commentBody.setAttribute('class', 'cs-comment-text');
        commentBody.appendChild(message);

        contentWrapper.setAttribute('class', 'cs-media-content cs-flex-column cs-flex-grow');
        contentWrapper.appendChild(commentAuthor);
        contentWrapper.appendChild(commentBody);

        commentWrapper.setAttribute('class', 'cs-comment cs-media');
        commentWrapper.appendChild(avatarWrapper);
        commentWrapper.appendChild(contentWrapper);

        replyWrapper.setAttribute('class', isChild);
        if (parent.getAttribute('data-depth') >= 2) {
            replyWrapper.classList.add('cs-comment-no-indent');
        }
        replyWrapper.appendChild(commentWrapper);

        if (before) {
            parent.insertBefore(replyWrapper, parent.firstElementChild);
        } else {
            parent.insertBefore(replyWrapper, parent.firstElementChild.nextSibling);
        }

        updateCount();
    }

    function createLoader(location, user, before) {
        var loader = div.cloneNode(false),
            avatar = div.cloneNode(false),
            wrapper = div.cloneNode(false),
            content = div.cloneNode(false),
            comment = div.cloneNode(false),
            isChild = (before === true) ? 'cs-comment-parent' : 'cs-comment-child';

        avatar.setAttribute('class', 'cs-media-image cs-comment-image');
        createAvatar(avatar, user);

        loader.setAttribute('class', 'loader');
        loader.appendChild(document.createTextNode('Loading...'));


        wrapper.setAttribute('class', isChild);
        wrapper.setAttribute('id', 'loader');

        if (location.getAttribute('data-depth') >= 2) {
            wrapper.classList.add('cs-comment-no-indent');
        }

        content.setAttribute('class', 'cs-media-content cs-flex-column cs-flex-grow');
        content.appendChild(loader);

        comment.setAttribute('class', 'cs-comment cs-media');
        comment.appendChild(avatar);
        comment.appendChild(content)
        wrapper.appendChild(comment);

        if (before) {
            location.insertBefore(wrapper, location.firstElementChild);
        } else {
            location.insertBefore(wrapper, location.firstElementChild.nextSibling);
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

    function removeSelf(item) {
        item.parentNode.removeChild(item);
    }

    function updateCount() {
        var current = Number(count.textContent);;
        current += 1;
        count.innerHTML = current;
    }

    // Check to see if master form exists.
    // This implies the user is logged in going forward.
    if (form) {
        var comments = document.getElementById('comment-box'),
            masterBody = document.getElementById('master-body'),
            replyForm,
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
                    removeSelf(replyForm);
                }
            }
        });


        comments.addEventListener('click', function(e) {
            var target = e.target,
                replyParentId = target.getAttribute('data-id') || target.parentNode.getAttribute('data-parent'),
                container = target.parentNode.parentNode.parentNode.parentNode.parentNode; // What a magical beast!!

            replyForm = document.getElementById("form-reply");

            // Cancel Button functionality
            if (target.classList.contains('cancel')) {
                e.preventDefault();

                if (target.parentNode.parentNode === replyForm) {
                    removeSelf(replyForm);
                } else if (target.parentNode === form) {
                    removeButtons(masterBody);
                }
            }

            // Submit Button functionality
            if (target.classList.contains('submit')) {
                var commentBody = document.getElementById('comments'),
                    replyForm = document.getElementById("form-reply"),
                    submit = {
                        before: false,
                        category: type,
                        message: target.parentNode.body.value,
                        name:  user.name,
                        parent: (target.parentNode === form) ? '0' : replyParentId,
                        spice: spice
                    },

                    post = {
                        name: submit.name,
                        parent_id: submit.parent,
                        body: submit.message
                    };

                e.preventDefault();

                if (submit.message) {
                    submit['location'] = (target.parentNode === form) ? commentBody : target.parentNode.parentNode.parentNode;

                    function errorTest(data) {
                        var loader = document.getElementById('loader');

                        if (!(data >= 200 && data < 300)) {
                            submit.message = "An error was encountered while submiting your comment, Please try again later";
                        }

                        removeSelf(loader);
                        createReply(submit.location, user, submit.message, submit.before);
                    }

                    if (target.parentNode === form) {
                        removeButtons(masterBody);
                        submit.before = true;
                    } else {
                        removeSelf(replyForm);
                    }

                    createLoader(submit.location, user, submit.before);

                    ajaxCall(post, 'POST', '/comment/submit/'+type+'/'+spice, errorTest);
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
                    removeSelf(replyForm);
                }

                createForm(container, user, replyParentName, replyParentId);
            }
        });
    }
})();
