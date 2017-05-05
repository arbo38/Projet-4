
<?php

?>
<table class="table">
	<thead>
		<tr>
			<td>Votre ID</td>
			<td>Pseudo</td>
			<td>Email</td>
			<td>Status</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $user->id ?></td>
			<td><?= $user->username ?></td>
			<td><?= $user->email ?></td>
			<td><?= $user->id ?></td>
		</tr>
	</tbody>
</table> <!-- table.table -->
<div>
<?php 
if($user->isAdmin()){
	echo "<a class='btn btn-primary' href='?page=admin.article.index'>Panneau d'administration</a>";
}
?>
<a class="btn btn-primary" href="?page=logout">Logout</a></div>