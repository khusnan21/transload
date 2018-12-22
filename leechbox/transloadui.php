<style type="text/css">
body {color:#ffffff;}
table {color:#000}
</style>     

        <section class="content">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-download"></i> Download</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
<table class="transloadui table table-bordered">
<tr>
<td></td>
<td>
<div class="progressouter">
<div style="width:398px">
<div id="progress" class="progressdown"></div>
</div>
</div>
</td>
<td></td>
</tr>
<tr>
<td align="left" id="received">0 KB</td>
<td align="center" id="percent">0%</td>
<td align="right" id="speed">0 KB/s</td>
</tr>
</table>
<br />
<div id="resume" align="center"></div>
			</div>
		</div>
	</section>
<script type="text/javascript">
/* <![CDATA[ */
function pr(percent, received, speed)
{
	document.getElementById("received").innerHTML = '<b>' + received + "<\/b>";
	document.getElementById("percent").innerHTML = '<b>' + percent + "%<\/b>";
	document.getElementById("progress").style.width = percent + '%';
	document.getElementById("speed").innerHTML = '<b>' + speed + " KB\/s<\/b>";
	document.title = percent + '% Downloaded';
	return true;
}

function mail(str, field)
{
	document.getElementById("mailPart." + field).innerHTML = str;
	return true;
}
/* ]]> */
</script>
<br />