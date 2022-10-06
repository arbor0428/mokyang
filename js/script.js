$(function(){

    AOS.init(); //aos 플러그인 동작 실행


    // 처음에 스크롤바 위치 0, 비주얼 사람들 순자척으로 등장

    $(window).on("load",function(){

        $("html,body").stop().animate({"scrollTop":0},10);

        $(".pplWrap .ppl01").stop().animate({"opacity":1},600,function(){
            $(".pplWrap .ppl02").stop().animate({"opacity":1},600,function(){
                $(".pplWrap .ppl03").stop().animate({"opacity":1},600,function(){
                    $(".pplWrap .ppl04").stop().animate({"opacity":1},600,function(){
                        $(".pplWrap .ppl05").stop().animate({"opacity":1},600,function(){
                            $(".pplWrap .balloon").stop().animate({"opacity":1},400);
                        });
                    
                    });
                });
            });

        });
    });

    //스크롤버튼

    $(".upward").hide();

    $(window).scroll(function(){

        if($(this).scrollTop()>450){
            $(".upward").fadeIn();
        }else{
            $(".upward").fadeOut();
        }

    });

    // visual 반응형

    $(window).on("resize",function(){
        let browerWid = $(this).innerWidth();
        // console.log(browerWid);
        if(browerWid > 1210) {
            $(".mpplWrap").hide();
            $(".pplWrap").show();
            $(".m-navWrap").stop().removeClass("on");
        }
        else {
            $(".mpplWrap").show();
            $(".pplWrap").hide();
        }
    });


    //pc - header depth2
        
    $(".nav > li").mouseenter(function(event){

        event.preventDefault();

        let navnumber = $(this).index();
        console.log(navnumber);

        $(".nav > li").removeClass("on");
        $(this).addClass("on");

        $(".depthWrap .depthbg").stop().animate({"height":"350px"},200,function(){
            $(".depthWrap .depthbox").css({"opacity":0,"display":"none"});
            $(".depthWrap .depthbox").eq(navnumber).css({"opacity":1,"display":"block"});
        });


    });


    $(".navcont").mouseleave(function(event){

        event.preventDefault();

        $(".nav > li").removeClass("on");

        $(".depthWrap .depthbg").stop().animate({"height":"0"},200);
        $(".depthWrap .depthbox").css({"opacity":0,"display":"none"});

    });

	// jQuery.fn.gnb = function(options) {
    //     var opts = jQuery.extend(options);
    //     var gnb = jQuery(this);
    //     var gnbList = gnb.find('>ul>li');
    //     var submenu = gnb.find('.submenu');
    //     var submenuList = submenu.find('>ul>li');
    //     var submenuBg = jQuery('.submenu_bg');

    //     function showMenu() {
    //         t = jQuery(this).parent('li');
    //         if (!t.hasClass('active')) {
    //             gnbList.removeClass('current');
    //             gnbList.removeClass('active');
    //             gnbList.bind("focus mouseover",function(){
    //                 jQuery(this).addClass("active");
    //             });
    //             gnbList.bind("mouseleave",function(){
    //                 jQuery(this).removeClass("active");
    //             });
                
    //         }
    //         submenuBg.show();
    //         submenuBg.stop(true, false).animate({height:290},200, 'swing',function(){
    //             submenu.fadeIn(200);
    //         });
    //     }
    // }



    //모바일 gnb depth2

    $(".m-btn").click(function(event){

        event.preventDefault();

        $(".m-navWrap").stop().addClass("on");
    });

    $(".closeBtn").click(function(event){

        event.preventDefault();

        $(".m-navWrap").stop().removeClass("on");
        $(".m-depth2").stop().slideUp();
        $(".m-nav > li").removeClass("on");
    });

    $(".m-nav > li > a").on("click",function(event){

        event.preventDefault();
        
        $(this).parent().siblings().children(".m-depth2").stop().slideUp();

        $(this).siblings(".m-depth2").stop().slideToggle();

        $(this).parent().siblings().removeClass("on");
        $(this).parent().toggleClass("on");

    });


    //cont2 tab
           
    $("#btn1 > li").on("click",function(event){

        event.preventDefault();

        let tabNumber = $(this).index();

        $("#btn1 > li").removeClass("on");
        $(this).addClass("on");

        $("#cont1 .cont-list").stop().fadeOut(400);
        $("#cont1 .cont-list").eq(tabNumber).stop().fadeIn(500);

    });


    //top버튼 눌렀을씨 맨위로
    $(".upward a").click(function(){
        $("html,body").animate({scrollTop:"0"});
        return false;
    });

});