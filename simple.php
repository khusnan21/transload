<?php
include "curl_gd.php";
if (isset($_POST['url'])) {
$var= $_POST['url'];
$pieces = explode(PHP_EOL, $var);
?><textarea style="height: 155px; width: 100%;"><?php
foreach($pieces as $element)
{
	$gid = get_drive_id($element);
	$iframeid = my_simple_crypt($gid);
	$iframeid1 = my_simple_crypt($iframeid, 'd');
	$element = base64_encode($element);
	$element1 = base64_decode($element);
echo new_title('https://drive.google.com/file/d/' . $gid . '/view');
echo 'http://anidrive.icu?id='.$iframeid.'&#13;&#10;';

}
}


?>
</textarea
<?php echo $iframeid1.'<br/>'?>
<form action="" method="POST">
<textarea style="height: 155px; width: 100%;" name="url" ></textarea>
			<button class="btn btn-default" input type="submit" name="submit" >Submit </button>
		</form>