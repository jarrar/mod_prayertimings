<?php // No direct access
defined('_JEXEC') or die ;
?>

<style type="text/css">
body{background-color: #F8F8F8;}

td {
        color:#3D3D3D;
	font-family:tahoma;
	font-size: 12px;
}


.top
{
	font-family:tahoma;
	color:#3D3D3D;
	font-size: 11px;
	font-weight: bold;
	text-decoration:none;

}
.top:hover
{
	font-family:tahoma;
	color:#3D3D3D;
	font-size: 11px;
	font-weight: bold;
	text-decoration:underline;

}

.module-content {
    padding: 0px;
}

.highlight {background-color: #f5f5f5}

table.namaz, th.namaz, td.namaz, tr.namaz {
    border: 0px solid black;
    border-collapse: collapse;
    font-family:tahoma;
	font-size: 12px;
	
<!--
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 5px;
-->

</style>
<table class="namaz" style="padding: 0px">
	<tr><td class="namaz" width="200"><?php echo $today_date?></td></tr>
	<tr><td class="namaz">
	<table class="namaz" cellpadding="0" cellspacing="0" style="padding: 0px>
		<?php
		foreach ($namaz_times as $key => $value) {
			echo "<TR class=\"namaz\" align=\"right\">";
			echo "<td class=\"namaz\">{$key}:</td>";
			$namaz_time = date('g:i', strtotime($value));
			echo "<td class=\"namaz\" align=\"right\">{$namaz_time}</td>";
			echo "</TR>";
		}
		?>
		</table>
		</tr>
	</td>
	</tr>
</table
