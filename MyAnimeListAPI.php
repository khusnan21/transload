<?php
/**
 * Plugin Name:       MyAnimeList-API: Autofill
 * Plugin URI:        https://github.com/semicolonsmith/
 * Description:       MyAnimeList API auto Fill (Unofficial).
 * Version:           1.0.0
 * Author:            Semicolon;
 * Author URI:        https://github.com/semicolonsmith
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mal-autofill
 * Domain Path:       /languages
 **/
require_once("config.MyAnimeList.php");
add_action("add_meta_boxes", "MyAnimeList_Meta_Box");
function MyAnimeList_Meta_Box(){
	add_meta_box("MyAnimeList-API", "MyAnimeList API: Autofill", "MyAnimeList_Callback", $MALPost);
}
function MyAnimeList_Callback(){
?>
<div class="wrap">
	<input name="mal_input" type="text" id="mal_input" class="regular-text" placeholder="Input URL MyAnimeList"/>
	<input type="button" id="mal_submit" class="button button-primary" value="Generate"/>
</div>
<script type="text/javascript">
jQuery("#mal_submit").on("click", function(){

	jQuery.getJSON("<?php echo plugin_dir_url(__FILE__); ?>/api.MyAnimeListAPI.php?url=" + jQuery("#mal_input").val(), function(data){
			$.each(data, function(key, val) {
              $('input[name=' +key+ ']').val(val); 
              if(key == "title"){
                $('#title').val(val);
              }  
              if(key == "synopsisid"){
                $('#content').val(val);
              }
	      if(key == "genres"){
                $('#new-tag-genres').val(val);
              }   
		  if(key == "studios"){
                $('#new-tag-studio').val(val);
              }
		  if(key == "premiered"){
                $('#new-tag-season').val(val);
              }
	      if(key == "japanese"){
                $('#ero_japanese').val(val);
              } 
        if(key == "aired"){
                $('#ero_tayang').val(val);
              }
	      if(key == "duration"){
                $('#ero_durasi').val(val);
              } 
	      if(key == "episodes"){
                $('#ero_episode').val(val);
              }
	      if(key == "score"){
                $('#ero_skor').val(val);
              }
		});
		
	});
});
</script>
<?php
}
?>