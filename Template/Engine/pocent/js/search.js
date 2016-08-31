function changeLanguage(language) {
    if (!language) { return; }
    var date = new Date();
    var expireDays = 365;
    date.setTime(date.getTime() + expireDays * 24 * 3600 * 1000);
    document.cookie = "locale=" + language + ";path=/; expires=" + date.toGMTString();
    window.location.reload();
}
var btbook = btbook || {
    getCookie: function (name) {
        var n = name + '=';
        var cl = document.cookie.split(';');
        for (var i = 0; i < cl.length; i++) {
            var ci = cl[i].trim();
            if (ci.indexOf(n) == 0) {
                return ci.substring(n.length, ci.length);
            }
            return '';
        }
    },
    setCookie: function (name, value, expireHours) {
        var d = new Date();
        d.setTime(d.getTime() + expireHours * 3600 * 1000);
        document.cookie = name + '=' + value + ';expires=' + d.toGMTString();
    }
};

function checkMobile() {
    var ua = navigator.userAgent;
    if (ua) {
        ua = ua.toLowerCase();
        var ignoreUa = ['ip', 'android', 'uc', 'phone', 'pad', 'bot', 'spider', 'slurp'];
        for (var i = 0; i < ignoreUa.length; i++) {
            if (ua.indexOf(ignoreUa[i]) > -1) return true;
        }
    }
    return window.screen.width < 1024;
}
var isMobile = checkMobile();

function isFirstPage() {
    var s = window.location.href.substring(window.location.href.lastIndexOf('/'));
    if (s.indexOf('/1') > -1)
        return true;
    if (s.indexOf('-') < 0)
        return true;
    return false;
}



function write_share() {
    if (!isMobile) {
        document.writeln('<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["tsina","fbook","qzone","linkedin","weixin","twi","renren","tieba","douban","sqq","diandian","fx","youdao","mail","ty","copy"],"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"7","bdPos":"right","bdTop":"150"}};with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>');
    }
}

function generateRandom(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}