
$(function() {

$(".follow").click(function()
{
var user_id = $(this).attr("id");
var datastring = 'user_id='+ user_id ;
 $.ajax({
   type: "POST",
   url: "add_follow_user.php",
   data: datastring,
   success: function(html){}
 });

    $("#follow"+user_id).hide();
    $("#remove"+user_id).show();
    return false;

});

});


$(function() 
{

$(".remove").click(function()
{

var user_id = $(this).attr("id");
var datastring = 'user_id='+ user_id ;

 $.ajax({
   type: "POST",
   url: "remove_follow_user.php",
   data: datastring,
   success: function(html){}
 });
   $("#remove"+user_id).hide();
   $("#follow"+user_id).show();
    return false;

});

});

