
function isMobile(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        // You are in mobile browser
        return true;
    } else {
        return false;
    }
}

var isMobile = isMobile();
handleNavHeight();
handleNav();

$( window ).scroll( function (){
    var currentScroll = document.body.scrollTop || document.documentElement.scrollTop;
    console.log("scroll value = " + currentScroll);
    if(currentScroll > 200){
        $("div#userInfos").addClass("scrolledUserInfo");
        $("div#blank50pxheight").show();
    }else{
        $("div#userInfos").removeClass("scrolledUserInfo");
        $("div#blank50pxheight").hide();
    }
})

$( window ).resize(function() {
    handleNavHeight();
    handleNav();
})

$(document).ready(function(){
    handleNavHeight();
    handleNav();
})

function handleNavHeight(){
    var windowHeight = window.innerHeight;
    var headerHeight = $("header").height();
    //var FooterHeight = $("#bas").height() + 20; // + border width
    //$("body").css("min-height", windowHeight);
    $("nav").css("min-height", (windowHeight - headerHeight));
    $("#conteneur").css("min-height", (windowHeight - headerHeight));
}

function handleNav(){
    var windowWidth = window.innerWidth;
    if( isMobile ) {
        // You are in mobile browser
        $("nav").hide();
    } else {
        if(windowWidth < 900){
            $("nav").hide();
            $("#ThreeLineMenu").show();
        } else {
            $("nav").show();
            $("#ThreeLineMenu").hide();
        }
    }

    //console.log("windowWidth = " + windowWidth);
}

function toogleMenu(){
    //console.log("coucou");
    $("nav").toggle();
}

