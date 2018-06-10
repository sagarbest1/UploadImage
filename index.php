<?php 
	extract($_POST);
	if(isset($_FILES['file']['name']))
	{
	if($_FILES['file']['name']!='')
	{
		
	@$ext = end(explode(".", strtolower($_FILES['file']['name'])));
	$target_file = "images/" . $_FILES["file"]["name"];
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
	{
		if($ext == 'mp4' || $ext == 'webm' || $ext == 'ogg')
		{
        $img = '<video width="50%" height="50%" controls>
		<source src="'.$target_file.'" type="video/mp4">
		<source src="'.$target_file.'" type="video/ogg">
		<source src="'.$target_file.'" type="video/webm">
		</video>';
		}
		else
		{
        $img = "<img src='$target_file' height='500' width='500'>";	
		}
	 } 
	}
	$rezultat = urlencode($img);
	echo '<body onload="parent.doneloading(\''.$rezultat.'\')"></body>';

}


?>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>
<script>
function doneloading(rezultat) 
{
  rezultat = decodeURIComponent(rezultat.replace(/\+/g,  " "));
  document.getElementById('showimg').innerHTML = rezultat;
  document.getElementById('showimg').style.transform=50+deg;

}

</script>
<script type="text/javascript">  
$(function()
{
    $("#file").change(function()
	{
        $("#form1").submit();
		setStatus("showimg");
        return false;

    });
	function setStatus(theloc) 
	{
    var tag = document.getElementById(theloc);
    if (tag) 
    {
    tag.innerHTML = '<img src="images/icons/loading.gif" width="36" height="31" style="margin-top:45px; margin-left:45px;" />';
    }
  }
});
</script>

<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" id="form1" target="uploadframe">
<input type="file" name="file" id="file">
<div id="showimg"></div>
<iframe id="uploadframe" name="uploadframe" src="#" width="8" height="8" scrolling="no" frameborder="0" ></iframe>
</form>
