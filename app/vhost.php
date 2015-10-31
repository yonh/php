<?php
include 'function.php';

$vhosts = db_get_rows("select * from vhost");
?>

<a href="vhost_add.php">add vhost</a>
<table>
<tr>
        <td>domain name</td>
        <td>git</td>
        <td>document_root</td>
        <td>vhost config</td>
        <td>publish</td>
</tr>
<?php
	foreach ($vhosts as $vhost) {
?>
<tr>
<?php
	echo "<td>".$vhost["domain_name"]."</td>";
	echo "<td>".$vhost["git"]."</td>";
	echo "<td>".$vhost["document_root"]."</td>";
	echo "<td>".$vhost["vhost_conf_file"].".conf</td>";
	echo "<td><a href='deployer.php?id=".$vhost['id']."'>deployer</a><td>";
	echo "<td><a href='backup.php?id=".$vhost['id']."'>backup</a><td>";
	echo "<td><a href='vhost.php?id=".$vhost['id']."'>edit</a>";
	echo "<a href='vhost_del.php?id=".$vhost['id']."'>delete</a></td>";
?>	
</tr>
<?php
	}
?>
</table>
