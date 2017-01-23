document.addEventListener("DOMContentLoaded", function() {
    function openCinnamonSpicesOAuthLoginWindow(url) {
        window.open(
            url,
            "CinnamonSpicesOAuthLoginWindow",
            "width=420,height=230,resizable=no,scrollbars=no,status=0,centerscreen=yes"
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