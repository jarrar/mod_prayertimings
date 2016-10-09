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
</style>

<!--?php echo $hello; ?-->
<table align="center">
	<tr><td align="left"><?php echo $today_date?></td></tr>
	<tr><td align="center">
	<table align="left" cellSpacing="0" cellPadding="0" width="100" border="0">
		<!--table id="namazTable" cellSpacing="0" cellPadding="0" width="0" border="0"-->
		<?php
		foreach ($namaz_times as $key => $value) {
			echo "<TR align=\"center\">";
			echo "<td>{$key}</td>";
			$namaz_time = date('g:i', strtotime($value));
			echo "<td>{$namaz_time}</td>";
			echo "</TR>";
		}
		?>
			<!--TR>
				<?php
				foreach ($namaz_times as $key => $value) {
					# conversion into 12 Hr time
					//$namaz_time = date('g:i a', strtotime($value));
					$namaz_time = date('g:i', strtotime($value));

					echo "<td>{$namaz_time}</td>";
				}
				?>
			</TR-->
		</table>
		</tr>
	</td>
	</tr>
</table>
