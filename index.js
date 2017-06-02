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
