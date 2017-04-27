document.addEventListener("DOMContentLoaded", function() {
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
    var lnkFB = document.getElementById('lnkLoginFacebook');
    if(lnkFB) {
        lnkFB.onclick = function (e) {
            e.preventDefault();
            openCinnamonSpicesOAuthLoginWindow('/auth/facebook');
        };
    }
    var lnkGg = document.getElementById('lnkLoginGoogle');
    if(lnkGg) {
        lnkGg.onclick = function (e) {
            e.preventDefault();
            openCinnamonSpicesOAuthLoginWindow('/auth/google');
        };
    }
    var lnkGH = document.getElementById('lnkLoginGitHub');
    if(lnkGH) {
        lnkGH.onclick = function (e) {
            e.preventDefault();
            openCinnamonSpicesOAuthLoginWindow('/auth/github');
        };
    }
});