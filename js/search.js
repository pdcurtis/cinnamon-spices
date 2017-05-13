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