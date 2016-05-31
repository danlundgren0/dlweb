$( ".dropdown" ).hover(
  function() {
    $(this).addClass( "open" );
  }, function() {
    $(this).removeClass( "open" );
  }
);
$('.navbar-main a').removeAttr('data-toggle');
