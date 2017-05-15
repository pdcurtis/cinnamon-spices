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
                getResults(e.target.value, buildResult)
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

    function getResults(q, callback) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === 4 && httpRequest.status === 200) {
                callback(JSON.parse(httpRequest.responseText));
            }
        };
        httpRequest.open('POST', searchUrl);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send('q=' + encodeURIComponent(q));
    }

    document.querySelector('body').onclick = function () {
        if(container) {
            container.style.display = 'none';
        }
    }

})();