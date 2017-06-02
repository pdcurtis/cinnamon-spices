// Universal Ajax function
// Currently Only set up to use POST
// Query NEEDS to be submitted as an object

function ajaxCall(query, url, callback) {
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

    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send(builtQuery);
}
