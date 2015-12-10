
<?php include 'header.php'; ?>

<table class="ice-table ice-table-hover">
<thead>
	<th>id</th>
    <th>name</th>
    <th>domain name</th>
    <th>git</th>
    <!--<th>document_root</th>-->
    <th>vhost config</th>
    <th>operate</th>
</thead>
<?php
    foreach ($data['list'] as $vhost) {
?>
<tr>
<?php
	echo "<td>".$vhost['id']."</td>";
	echo "<td>".$vhost["name"]."</td>";
	echo "<td><a href='http://".$vhost["domain_name"]."'>".$vhost["domain_name"]."</a></td>";
	echo "<td>".$vhost["git"]."</td>";
// 	echo "<td>".$vhost["document_root"]."</td>";
	echo "<td>".$vhost["vhost_conf_file"]."</td>";
	echo "<td><a href='index.php?c=vhost&a=deployer&id=".$vhost['id']."'>deployer</a> ";
	echo "<a href='index.php?c=vhost&a=update&name=".$vhost['name']."'>update</a> ";
	echo "<a href='index.php?c=backup&a=backup&id=".$vhost['id']."'>backup</a> ";
	echo "<a href='vhost.php?id=".$vhost['id']."'>edit</a> ";
	echo "<a href='vhost_del.php?id=".$vhost['id']."'>delete</a></td>";
?>
</tr>
<?php
						    }
?>
</table>
