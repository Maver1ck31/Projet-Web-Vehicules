
$( window ).scroll( function (){
    var currentScroll = document.body.scrollTop || document.documentElement.scrollTop;
    //console.log("currentScroll = " + currentScroll);
    $("nav > ul").css("padding-top", currentScroll);
})

$( window ).resize(function() {
    handleNavHeight();
    handleNav();
})

$(document).ready(function(){
    handleNavHeight();
    handleNav();
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        // You are in mobile browser
        $("nav").hide();
    }
})

function handleNavHeight(){
    var windowHeight = window.innerHeight;
    var headerHeight = $("header").height();
    //var FooterHeight = $("#bas").height() + 20; // + border width
    //$("body").css("min-height", windowHeight);
    $("nav").css("min-height", (windowHeight - headerHeight));
}

function handleNav(){
    var windowWidth = window.innerWidth;
    (windowWidth < 900) ? $("nav").hide() : $("nav").show();
    //console.log("windowWidth = " + windowWidth);
}

function toogleMenu(){
    console.log("coucou");
    $("nav").toggle();
}

