/*
 * jianche51 js libaray.
 * version: 1.0
 */
/*host = "http://192.168.11.102/jianche51/";*/
host ="";
function jump(e,i){
	var o="",a=encodeURIComponent,s=screen,r=document,n=0,l=0,h=r.location;
	var p,u;
	if(window._videoInfo){
		p=_videoInfo.videoUrl;
		u=_videoInfo.title
	}else{
		p=h.href;
		u=r.title;
		window._videoInfo={
			cateId:cid,bCover:cover||"",
			videoUrl:p,
			title:u,
			videoSrc:window.shareUrl
		}
	}
	var c=sohuHD.passport.getUid()||"";
	function d(e){
		regexp=/[^\x00-\xff]/g;v=e;
		while(m=regexp.exec(e)){
			v=v.split(m[0]).join(escape(m[0]).split("%").join("\\"))
		}
		return v
	}
	var f=function(e,t,i){if(!i){return e}var o=t+"="+i,a=e.indexOf("?");o=a==-1?"?"+o:a==e.length-1?o:o+"&";a=a==-1?e.length:a+1;var s=e.slice(0,a),r=e.slice(a);return s+o+r};
	p=f(p,"xuid",c);
	if(e=="weibosohu"){
		if(_videoInfo&&_videoInfo.cateId=="26"){
			u=[" #HP\u5927\u9e4f\u561a\u5427\u561a\u7247\u5934\u5f81\u96c6\u6d3b\u52a8#",u].join("")
		}
		o=["http://t.sohu.com/third/post.jsp?url=",a(p),"&title=",escape(u),"&pic=",_videoInfo.bCover||""].join("");
		n=660;l=470
	}else if(e=="baishehui"){
		o="http://bai.sohu.com/share/blank/addbutton.do?link="+a(p)+"&title="+a(u);n=480;l=340
	}else if(e=="douban"){
		o="http://www.douban.com/recommend/?url="+a(p)+"&title="+a(u);n=460;l=340
	}else if(e=="renren"){
		o="http://widget.renren.com/dialog/share?resourceUrl="+a(p)+"&title="+a(u);n=700;l=650
	}else if(e=="kaixin001"){
		o="http://www.kaixin001.com/repaste/share.php?rurl="+a(p)+"&rtitle="+a(u);n=540;l=360
	}else if(e=="itb"){
		o="http://tieba.baidu.com/f/commit/share/openShareApi?url="+a(p);n=626;l=436
	}else if(e=="go139"){
		o="http://go.139.com/ishare.do?shareUrl="+a(p)+"&title="+a(u)+"&sid=20dd04a99380c2e8d56cf187f6658169";n=630;l=500
	}else if(e=="wblog"){
		o="http://t.sohu.com/third/post.jsp?url="+a(p)+"&pic="+(cover||_videoInfo.bCover)+"&title="+escape("#"+i+"#");n=660;l=470
    }else if(e=="qq"){
    	o="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+a(p)+"&title="+a(u);o="http://my.tv.sohu.com/user/onekey/addShare.do?sitename=qq&shareurl="+a(o);n=930;l=510
    }else if(e=="tqq"){u="#\u6211\u5728\u641c\u72d0\u89c6\u9891\u5206\u4eab#"+u;o="http://share.v.t.qq.com/index.php?c=share&a=index&url="+a(p)+"&appkey=801105960&pic="+a(cover||_videoInfo.bCover)+"&assname=tv-sohu&title="+a(u);n=700;l=680
    }else if(e=="weibosina"){
    	if(_videoInfo.cateId=="26"){u+=" #HP\u5927\u9e4f\u561a\u5427\u561a\u7247\u5934\u5f81\u96c6\u4ee4#"}o="http://service.t.sina.com.cn/share/share.php?url="+a(p)+"&appkey=1753462873&title="+a(u)+"&pic=&ralateUid=2230913455&searchPic=false";o="http://my.tv.sohu.com/user/onekey/addShare.do?sitename=sina&shareurl="+a(o);n=815;l=505
    }else if(e==="ty"){o="http://open.tianya.cn/widget/send_for.php?action=send-html&shareTo=1&title="+a(u)+"&flashVideoUrl="+a(_videoInfo.videoSrc)+"&url="+a(p);n=650;l=505
    }else if(e==="fx"){o="http://space.feixin.10086.cn/api/cshare?source="+a("tv.sohu.com")+"&title="+a(u)+"&url="+a(p);n=650;l=450
    }else if(e==="163"){o="http://t.163.com/article/user/checkLogin.do?link=http://tv.sohu.com/&source="+a("\u641c\u72d0\u89c6\u9891")+"&info="+a(u)+a(p);n=550;l=330
    }else if(e==="51"){o="http://share.51.com/share/out_share_video.php?from=\u641c\u72d0\u89c6\u9891"+"&title="+u+"&vaddr="+p;n=650;l=450
    }else if(e==="tianyi"){o="http://s.189share.com/interface.jsp?title="+a(d(u))+"&url="+a(p);if(vid){o=o+"&resid=my"+vid}document.getElementById("tianyi").href=o;return
    }else if(e==="txpengyou"){
    	o="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?site="+a("\u641c\u72d0\u64ad\u5ba2 my.tv.sohu.com")+"&url="+a(p)+"&title="+a(u);n=650;l=600
    }else if(e==="msn"){if(_videoInfo.videoSrc){o="http://profile.live.com/badge/?Title="+a(u)+"&swfurl="+a(_videoInfo.videoSrc)+"&url="+a(p)+"&screenshot="+a(_videoInfo.bCover)+"&ctype=flash";n=650;l=600
    }else{
    	$.getJSON("http://share.vrs.sohu.com/Video_Share.action?url="+h.href.split("#")[0]+"&jsonp=?",function(e){o="http://profile.live.com/badge/?Title="+a(t)+"&swfurl="+a(e.flash)+"&url="+a(h.href)+"&screenshot="+a(e.coverurl)+"&ctype=flash";n=650;l=600;if(/Firefox/.test(navigator.userAgent)){setTimeout(v,0)}else{v()}});return false
    }
    }
	function v(){
		if(!window.open(o,"sohushare",["toolbar=0,status=0,resizable=1,width="+n+",height="+l+",left="+(s.width-n)/2+",top="+(s.height-l)/2]))h.href=[o].join("")
	}
	if(/Firefox/.test(navigator.userAgent)){setTimeout(v,0)}else{v()}
	var g=["http://220.181.61.231/get.gif?type=forward&vid=",window.vid||"","&passport=",sohuHD.passport.getPassport(),"&suv=",sohuHD.cookie("SUV"),"&fuid=",sohuHD.cookie("fuid"),"&x=",e,"&url=",a(p),"&_=",sohuHD.now()].join("");
	sohuHD.pingback(g);sohuHD.pingback("http://store.tv.sohu.com/web/vipbdaward/gamble.do?bd_id=17")
}
/*
function InitAjax()
{
　var objajax=false; 
　try { 
　　objajax = new ActiveXObject("Msxml2.XMLHTTP"); 
　} catch (e) { 
　　try { 
　　　objajax = new ActiveXObject("Microsoft.XMLHTTP"); 
　　} catch (E) { 
　　　objajax = false; 
　　} 
　}
　if (!objajax && typeof XMLHttpRequest!='undefined') { 
　　objajax = new XMLHttpRequest(); 
　} 
　return objajax;
}

function AjaxGet(url, fn_suc, fn_fl) {
　  var objajax = InitAjax();
　  objajax.open("GET", url, true); 
　  objajax.onreadystatechange = function() { 
	　　if (objajax.readyState == 4 && objajax.status == 200) { 
	        if(fn_suc){
		    	fn_suc(objajax.responseText);
		    }
	　　}else {
		    if(fn_fl){
		        fn_fl(objajax.responseText);
		    }
	    }
　  }
　  objajax.send(null); 
}

function AjaxPost(url, obj, fn_suc, fn_fl) {
　  var objajax = InitAjax();
　  objajax.open("POST", url, true); 
　  objajax.onreadystatechange = function() { 
	　　if (objajax.readyState == 4 && objajax.status == 200) { 
	        if(fn_suc){
		    	fn_suc(objajax.responseText);
		    }
	　　}else {
		    if(fn_fl){
		        fn_fl(objajax.responseText);
		    }
	    }
　  }
    objajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
　  objajax.send(obj); 
}
*/
function onLogined(result) {
    //alert("登录结果" + result);
    var html = '<span>'+ result.yong_hu_id +'</span>'
    var html= '<a id="ucenter" href="usercenter.html" style="padding:0 15px;">个人中心</a>'
    html += '<a id="login_out" href="javascript:void(0);" style="padding:0 15px;">退出</a>';
    $("#accout_area").html(html);
    $("#login_out").bind("click",onLoginOut)
}
function onLoginOut(){
	var url = "jianche/jianche51.php?m=Home&c=Index&a=logout";
	$.ajax(url, function(result){
	    var html = '<a id="reg" href="javascript:void(0);" style="padding:0 15px;margin-left:30px;">注&nbsp;册</a><a id="login" href="javascript:void(0);" style="padding:0 15px;">登&nbsp;录</a>';
	    $("#accout_area").html(html);
	    $("#login").unbind("click");
	    $("#reg").unbind("click");
	    $("#login").bind("click",function(){
			$("#login_pop").show();
		});
		$("#reg").bind("click",function(){
			$("#reg_pop").show();
		});
	});
}

function onLogin(){
    $("#login").unbind("click");
	$("#reg").unbind("click");
    var html = '<span>'+ result.uname +'</span><a id="ucenter" href="usercenter.html" style="padding:0 15px;">个人中心</a>'
    html += '<a id="login_out" href="javascript:void(0);" style="padding:0 15px;">退出</a>';
    $("#accout_area").html(html);
    $("#login_out").bind("click", onLoginOut);
}
function submit_login_info(){
    var url = "jianche/jianche51.php?m=Home&c=Index&a=login";
    var submit = {};
    submit["yong_hu_id"] = $("#login_pop input:first").val();
    submit["yan_zheng_ma"] =  $("#login_pop input:last").val();
    $.ajax({
    	type:"POST",
    	url: url,
    	data:JSON.stringify(submit),
    	success: function(result){
    		if(result.return_code == "success"){
    			$("#login_pop").hide();
    			onLogined(result.data);
    			return ;
    		}else {
    			//alert("请检查用户是否存在");
    		}
    		
        },
        contentType: "application/json; charset=utf-8",
    });
}
function AjaxJSONPost(url, data, fn) {
	$.ajax({
    	type:"POST",
    	url: url,
    	data:JSON.stringify(data),
    	success: fn ? fn: null,
        contentType: "application/json; charset=utf-8",
    });
}
function submit_reg_info(){
    var url = "jianche/jianche51.php?m=Home&c=Index&a=add_item_post_method";
	/*var f = document.createElement("form");
	document.body.appendChild(f);
	 f.method = 'post';
	var i = document.createElement("input");
	i.type = "text";
	f.appendChild(i);
	i.value =  $("#reg_uname").val();
	i.name = "yong_hu_ming";

	var j = document.createElement("input");
	j.type = "text";
	f.appendChild(j);
	j.value =  $("#reg_uname").val();
	j.name = "yong_hu_ming";

	var k = document.createElement("input");
	k.type = "text";
	f.appendChild(k);
	k.value =  $("#reg_uname").val();
	k.name = "yong_hu_ming";

	var i = document.createElement("input");
	i.type = "text";
	f.appendChild(i);
	i.value =  $("#reg_uname").val();
	i.name = "yong_hu_ming";*/
    var submit = {};
    submit["yong_hu_ming"] = $("#reg_uname").val();
    submit["yong_hu_id"] =  $("#reg_upwd").val();
    submit["yan_zheng_ma"] =  $("#reg_ccode").val();
    submit["method_name"] = "yong_hu";
    // AjaxJSONPost(url, submit, function(result){
    // 	alert("注册结果：" + result);
    // });
    $.ajax({
    	type:"POST",
    	url: url,
    	data:JSON.stringify(submit),
    	success: function(result){
    		if(result.return_code == "success"){
    			$("#reg_pop").hide();
    			onLogined(result.data);
    		}
    	         
        },
        contentType: "application/json; charset=utf-8",
    });
}
function checkLogined() {
	if($.cookie("yong_hu_id") && $.cookie("yong_hu_id").length > 0)
		onLogined({"yong_hu_id":$.cookie("yong_hu_id")});
}
function isPhoneNum(tel){
	if(/^13d{9}$/g.test(tel)||(/^15[8,9]d{8}$/g.test(tel)))
		return true;
	return false;
}
function sendCCode(e){
	var phone = $("input", $(e.target).parent()).val();
	// if(!isPhoneNum(phone)){
	// 	return ;
	// }
	var url = host + "jianche/jianche51.php?m=Home&c=Index&a=get_yan_zheng_ma&num="+phone;

    $.ajax({
    	url: url,
    	success: function(json){
            resetCCode();
    	},
    	error: function(json){
            //alert("已经发送");
    	}
    });
}

function resetCCode() {
	$(".btn_get_ccode").unbind("click");
	$(".btn_get_ccode").addClass("off");
	setTimeout(function(e){
        $(".btn_get_ccode").removeClass("off");
        $(".btn_get_ccode").bind("click", sendCCode);
	},60000);
}
/*获取验证码*/
$(".btn_get_ccode").bind("click", sendCCode);

$("#login_submit").bind("click",submit_login_info);
$("#reg_submit").bind("click", submit_reg_info);
$("#login").bind("click",function(){
	$("#login_pop").show();
});
$("#reg").bind("click",function(){
	$("#reg_pop").show();
});
$("#login_out").bind("click",onLoginOut);
$("#login_close").bind("click", function(e){
	$("#login_pop").hide();
});
$("#reg_close").bind("click", function(e){
	$("#reg_pop").hide();
});
$("#service_downlist").hover(function(){
    $(".sub_nav").show();
}, function(){
    $(".sub_nav").hide();
});
$(".sub_nav").hover(function(){
    $(".sub_nav").show();
}, function(){
    $(".sub_nav").hide();
});
(function ($) {
	$.getUrlParam = function (name) {
	    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	    var r = window.location.search.substr(1).match(reg);
	    if (r != null) return unescape(r[2]); return null;
	}
})(jQuery);