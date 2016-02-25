//专管特效，至于其他的留在原来页面，便于万一要定制直接改代码。。。
function rmvblk(prmts){//remove blank 去空格
	var prmtsnw='';//parameters new
	prmtsun=prmts.split('&');//parameters union
	for(var i=0;i<prmtsun.length;i++){
		if(i!=prmtsun.length-1){
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+')+'&';
		}else{
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+');
		}
	}
	return prmtsnw;
}

function  superTrim(str,ch) {  
	if(str.length>0 && str.indexOf(ch)!=-1){ //it is a string and have ch
	while(str.substring(0,1)==ch)  
			  str  =  str.substring(1,str.length);  
	while(str.substring(str.length-1,str.length)==ch)  
		str   =   str.substring(0,str.length-1);  
	}
	return   str;  
}

function isempty(str){
	var str=$.trim(str.val());
	if(str==''){return true;}else{return false;}
}

$(function(){
	$('#showhideleft').click(function(){
		var left=$('#left');var right=$('#right');var showhideright=$('#showhideright');
		left.hide();right.attr('class','col-md-12 nopadding right');showhideright.show();
		if($('#NBtb').length>0){docyg();}
	})
	$('#showhideright').click(function(){
		var left=$('#left');var right=$('#right');var showhideright=$('#showhideright');
		left.show();right.attr('class','col-md-10 nopadding right');showhideright.hide();
		if($('#NBtb').length>0){docyg();}
	})
})

window.onload=function(){
	//如果没有NBtb的话就不用加载下面这些了
	if($('#NBtb').length>0){
		//创建
		var cyg=$($('#NBtb').find('thead')[0]).html();//撑衣杆
		cyg = cyg.replace(/<tr/gm,"<tr id='cyg' style='background-color:#ccc'");
		cyg = cyg.replace(/<th/gm,'<td');
		cyg = cyg.replace(/th>/gm,'td>');
		$($('#NBtb').find('tbody')[0]).prepend(cyg);
		//$('#cyg').show();
		docyg();
		
	}
}

function docyg(){
	//先 show 然后 可以计算长度 完了后 hide ，然后再 下拉的时候自然就能show出来了
	$('#cyg').show();
	var tdu=$($('#NBtb tbody').find('tr')[0]).find('td:visible');
	var thu=$('#NBtb thead').find('th:visible');
	var arr={};
	for(var i=0;i<thu.size();i++){
		arr[i]=$(tdu[i]).width();
	}
	for(var i=0;i<thu.size();i++){
		$(thu[i]).width(arr[i]);
	}
	$('#cyg').hide();
}

//tb专用//第一步最重要就是定位
$.fn.smartFloatTB = function() {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		$(window).scroll(function(){
			var scrolls = $(this).scrollTop()+$('#divhd').height();//定位在divhd下头
			if($(window).width()>600&&scrolls > $('#NBtb').offset().top&&scrolls<$('#NBtb').offset().top+$('#NBtb').height()){
				if (window.XMLHttpRequest) {
					$('#cyg').show();
					
					
					element.css({
						position: "fixed",
						top: $('#divhd').height()
					});	
				} else {
					
					element.css({
						position: pos,
						top: scrolls
					});	
				}
			}else{
				$('#cyg').hide();
				element.css({
					position: pos,
					top: top
				});	
			}
		});
	};
	return $(this).each(function() {
		position($(this));						 
	});
};