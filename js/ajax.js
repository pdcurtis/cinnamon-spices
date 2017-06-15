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
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                if (callback) {
                    callback(JSON.parse(httpRequest.responseText));
                }
            } else {
                callback(httpRequest.status);
            }
        }
    };

    httpRequest.open(type, url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send(builtQuery);
}
