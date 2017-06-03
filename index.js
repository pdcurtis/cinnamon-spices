// Universal Ajax function
// Query NEEDS to be submitted as an object

function ajaxCall(query, type, url, callback) {
    var httpRequest = new XMLHttpRequest(),
        builtQuery = [];

    // Build and format query
    for (var prop in query) {
        builtQuery.push(prop + "=" + encodeURIComponent(query[prop]));
    }

    builtQuery = builtQuery.join('&').replace(/%20/g, '+');

    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4 && httpRequest.status === 200) {
            callback(JSON.parse(httpRequest.responseText));
        }
    };

    httpRequest.open(type, url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send(builtQuery);
}

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
    function createForm(parent, userInfo, parentUser, parentId) {
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
        newTextarea.setAttribute('placeholder', 'Reply to ' + parentUser + ' here.....' + parentId);

        // Build Form
        newForm.appendChild(newTextarea);
        createButtons(newForm);

        formWrapper.appendChild(userWrapper);
        formWrapper.appendChild(newForm);

        // Insert after original post
        parent.insertBefore(formWrapper, parent.firstElementChild.nextSibling);
    }

    function removeButtons(sibling) {
        var buttonList = sibling.parentNode.querySelectorAll('.cs-button');

        for (var i = 0; i < buttonList.length; i++) {
            buttonList[i].parentNode.removeChild(buttonList[i]);
        }

        masterButtons = null;
    }

    function removeForm(item) {
        item.parentNode.removeChild(item);
    }

    // Check to see if master form exists.
    // This implies the user is logged in going forward.
    if (form) {
        var comments = document.getElementById('comment-box'),
            masterBody = document.getElementById('master-body'),
            replyForm = document.getElementById("comment-form-reply"),
            masterButtons = null,
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
                masterButtons = masterBody.parentNode.querySelectorAll('.cs-button');

                if (replyForm) {
                    removeForm(replyForm);
                }
            }
        });


        comments.addEventListener('click', function(e) {
            var target = e.target,
                replyForm = document.getElementById("comment-form-reply"),
                container = target.parentNode.parentNode.parentNode.parentNode.parentNode; // What a magical beast!!

            // Cancel Button functionality
            if (target.classList.contains('cancel')) {
                if (target.parentNode.parentNode === replyForm) {
                    removeForm(replyForm);
                } else if (target.parentNode === form) {
                    removeButtons(masterBody);
                }
            }

            // Reply link functionality
            if (target.classList.contains('reply')) {
                var replyParentName = target.getAttribute('data-name'),
                    replyParentId = target.getAttribute('data-id');

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

(function() {
    function openCinnamonSpicesOAuthLoginWindow(url) {
       var w = 1024;
       var h = 650;
       var t = (screen.height/2)-(h/2);
       var l = (screen.width/2)-(w/2);
       window.open(
           url,
           "CinnamonSpicesOAuthLoginWindow",
           "width="+w+",height="+h+",top="+t+",left="+l+
           ",toolbar=no,location=no,resizable=no,scrollbars=no,status=0,centerscreen=yes"
       );
    }

    var oauth_links = document.getElementsByClassName('oauth-link');

    for ( var i = 0; i < oauth_links.length; i ++) {
        var link = oauth_links[i];

        link.addEventListener('click', function(e) {
            e.preventDefault();

            var target = this,
                lnkFB = document.getElementById('lnkLoginFacebook'),
                lnkGg = document.getElementById('lnkLoginGoogle'),
                lnkGH = document.getElementById('lnkLoginGitHub');

            if (target === lnkFB) {
                openCinnamonSpicesOAuthLoginWindow('/auth/facebook');
            }

            if (target === lnkGg) {
                openCinnamonSpicesOAuthLoginWindow('/auth/google');
            }

            if (target === lnkGH) {
                openCinnamonSpicesOAuthLoginWindow('/auth/github');
            }
        });
    }
})();

(function () {

    var input = document.getElementById('cs-xlet-search-input');
    var container = document.getElementById('cs-xlet-search-results-container');
    var ul = document.getElementById('cs-xlet-search-results-list');
    var selectedRow = -1;
    var currentResult = [];

    var searchUrl = '';
    var searchType = '';
    var searchKey = 'id';

    if (input && container) {

        input.onkeyup = inputKeyUpHandler;

        if (input.dataset['searchUrl']) {
            searchUrl = input.dataset['searchUrl'];
        }
        if (input.dataset['searchType']) {
            searchType = input.dataset['searchType'];
        }
        if (input.dataset['searchKey']) {
            searchKey = input.dataset['searchKey'];
        }
    }

    function inputKeyUpHandler(e) {
        if (e && e.target && searchUrl && searchType) {
            if (e.keyCode === 38) {
                if(selectedRow >= 0) {
                    selectedRow -= 1;
                    selectRow();
                }
            } else if (e.keyCode === 40) {
                if (selectedRow < 9)
                    selectedRow += 1;
                selectRow();
            } else if(e.keyCode === 27) {
                selectedRow = -1;
                container.style.display = 'none';
            } else if(e.keyCode === 13) {
                if(selectedRow >= 0) {
                    var link = document.querySelector('#cs-xlet-search-result-link-'+selectedRow);
                    link.click();
                }
            } else {
                ajaxCall({q: e.target.value}, 'POST', searchUrl, buildResult);
            }
        }
    }

    function selectRow() {
        var rows = document.querySelectorAll('a.cs-xlet-search-results-link');
        for(var i=0;i<rows.length;i++) {
            if(i===selectedRow) {
                rows[i].parentElement.className = 'active';
            } else {
                rows[i].parentElement.className = '';
            }
        }
    }

    function buildResult(data) {
        currentResult = data;
        var total = data.length;
        ul.innerHTML = '';
        if (total > 0) {
            container.style.display = 'block';
            var html = '';
            for (var i = 0; i < (total > 10 ? 10 : total); i++) {
                var key = data[i][searchKey];
                html += '<li>';
                html += '<a class="cs-xlet-search-results-link" id="cs-xlet-search-result-link-' + i + '" href="/' + searchType + '/view/' + key + '">';
                if(data[i]['icon']) {
                    html += '<img src="' + data[i]['icon'] + '"/>';
                }
                html += data[i]['name'];
                html += '</a>';
                html += '</li>';
            }
            ul.innerHTML = html;
        } else {
            container.style.display = 'none';
        }
    }

    document.querySelector('body').onclick = function () {
        if(container) {
            container.style.display = 'none';
        }
    }

})();
