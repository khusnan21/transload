<?php
if (!defined('RAPIDLEECH')) {
	require_once("index.html");
	exit;
}
?>
<aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
				<span>Downloadmanager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-share"></i> Download</a></li>
				<?php
				if (!$options['auto_download_disable']) {
				?>
                <li><a href="audl.php"><i class="fa fa-share"></i> Multidownload</a></li>
				<?php
				}
				if (!$options['auto_upload_disable']) {
				?>
				<li><a href="auul.php"><i class="fa fa-upload"></i> <?php echo lang(335); ?></a></li>
				<?php
				}
				if (!$options['notes_disable']) {
				?>
				<li><a href="javascript:openNotes();"><i class="fa fa-edit"></i> <?php echo lang(327); ?></a></li>
				<?php
				}
				?>				
              </ul>
            </li>
            <li><a id="navcell3" class="cell-nav" onclick="javascript:switchCell(3);" style="cursor:pointer;"><i class="fa fa-files-o"></i> <span>Filemanager</span></a></li>
			<li><a id="navcell4" class="cell-nav" onclick="javascript:switchCell(4);" style="cursor:pointer;"><i class="fa fa-link"></i> <span><?php echo lang(332); ?></span></a></li>
			<li><a href="dlc.php"><i class="fa fa-archive"></i> DLC entschlüssen</a></li>
			<li class="header">HOSTER</li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Youtube</a></li>
			<?php
			global $premium_acc;
			if ( !empty ( $premium_acc ) )
			{
			?>
			<?php
			if ( !empty ( $premium_acc ) )
			{
				foreach ( $premium_acc as $serverName => $value )
				{
					echo '<li><a href="#"><i class="fa fa-circle-o text-info"></i> '. str_replace( '_', '.', $serverName ) .'</a></li>';
				}
			}
			?>
			<?php
			}
			?>
          </ul>
        </section>
      </aside>

<div class="content-wrapper">

		<section class="content-header">
          <ol class="breadcrumb" style="cursor:pointer;">
            <li><a id="navcell1" class="cell-nav" onclick="javascript:switchCell(1);"><i class="fa fa-dashboard"></i> <?php echo lang(329); ?></a></li>
			<li><a id="navcell3" class="cell-nav" onclick="javascript:switchCell(3);"><i class="fa fa-files-o"></i> <?php echo lang(331); ?></a></li>
			<li><a id="navcell4" class="cell-nav" onclick="javascript:switchCell(4);"><i class="fa fa-link"></i> <?php echo lang(332); ?></a></li>
			<li><a id="navcell2" class="cell-nav" onclick="javascript:switchCell(2);"><i class="fa fa-cogs"></i> <?php echo lang(330); ?></a></li>
          </ol>
        </section>
		
        <section class="content" style="padding-top:50px;">

<div id="tb_content">
<form role="form" action="<?php echo $PHP_SELF; ?>" name="transload" method="post"<?php if ($options['new_window']) { echo ' target="_blank"'; } ?>>

<div class="box tab-content" id="tb1">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-download"></i> Download Link</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
    <div class="box-body">
<div class="form-group">
    <label for="link"><?php echo lang(207); ?></label>
         <input type="text" class="form-control" name="link" id="link" placeholder="Enter Link">
</div>
<div class="form-group">
    <label for="link"><?php echo lang(208); ?></label>
         <input type="text" class="form-control" name="referer" id="referer" placeholder="Enter Referrer">
</div>

<div class="checkbox">
<label>
<input type="checkbox" name="user_pass" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('usernpass').style.display=displ;" value="on" />&nbsp;<?php echo lang(210); ?></td>
</label>
</div>
<div id="usernpass" style="display: none;">
<?php echo lang(211); ?>: <input type="text" name="iuser" value="" /> 
<?php echo lang(212); ?>: <input type="text" name="ipass" value="" />
</div>

<div class="checkbox">
<label>
<input type="checkbox" name="add_comment" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('comment').style.display=displ;" />&nbsp;<?php echo lang(213); ?></td>
</label>
</div>
<div id="comment" style="display: none;">
<textarea class="form-control" name="comment" rows="4" cols="50"></textarea>
</div>

<div class="box-footer">
<input class="btn btn-block btn-primary" value="<?php echo lang(209); ?>" type="<?php echo ($options['new_window'] && $options['new_window_js']) ? 'button" onclick="new_transload_window();' : 'submit'; ?>" />
</div>

</div></div>

<div class="box" id="tb2" style="display:none;">
<div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-cogs"></i> Einstellungen</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
    <div class="box-body">
<?php if (!$options['disable_email']) { ?>
<input type="checkbox" name="domail" id="domail" onclick="document.getElementById('emailtd').style.display=document.getElementById('splittd').style.display=this.checked?'':'none';document.getElementById('methodtd').style.display=(document.getElementById('splitchkbox').checked ? (this.checked ? '' : 'none') : 'none');"<?php echo isset($_COOKIE['domail']) ? ' checked="checked"' : ''; ?> />&nbsp;<?php echo lang(237); ?>
<div id="emailtd"<?php echo isset($_COOKIE['domail']) ? '' : ' style="display: none;"'; ?>><?php echo lang(238); ?>:&nbsp;<input type="text" name="email" id="email"<?php echo !empty($_COOKIE['email']) ? ' value="'.$_COOKIE['email'].'"' : ''; ?> /></div>
<?php } ?>
<div id="splittd"<?php echo isset($_COOKIE["split"]) ? '' : ' style="display: none;"'; ?>>
<input id="splitchkbox" type="checkbox" name="split" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('methodtd').style.display=displ;"<?php echo isset($_COOKIE["split"]) ? ' checked="checked"' : ''; ?> />&nbsp;<?php echo lang(239); ?>
<div id="methodtd"<?php echo isset($_COOKIE["split"]) ? '' : ' style="display: none;"'; ?>>
<table>
<tr>
<td><?php echo lang(240); ?>:&nbsp;<select name="method"><option value="tc"<?php echo isset($_COOKIE["method"]) && $_COOKIE["method"] == "tc" ? " selected" : ""; ?>><?php echo lang(241); ?></option><option value="rfc"<?php echo isset($_COOKIE["method"]) && $_COOKIE["method"] == "rfc" ? ' selected="selected"' : ''; ?>><?php echo lang(242); ?></option></select></td>
</tr>
<tr>
<td><?php echo lang(243); ?>:&nbsp;<input type="text" name="partSize" size="2" value="<?php echo isset($_COOKIE["partSize"]) && is_numeric($_COOKIE["partSize"]) ? $_COOKIE["partSize"] : 10; ?>" />&nbsp;<?php echo lang(244); ?></td>
</tr>
</table>
</div>
</div>
<div>
<input type="checkbox" id="useproxy" name="useproxy" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('proxy').style.display=displ;"<?php echo isset($_COOKIE["useproxy"]) ? ' checked="checked"' : ''; ?> />&nbsp;<?php echo lang(245); ?>
<div id="proxy"<?php echo isset($_COOKIE["useproxy"]) ? '' : ' style="display: none;"'; ?>>
<table width="150" border="0">
<tr><td><?php echo lang(246); ?>:&nbsp;</td><td><input type="text" name="proxy" id="proxyproxy" size="20"<?php echo !empty($_COOKIE["proxy"]) ? ' value="'.$_COOKIE["proxy"].'"' : ''; ?> /></td></tr>
<tr><td><?php echo lang(247); ?>:&nbsp;</td><td><input type="text" name="proxyuser" id="proxyuser" size="20"<?php echo !empty($_COOKIE["proxyuser"]) ? ' value="'.$_COOKIE["proxyuser"].'"' : ''; ?> /></td></tr>
<tr><td><?php echo lang(248); ?>:&nbsp;</td><td><input type="text" name="proxypass" id="proxypass" size="20"<?php echo !empty($_COOKIE["proxypass"]) ? ' value="'.$_COOKIE["proxypass"].'"' : ''; ?> /></td></tr>
</table>
</div>
</div>
<div>
<input type="checkbox" name="premium_acc" id="premium_acc" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('premiumblock').style.display=displ;"<?php if (count($premium_acc) > 0) print ' checked="checked"'; ?> />&nbsp;<?php echo lang(249); ?>
<div id="premiumblock" style="display: none;">
<table width="150" border="0">
<tr><td><?php echo lang(250); ?>:&nbsp;</td><td><input type="text" name="premium_user" id="premium_user" size="15" value="" /></td></tr>
<tr><td><?php echo lang(251); ?>:&nbsp;</td><td><input type="password" name="premium_pass" id="premium_pass" size="15" value="" /></td></tr>
</table>
</div>
</div>
<div <?php echo (!$options['download_dir_is_changeable'] ? ' style="display:none;"' : '');?>>
<input type="checkbox" name="saveto" id="saveto" onclick="javascript:var displ=this.checked?'':'none';document.getElementById('path').style.display=displ;"<?php echo isset($_COOKIE["saveto"]) ? ' checked="checked"' : ''; ?> />&nbsp;<?php echo lang(252); ?>
<div id="path"<?php echo isset($_COOKIE["saveto"]) ? '' : ' style="display: none;"'; ?>><?php echo lang(253); ?>:&nbsp;<input type="text" name="path" size="40" value="<?php echo (!empty($_COOKIE["path"]) ? $_COOKIE["path"] : (substr($options['download_dir'], 0, 6) != "ftp://" ? realpath(DOWNLOAD_DIR) : $options['download_dir'])); ?>" /></div>
</div>
<div>
<input type="checkbox" name="savesettings" id="savesettings"<?php echo isset($_COOKIE["savesettings"]) ? ' checked="checked"' : ''; ?> onclick="javascript:var displ=this.checked?'':'none';document.getElementById('clearsettings').style.display=displ;" />&nbsp;<?php echo lang(254); ?>

<div id="clearsettings"<?php echo isset($_COOKIE["savesettings"]) ? '' : ' style="display: none;"'; ?>><a href="javascript:clearSettings();"><?php echo lang(255); ?></a></div>
</div>

</div>
</div> <!-- tb2 -->
</form>

<div class="box" id="tb3" style="display:none;">
<div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-files-o"></i> Filemanager</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
<?php
_create_list();
require_once(CLASS_DIR."options.php");
if($list)
  {
  if ($options['show_all'] === true)
    {
    unset($Path);
    }
  ?>
<a class="btn btn-primary" href="javascript:setCheckboxes(1);" class="chkmenu"><?php echo lang(256); ?></a> 
<a class="btn btn-primary" href="javascript:setCheckboxes(0);" class="chkmenu"><?php echo lang(257); ?></a> 
<a class="btn btn-primary" href="javascript:setCheckboxes(2);" class="chkmenu"><?php echo lang(258); ?></a> 
<a class="btn btn-primary" href="#" onclick="$('#flist_match_hitems').toggle();$('#flist_match_search').focus();return false;" class="chkmenu"><?php echo lang(384); ?></a>
<?php
  if ($options['show_all'] === true) {
?>
| <a href="javascript:showAll();"><?php echo lang(259); ?>&#173;
<script type="text/javascript">
if(getCookie("showAll") == 1)
  {
  document.write("<?php echo lang(260); ?>");
  }
else
  {
  document.write("<?php echo lang(261); ?>");
  }
</script></a>
<?php
  }
?>
<span id="flist_match_hitems" style="display:none;padding-top: 20px;"><br /><br />
<div class="input-group">
<input type="text"   size="20" id="flist_match_search" onkeypress="javascript:if(event.keyCode==13){flist_match();}" />
<a style="pointer:cursor" class="btn btn-primary" onclick="flist_match();"><i class="fa fa-search"></i> </a> 
</div>
<div class="checkbox" style="padding-left:20px;">
<input type="checkbox" id="flist_match_ins" checked="checked" /><?php echo lang(386); ?>
</div>
</span>
<br /><br />
<form action="<?php echo $PHP_SELF; ?>" name="flist" method="post">
<?php echo renderActions(); ?>
<div class="box-body table-responsive no-padding">
<?php if ($options['flist_h_fixed']) { ?>
<table id="table_filelist_h" class="table table-hover">
<tbody>
<tr class="flisttblhdr" valign="bottom">
<th id="file_list_checkbox_title_h">&nbsp;</th>
<th><b><?php echo lang(262); ?></b></th>
<th><b><?php echo lang(263); ?></b></th>
<th><b><?php echo lang(264); ?></b></th>
<th><b><?php echo lang(265); ?></b></th>
</tr>
</tbody>
</table>
<?php } ?>
<table id="table_filelist" class="table table-hover">
<thead>
<tr class="flisttblhdr" valign="bottom">
<th id="file_list_checkbox_title" class="sorttable_checkbox">&nbsp;</th>
<th class="sorttable_alpha"><b><?php echo lang(262); ?></b></th>
<th><b><?php echo lang(263); ?></b></th>
<th><b><?php echo lang(264); ?></b></th>
<th><b><?php echo lang(265); ?></b></th>
</tr>
</thead>
<tbody>
<?php
  }
else
  {
  echo "<center>".lang(266)."</center>";
  if ($options['show_all'] === true)
    {
    unset($Path);
    ?>
<a href="javascript:showAll();"><?php echo lang(259); ?>&#173;
<script type="text/javascript">
if(getCookie("showAll") == 1)
  {
  document.write("<?php echo lang(260); ?>");
  }
else
  {
  document.write("<?php echo lang(261); ?>");
  }
</script></a><br /><br />
<?php
    }
  }
if($list)
  {
  $total_files = $filecount = $total_size = 0;
  foreach($list as $key => $file)
    {
    if (($size_time = file_data_size_time($file["name"])) === false) { continue; }
    $total_files++;
    $total_size+=$size_time[0];
?>
<tr class="flistmouseoff" onmouseover="this.className='flistmouseon'" onmouseout="this.className='flistmouseoff'" align="center" title="<?php echo htmlentities(basename($file["name"])); ?>" onmousedown="checkFile(<?php echo $filecount; ?>); return false;">
<td><input onmousedown="checkFile(<?php echo $filecount;?>); return false;" id="files<?php echo $filecount; ?>" type="checkbox" name="files[]" value="<?php echo $file["date"]; ?>" /></td>
<td><?php echo link_for_file($file["name"], FALSE, 'style="font-weight: bold; color: #000;"'); ?></td>
<td><?php echo $file["size"]; ?></td>
<td><?php echo isset($file["comment"]) ? str_replace("\\r\\n", "<br />", $file["comment"]) : ""; ?></td>
<td><?php echo date("d.m.Y H:i:s", $file["date"]) ?></td>
</tr>
<?php
    $filecount ++;
    }
?>
</tbody>
<?php
  if (($total_files > 1) && ($total_size > 0)) {
    $tmp = '<tbody><tr class="flisttblftr">'.$nn.'<td>&nbsp;</td>'.$nn.'<td>Total:</td>'.$nn.'<td>'.bytesToKbOrMbOrGb($total_size).'</td>'.$nn.'<td>&nbsp;</td>'.$nn.'<td>&nbsp;</td>'.$nn.'</tr></tbody>';
    echo $tmp;
    if ($options['flist_h_fixed']) {
      echo '</table><table id="table_filelist_f" cellpadding="3" cellspacing="1" class="filelist" align="left" style="position:absolute;left:0px;bottom:0px;">'.$tmp;
    }
  }
  unset($total_files,$total_size);
  ?>
</table>
</div>
</form>
<?php
  }
?>
</div>
</div> <!-- tb3 -->
<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function() {
<?php if ($options['flist_sort']) { ?>
  sorttable.makeSortable(document.getElementById('table_filelist'));
<?php } if ($options['flist_h_fixed']) { ?>
  $('#table_filelist_h tr.flisttblhdr td').each(function(id) {
    $(this).click((function (x) { return function() { $('#table_filelist tr.flisttblhdr td:eq('+x+')').click(); table_filelist_refresh_headers(); }; })(id));
  });
<?php } ?>
});
/* ]]> */
</script>

<!--Start Lix Checker-->
<div class="box" id="tb4" style="display:none;">
<div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-link"></i> <?php echo lang(267); ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
<?php
// Print out workable sites for link checker
$name = array_keys($sites);
sort($name);
$workswith = implode(' | ', $name);
?>
<div class="alert alert-info">
<?php echo $workswith; ?>
<br /><b><?php echo lang(268); ?></b><br />
Anonym.to | Linkbucks.com | Lix.in | Usercash.com
</div>
<br />
<div align="center">
<form role="form" action="ajax.php?ajax=linkcheck" method="post" id="linkchecker" onsubmit="return startLinkCheck();">
<textarea class="form-control" rows="10" cols="87" name="links" id="links"></textarea><br /><br />
<div style="text-align:center; margin:0 auto; width:450px;"><a href="<?php echo $PHP_SELF.'?debug=1' ?>" style="color:#3B5A6F"><b><?php echo lang(269); ?></b></a></div><br />
<?php echo lang(270); ?>: <input type="checkbox" value="1" name="d" id="chk_d" />
<?php echo lang(271); ?>: <input type="checkbox" value="1" name="k" id="chk_k" /><br /><br />
<input class="btn btn-primary" type="submit" id="submit" value="<?php echo lang(272); ?>" name="submit" />
</form>
</div>
<br />
<p style="text-align:center; font-size:10px">
	<small>Lix Checker v3.0.0 | Copyright Dman - MaxW.org | Optimized by zpikdum and sarkar<br /><b>Mod by eqbal | Ajax'd by TheOnly92 | Updated by Th3-822</b></small></p><br />

<span id="loading" style="display: none;">
      &nbsp;&nbsp;
      <?php echo lang(273); ?>
      <img alt="<?php echo lang(274); ?>" src="templates/plugmod/images/ajax-loading.gif" name="pic1" />    </span>
<div align="center">
<div id="linkchecker-results" style="text-align: left;">
</div>
</div>
</div>
</div>
<!--End lix checker-->
<?php
if(isset($_GET["act"]))
  {
	echo '<script type="text/javascript">switchCell(3);</script>';
  }
elseif(isset($_GET["debug"]) || isset($_POST["links"]))
  {
	echo '<script type="text/javascript">switchCell(4);</script>';
  }
else
  {
	echo '<script type="text/javascript">'."$('#navcell1').addClass('selected');</script>";
  }

?>
</div> <!-- Content END -->
<br />
<div>
<script type="text/javascript">
var show = 0;
var show2 = 0;
</script>
<div align="center">
<?php
if ($options['file_size_limit'] > 0) {
	echo '<span style="color:#FFCC00">'.lang(337).' <b>' . bytesToKbOrMbOrGb ( $options['file_size_limit']*1024*1024 ) . '</b><br /></span>';
}
?>

<?php
$delete_delay = $options['delete_delay'];
if (is_numeric($delete_delay) && $delete_delay > 0){
	if($delete_delay > 3600){
		$ddelay = round($delete_delay/3600, 1);
		print '<div class="alert alert-success alert-dismissable">
                    <i class="icon fa fa-info"></i> <span class="autodel">'.lang(282).': <b>'.$ddelay.'</b>&nbsp;'.lang(283).'</span>
                </div>';
	}else{
		$ddelay = round($delete_delay/60);
		print '<div class="alert alert-success alert-dismissable">
                    <i class="icon fa fa-info"></i> <span class="autodel">'.lang(282).': <b>'.$ddelay.'</b>&nbsp;'.lang(284).'</span>
                </div>';
	}
}
?>
</div>
<div align="center" style="color:#ccc">
<?php if($options['server_info']) {
	ob_start();
?>
<div id="server_stats">
<?php	require_once(CLASS_DIR."sinfo.php"); ?>
</div>
<?php
  if ($options['ajax_refresh']) {
?>
<script type="text/javascript">var stats_timer = setTimeout("refreshStats()",10 * 1000);</script>
<?php
  }
	ob_end_flush();
}
?>
<hr />
<?php
print CREDITS;
?><br />
</div>
</div>
<?php
if (isset($_GET["act"]) && ($_GET["act"] == 'unrar_go') && !$options['disable_unrar']) {
  require_once(CLASS_DIR."options/unrar.php");
  unrar_go_go();
}
elseif (isset($_GET["act"]) && ($_GET["act"] == 'rar_go') && !$options['disable_rar']) {
  require_once(CLASS_DIR."options/rar.php");
  rar_go_go();
}
?>

	
        </section><!-- /.content -->
      
</div>