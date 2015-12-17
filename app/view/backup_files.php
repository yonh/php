
<?php include 'header.php'; ?>

<h1>name: <?php echo $data['vhost']['name']; ?></h1>

<table class="ice-table ice-table-hover">
<thead>
	<th>id</th>
    <th>file name</th>
    <th>备份时间</th>
    <th>operate</th>
</thead>
<?php
foreach ($data['list'] as $backup) {
?>
<tr>
<?php
	echo "<td>".$backup['id']."</td>";
	echo "<td>".$backup["filename"]."</td>";
	echo "<td>".date('Y-m-d H:i:s', $backup["ctime"])."</td>";
	echo "<td><a href='index.php?a=delete&c=backup&id=".$backup['id']."'>delete</a></td>";
    echo "<td><a href='index.php?a=download&c=backup&filename=".$backup['filename']."'>download</a></td>";	
	
?>
</tr>
<?php
}
?>
</table>
