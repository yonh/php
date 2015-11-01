<table>
<tr>
	<td>file name</td>
</tr>
<?php
    foreach ($data['list'] as $file) {
?>
<tr>
<?php
	echo "<td>".$file."</td>";
?>
</tr>
<?php
    }
?>
</table>
