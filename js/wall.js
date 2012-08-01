// Srinivas Tamada http://9lessons.info
// wall.js

$(document).ready(function() 
{
// Update Status
$(".update_button ,.update_private_button").click(function() 
{
    
    var updateval = $(this).parent().find("textarea").val();
   
    var dataString =  updateval;
    var $groupId = ($(this).prev().val());
    if($groupId){
        
    }
    
    if(updateval=='')
    {
        if($(".private").find('textarea').val() == ''){

            alert("Please Enter Some Text");
        }
    }

    else
    {
      
        $update = ($(this).closest("#wall_container").find("#content"));
        
        $("#flash").show();
        $("#flash").fadeIn(400).html('Loading Update...');
        $.ajax({
                type: "POST",
                url: "message_ajax.php",
                data:{
                        update:dataString,
                        group_id : $groupId
                } ,
                
                cache: false,
                success: function(html)
                {
                    $("#flash").fadeOut('slow');
                    $update.prepend(html);
                    $update.val('');	
                    $update.focus();



                    $("#stexpand").oembed(updateval);
          }
         });
        }
        return false;
});
	
//commment Submint

$('.comment_button').live("click",function() 
{

    var ID = $(this).attr("id");

    var comment= $("#ctextarea"+ID).val();
    var dataString = 'comment='+ comment + '&msg_id=' + ID;

    if(comment=='')
    {
    alert("Please Enter Comment Text");
    }
    else
    {
    $.ajax({
    type: "POST",
    url: "comment_ajax.php",
    data: dataString,
    cache: false,
    success: function(html){
    $("#commentload"+ID).append(html);
    $("#ctextarea"+ID).val('');
    $("#ctextarea"+ID).focus();
     }
     });
    }
    return false;
});

// commentopen 
$('.commentopen').live("click",function() 
{
var ID = $(this).attr("id");
$("#commentbox"+ID).slideToggle('slow');
return false;
});	
//$('.commentopen').trigger("click");
// delete comment
$('.stcommentdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'com_id='+ ID;

if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "delete_comment_ajax.php",
data: dataString,
cache: false,
success: function(html){
 $("#stcommentbody"+ID).slideUp();
 }
 });

}
return false;
});
	// delete update
$('.stdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'msg_id='+ ID;

if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "delete_message_ajax.php",
data: dataString,
cache: false,
success: function(html){
    
    $("#stbody"+ID).slideUp();
 }
 });
}
return false;
});
});
