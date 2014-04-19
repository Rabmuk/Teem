$(document).ready(function() {

  var i = 4;

  $("#add").on("click", function() {
    $( ".groupForm:first" ).clone().appendTo( ".groupForm:last" );
    $(".groupForm:last p").replaceWith("<p>"+i+") </p>");
    $(".groupForm:last input[name='topic']").val("Enter topic...");
    $(".groupForm:last input[name='people']").val("Enter team members...");
    $(".groupForm:last input[name='duration']").val("#");
    i++;
     if(i <= 4){
      $("#delete").hide();
    } else {
      $("#delete").show();
    }
  });


  $("#delete").on("click", function() {
    $(".groupForm:last").remove();
    i--;
    if(i <= 4){
      $("#delete").hide();
    } else {
      $("#delete").show();
    }
  });

});