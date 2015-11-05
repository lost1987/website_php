(function($){$.fn.extend({checkall:function(rel){$(this).click(function(){if(this.checked){$("body").find("input[rel='"+rel+"']").each(function(){this.checked=true})}else{$("body").find("input[rel='"+rel+"']").each(function(){this.checked=false})}})},form_validate_onlyNumbers:function(len,max){if(len==undefined){len=10}if(max==undefined){max=2147483657}$(this).each(function(){$(this).keyup(function(e){var value=$(this).val();if(value.length>len){$(this).val(value.substr(0,len))}else{if(parseInt(value)>max){$(this).val(value.substr(0,value.length-1))}}})})},form_validate_trimVal:function(){if($(this).length>1){alert("此方法只支持单个HTML元素");return}var val=$(this).val().replace(/\s+/g,"");return val},fly:function(opt){var _this,default_options,options,_source_width,_source_height,_top_to_fly,_clone,_source_offset_top,_source_next_tr;_this=$(this);default_options={element_type:"div",scroll_additional_top:0};options=$.extend({},default_options,opt);_source_width=_this.width();_source_height=_this.height();_top_to_fly=_source_offset_top=_this.offset().top+options.scroll_additional_top;switch(options.element_type){case"table":_source_next_tr=_this.next();var _clone=$("<tr>").css("width",_this.css("width")).css("height",_this.css("height")).css("position",_this.css("position"));_this.children().each(function(){var _th=$("<th>").css("width",$(this).width()+"px").css("height",$(this).height()+"px").css("line-height",$(this).css("line-height")).html($(this).html());_clone.append(_th)});break;case"div":break}var _isfly=false;$(window).bind("scroll",function(){var scrollTop=$.browser.scroll_top();if(scrollTop>_top_to_fly&&!_isfly){_isfly=true;_this.before(_clone);_this.css("position","fixed").css("top",0).css("width",_source_width+"px").css("height",_source_height+"px");if(options.element_type=="table"){$(_source_next_tr).children().each(function(i){_this.children().eq(i).css("width",$(this).width()+"px").css("height",$(this).height()+"px")})}}else{if(scrollTop<=_top_to_fly&&_isfly){_isfly=false;_this.css("position","static");if(options.element_type=="table"){_clone.remove()}}}})}});$.extend({browser:{screen_width:function(){return $(window).width()},screen_height:function(){return $(window).height()},page_width:function(){return $(document).width()},page_height:function(){return $(document).height()},scroll_top:function(){return $(document).scrollTop()},scroll_left:function(){return $(document).scrollLeft()}},toTopTip:function(opt){var default_options,options,_tip;if(opt==undefined||!opt.hasOwnProperty("point_name")||!opt.hasOwnProperty("scrollTop")){alert("请设置`point_name` , `scrollTop`属性 否则无法正常运行");return}default_options={top:$.browser.screen_height()-200,point_name:"",element:"回顶部",width:30,height:20,backgroundColor:"white",border:"1px solid gray"};if(opt.hasOwnProperty("top")){opt.top=$.browser.screen_height()-opt.top}options=$.extend({},default_options,opt);_tip=$("<div>").css("position","fixed").css("width",options.width+"px").css("height",options.height+"px").css("background-color",options.backgroundColor).css("border",options.border).css("text-align","center").css("verticle-align","middle").css("top",options.top+"px").css("left",($.browser.screen_width()-options.width-2)+"px").html('<a href="#'+options.point_name+'">'+options.element+"</a>");_tip.hide();$("body").append(_tip);var _display=false;$(window).bind("scroll",function(){var _scrollTop=$.browser.scroll_top();if(_scrollTop>options.scrollTop&&!_display){_display=true;_tip.fadeIn(100)}else{if(_scrollTop<=options.scrollTop&&_display){_display=false;_tip.hide()}}});return _tip},strToDom:function(str){var tempdiv=$("<div>");tempdiv.html(str);return tempdiv.children().eq(0)},in_array:function(val,array){var is_in_array=false;for(var i=0;i<array.length;i++){if(array[i]==val){is_in_array=true;break}}return is_in_array},array_unique:function(array){var single_array=[];var repeat_array=[];for(var i=0;i<array.length;i++){var count=0;for(var k=0;k<array.length;k++){if(array[i]==array[k]){count++}}if(count>1&&!$.in_array(array[i],repeat_array)){repeat_array.push(array[i])}else{if(count<=1){single_array.push(array[i])}}}for(var i in repeat_array){single_array.push(repeat_array[i])}return single_array},alert:function(message,width,height){if(width==undefined){width=200}if(height==undefined){height=100}var msg_div=$("#dialog_msg");if(msg_div[0]===undefined){var msg_str='<div id="dialog_msg"><center><p><b>xxxx</b></p></center></div>';msg_div=$.strToDom(msg_str);$("body").append(msg_div)}$("#dialog_msg").find("b").html(message);$("#dialog_msg").dialog({modal:true,width:width,height:height,title:"消息"});return this},delete_Json_Object_By_Key_Value:function(key,value,json){$(json).each(function(index){if(this[key]==value){json.splice(index,1);return false}});return json},fetch_Json_Object_By_Key_Value:function(key,value,jsonArray){var obj=null;$(jsonArray).each(function(index){if(this[key]==value){obj=this}});return obj},cloneJSON:function(para){var rePara=null;var type=Object.prototype.toString.call(para);if(type.indexOf("Object")>-1){rePara=jQuery.extend(true,{},para)}else{if(type.indexOf("Array")>0){rePara=[];jQuery.each(para,function(index,obj){rePara.push(jQuery.cloneJSON(obj))})}else{rePara=para}}return rePara},jsonDecode:function(data){var _data=eval("("+data+")");return _data},strcmp:function(str1,str2,trim){if(this.is_empty(trim)){trim=true}switch(trim){case true:return str1.replace(/\s+/g,"")==str2.replace(/\s+/g,"");case false:return str1==str2;default:}},isValidPassword:function(password){var parttern=/^\w+$/;if(parttern.test(password)){return true}return false},isValidAccountAllowZh:function(account){var parttern=/^[a-zA-Z_\u4e00-\u9fa5][a-zA-Z_0-9\u4e00-\u9fa5]*$/;if(parttern.test(account)){return true}return false},isValidAccount:function(account){var parttern=/^[a-zA-Z_][a-zA-Z_0-9]*$/;if(parttern.test(account)){return true}return false},is_numberic:function(param){if(/\d+/g.test(param)){return true}return false},max_length:function(param,length){if(param.length<=length){return true}return false},min_length:function(param,length){if(param.length>=length){return true}return false},mixed_length:function(param){return param.replace(/[^\x00-\xff]/gi,"--").length},max_value:function(param,maxvalue){if(parseInt(param)<=parseInt(maxvalue)){return true}return false},min_value:function(param,minvalue){if(parseInt(param)>=parseInt(minvalue)){return true}return false},is_email:function(param){var emailReg=/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;if(emailReg.test(param)){return true}return false},is_phone:function(param){var pattern=/(^[0-9]{3,4}\-[0-9]{3,8}$)|(^[0-9]{3,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}13[0-9]{9}$)/;if(pattern.test(param)){return true}return false},is_mobile:function(param){var pattern=/1[3-8]+\d{9}/;if(pattern.test(param)){return true}return false},entry_phone:function(param){return param.substring(0,3)+"*****"+param.substring(8,param.length)},is_idcard:function(param){if(!(/^\d{15}$/.test(param)||/^\d{18}$/.test(param)||/^\d{17}[xX]$/.test(param))){return false}return true},is_empty:function(param){if(param==null||param==""||param==undefined||param=="null"){return true}return false},IsURL:function(str_url){var strRegex="^((https|http|ftp|rtsp|mms)?://)?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?(([0-9]{1,3}.){3}[0-9]{1,3}|([0-9a-z_!~*'()-]+.)*([0-9a-z][0-9a-z-]{0,61})?[0-9a-z].[a-z]{2,6})(:[0-9]{1,4})?((/?)|(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";var re=new RegExp(strRegex);if(re.test(str_url)){return(true)}else{return(false)}},d_timeToDate:function(time,formatString){if(formatString==undefined){formatString="YYYY-MM-DD"}var dateString=null;time=new Date(time*1000);var year=time.getFullYear();var month=time.getMonth()+1;var day=time.getDate();var hour=time.getHours();var minute=time.getMinutes();var second=time.getSeconds();switch(formatString){case"YYYY-MM-DD":dateString=year+"-"+month+"-"+day;break;case"YYYY-MM-DD HH:NN:SS":dateString=year+"-"+month+"-"+day+" "+hour+":"+minute+":"+second;break;default:break}return dateString},d_dateToTime:function(date){var time_array=[],date_array=[];var _date=date.split(" ");var date_prefix=_date[0];if(_date.length>1){var date_ext=_date[1];date_array=date_prefix.split("-");time_array=date_ext.split(":");return new Date(date_array[0],date_array[1]-1,date_array[2],time_array[0],time_array[1],time_array[2]).getTime()}else{date_array=date_prefix.split("-");return new Date(date_array[0],date_array[1]-1,date_array[2]).getTime()}},d_timediff_year:function(time_small,time_big){var timediff=time_big-time_small;var yearTime=60*60*24*365*1000;return Math.floor(timediff/yearTime)},rand:function($max){return Math.floor(Math.random()*($max+1))}})})(jQuery);