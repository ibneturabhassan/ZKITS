<script src="jquery-1.6.1.min.js" type="text/javascript"></script>
 
    
     <script type="text/javascript">
 $(document).ready(function()
{
$("#contentbox").keyup(function()
{
var box=$(this).val();
var main = box.length *100;
var value= (main / 400);
var count= 400 - box.length;

if(box.length <= 400)
{
$('#count').html(count);
$('#bar').animate(
{
"width": value+'%',


}, 1);
}
else
{
alert('Full');
}
return false;
});

});
</script>


<style>

#bar
{
background-color:#5fbbde;
width:0px;
height:16px;
}
#barbox
{
float:left; 
height:16px; 
background-color:#FFFFFF; 
width:100px; 
border:solid 2px #000; 
margin-right:3px;
-webkit-border-radius:5px;-moz-border-radius:5px;
}
#count
{
float:left; margin-right:8px; 
font-family:'Georgia', Times New Roman, Times, serif; 
font-size:16px; 
font-weight:bold; 
color:#666666
}

</style>