$('[swipe-helper]').on('mousedown touchstart', function(){
	$(this).remove();
})

$('[swipe-helper-area]').on('scroll', function(){
	$(this).find('[swipe-helper]').remove();
})