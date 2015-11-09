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
	echo "<td><a href='index.php?a=download&c=backup&file=$file'>download</a></td>";
	echo "<td><a href='index.php?a=un&c=backup&file=$file'>un</a></td>";
	echo "<td><a href='index.php?a=delete&c=backup&file=$file'>delete</a></td>";
?>
</tr>
<?php
    }
?>
</table>
