<?php
// No direct access
defined('_JEXEC') or die; ?>

<!--?php echo $hello; ?-->

<table align="left">
	<tr>
		<td>
		<table id="namazTable" cellSpacing="0" cellPadding="0" width="500" border="0">
			<TR>
				<?php
				foreach ($namaz_times as $key => $value) {
					echo "<td>{$key}</td>";
				}
				?>
			</TR>
			<tr>
				<?php
				foreach ($data as $key => $value) {
					# conversion into 12 Hr time
					$namaz_time = date('g:i a', strtotime($value));
					echo "<td>{$namaz_time}</td>";
				}
				?>
			</tr>
		</table>
</table>
