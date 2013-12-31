$(function() {
	$('footer').hide();
	$('footer').delay(800).fadeIn(650);
	$('.notification').slideDown("slow");
	$('.notification').click(function() {
		
		$(this).slideUp('slow');
	});
});
