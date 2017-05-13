(function() {
    // Check for comment-box
    if (document.getElementById('comment_form')) {
        var container = document.getElementById('comments'),
            form = document.getElementById('comment_form'),
            clear = document.getElementById('form_clear'),
            header = document.getElementById('form_header'),
            parent_id = document.getElementById('parent_id');

        // Reset form when cancel button is used
        clear.addEventListener('click', function(e) {
            e.preventDefault();

            header.innerHTML = 'Leave A Comment.';
            parent_id.setAttribute('value', '0');
            form.reset();
        });

        // Reply link functionality
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

            var target = e.target,
                lnkFB = document.getElementById('lnkLoginFacebook'),
                lnkGg = document.getElementById('lnkLoginGoogle'),
                lnkGH = document.getElementById('lnkLoginGitHub');

            if (target.id = lnkFB) {
                openCinnamonSpicesOAuthLoginWindow('/auth/facebook');
            }

            if (target.id = lnkGg) {
                openCinnamonSpicesOAuthLoginWindow('/auth/google');
            }

            if (target.id = lnkGH) {
                openCinnamonSpicesOAuthLoginWindow('/auth/github');
            }
        })
    }
})();

(function(){

    var input = document.getElementById('cs-xlet-search-input');
    var container = document.getElementById('cs-xlet-search-results-container');
    var ul = document.getElementById('cs-xlet-search-results-list');

    var searchUrl = '';
    var searchType = '';

    if(typeof input === 'object' && typeof container === 'object') {

        input.onkeyup = inputKeyUpHandler;

        console.log(input.dataset);

        if(input.dataset['searchUrl']) {
            searchUrl = input.dataset['searchUrl'];
        }
        if(input.dataset['searchType']) {
            searchType = input.dataset['searchType'];
        }
    }

    function inputKeyUpHandler(e) {
        if(e && e.target && searchUrl && searchType) {
            getResults(e.target.value, buildResult)
        }
    }

    function buildResult(data) {
        var total = data.length;
        ul.innerHTML = '';
        if(total > 0) {
            container.style.display = 'block';
            var html = '';
            for(var i=0; i<(total>10?10:total); i++) {
                html += '<li>';
                html += '<a href="/'+searchType+'/view/'+data[i]['id']+'">';
                html += '<img src="'+data[i]['icon']+'"/>';
                html += data[i]['name'];
                html += '</a>';
                html += '</li>';
                console.log(data[i]);
            }
            ul.innerHTML = html;
        } else {
            container.style.display = 'none';
        }
    }

    function getResults(q, callback) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === 4 && httpRequest.status === 200) {
                callback(JSON.parse(httpRequest.responseText));
            }
        };
        httpRequest.open('POST', searchUrl);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('q=' + encodeURIComponent(q));
    }

    document.querySelector('body').onclick = function() {
        container.style.display = 'none';
    }

})();