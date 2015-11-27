$(function(){
	$("#collapsible").height($("#nav").height()).toggle(function() {
		$("#nav").css('width','10px');
		$("#nav .dashboard").css('width','0px');
		
		return false;
	}, function() {
		$("#nav").css('width','140px');
		$("#nav .dashboard").css('width','133px');
		return false;
	});
	
	$('.actions span').css('display','none');
	$('.actions').parent().mouseenter(function(){
		$(this).find('.actions span').css('display','inline');
	}).mouseleave(function() {
		$(this).find('.actions span').css('display','none');
	});
});