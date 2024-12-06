$(document).ready(function(){
  $('.event-side-nav-item').click(function(){
    $('.event-side-nav-item').removeClass("day-active");
    $(this).addClass("day-active");
  });
});