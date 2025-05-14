
$(document).ready(function(){
$(window).scroll(function(event){
var st = $(this).scrollTop();
var lastScrollTop = 50;
if (st > lastScrollTop){$('.header').addClass('active');}else{$('.header').removeClass('active');}
lastScrollTop = st;
});
});


jQuery(document).ready(function (e) {function t(t) {e(t).bind("click", function (t) {t.preventDefault();e(this).parent().fadeOut()})}e(".dropdown-toggle").click(function () {var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");e(".button-dropdown .dropdown-menu").hide();e(".button-dropdown .dropdown-toggle").removeClass("active");if (t) {e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")}});e(document).bind("click", function (t) {var n = e(t.target);if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();});e(document).bind("click", function (t) {var n = e(t.target);if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");})});


$(document).ready(function(){
$('.menu-btn').click(function(){
$('body').toggleClass('menu-active');
});
});

$(document).ready(function(){
registerListener('load', setLazy);
registerListener('load', lazyLoad);
registerListener('scroll', lazyLoad);
var lazy = [];
function setLazy(){
lazy = document.getElementsByClassName('owl-lazy');
console.log('Found ' + lazy.length + ' lazy images');
}
function lazyLoad(){
    for(var i=0; i<lazy.length; i++){
        if(isInViewport(lazy[i])){
            if (lazy[i].getAttribute('data-src')){
                lazy[i].src = lazy[i].getAttribute('data-src');
                lazy[i].removeAttribute('data-src');
            }
        }
    }
    cleanLazy();
}
function cleanLazy(){
    lazy = Array.prototype.filter.call(lazy, function(l){ return l.getAttribute('data-src');});
}
function isInViewport(el){
    var rect = el.getBoundingClientRect();
    return (
        rect.bottom >= 0 && 
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) && 
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) && 
        rect.left <= (window.innerWidth || document.documentElement.clientWidth)
     );
}
function registerListener(event, func) {
    if (window.addEventListener) {
        window.addEventListener(event, func)
    } else {
        window.attachEvent('on' + event, func)
    }
}
});