$(function(){if(errCode!=0){$("#errorAlert").show()}else{$("#errorAlert").hide()}$("#loginForm").on("keydown",function(e){var evt=e||window.event;if(evt.keyCode==13){login()}});var activityImages=eval("("+$("#activityImages").val()+")");$("#centerActivityPicList").find("li").each(function(i){$(this).css("background","url(/images/loading.gif) no-repeat scroll 225px 80px").css("background-color","white");var img=$("<img>").css("width","450px").css("height","199px").css("opacity",0).attr("title",activityImages[i].name).attr("src",activityImages[i].image);$(this).find("a").append(img);var imgLoaded=imagesLoaded($(this));imgLoaded.on("done",function(image){img.css("opacity",1);$(this).find("a").css("background","")})});var newsImages=eval("("+$("#newsImages").val()+")");$("#newsImageDiv").find('a[rel="image"]').each(function(i){$(this).css("background","url(/images/loading.gif) no-repeat scroll 35px 30px").css("background-color","white");var img=$("<img>").css("width","99px").css("height","86px").css("opacity",0).addClass("media-object").attr("title",newsImages[i].name).attr("src",newsImages[i].image);$(this).append(img);var imgLoaded=imagesLoaded($(this));imgLoaded.on("done",function(image){img.css("opacity",1);$(this).css("background","")});if(is_login){$(".banner01").css("background","url('../images/banner04.png') center no-repeat #0D1955 ");$(".loginPanel").css("left","700px")}});var images=eval("("+$("#activityFooterImages").val()+")");$("#acList").find("li").each(function(i){$(this).css("background","url(/images/loading.gif) no-repeat scroll 80px 40px").css("background-color","white");var img=$("<img>").css("width","188px").css("height","112px").css("opacity",0).attr("title",images[i].name).attr("src","http://"+images[i].image);$(this).find("a").append(img);var imgLoaded=imagesLoaded($(this));imgLoaded.on("done",function(image){img.css("opacity",1);$(this).find("a").css("background","")})});var hezuoImages=eval("("+$("#hezuoFooterImages").val()+")");$("#hzList").find("li").each(function(i){$(this).css("background","url(/images/loading.gif) no-repeat scroll 60px 16px").css("background-color","white");var img=$("<img>").css("width","152px").css("height","56").css("opacity",0).attr("src",hezuoImages[i].image);$(this).find("a").append(img);var imgLoaded=imagesLoaded($(this));imgLoaded.on("done",function(image){img.css("opacity",1);$(this).find("a").css("background","")})})});function login(){var b=$("#login_name").val().replace(/\s+/g,"");var a=$("#source_password").val().replace(/\s+/g,"");if(b==""||a==""){show_login_error();return}a=md5(a);$("#password").val(a);$("#source_password").val("");$("#source_password").attr("disabled",true);$("#loginForm").submit()}function show_login_error(){if($("#errorAlert").attr("display")!="block"){$("#errorAlert").show()}setTimeout(function(){$("#errorAlert").hide()},1000)}$("#demo1").slide({mainCell:".bd ul",effect:"top",autoPlay:true,triggerTime:0});$("#activity-list").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:5});$("#hezuo-list").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:6});function changeToWhmj(){if($(".loginPanel").css("left")!="520px"){$("#login_type").val("whmj");$(".banner01").css("background","url('../images/banner03.png') center no-repeat #0D1955 ");moveToWhmj()}}function changeToPt(){if($(".loginPanel").css("left")!="145px"){$("#login_type").val("pt");$(".banner01").css("background","url('../images/banner01.png') center no-repeat #0D1955 ");moveToPt()}}function moveToPt(){$(".loginPanel").animate({left:"145px"},600)}function moveToWhmj(){$(".loginPanel").animate({left:"520px"},600)};