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
