<?php

echo $this->session->flashdata('saved');

$iconbar = iconbar(array(
	array('users/add', 'Add User', 'add.gif'),
	array('users/import', 'Import Users', 'user_import.gif'),
));

echo $iconbar;

?>

<table class="ui celled padded table">
	<thead>
		<tr>
			<th>Type</th>
			<th>Enabled</th>
			<th>Username</th>
			<th>Display name</th>
			<th>Last login</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=0;
		if ($users) {
		foreach ($users as $user) { ?>
		<tr class="tr<?php echo ($i & 1) ?>">
			<?php
			$img_type = ($user->authlevel == ADMINISTRATOR ? 'user_administrator.gif' : 'user_teacher.gif');
			$img_enabled = ($user->enabled == 1) ? 'enabled.gif' : 'no.gif';
			?>
			<td width="50" align="center"><img src="<?= base_url("assets/images/ui/{$img_type}") ?>" width="16" height="16"  alt="<?php echo $img_type ?>" /></td>
			<td width="70" align="center"><img src="<?= base_url("assets/images/ui/{$img_enabled}") ?>" width="16" height="16"  alt="<?php echo $img_enabled ?>" /></td>
			<td><?php echo html_escape($user->username) ?></td>
			<td><?php
			if( $user->displayname == '' ){ $user->displayname = $user->username; }
			echo html_escape($user->displayname);
			?></td>
			<td><?php
			if($user->lastlogin == '0000-00-00 00:00:00' || empty($user->lastlogin)){
				$lastlogin = 'Never';
			} else {
				$lastlogin = date("d/m/Y, H:i", strtotime($user->lastlogin));
			}
			echo $lastlogin;
			?></td>
			<td width="45" class="n"><?php
				$actions['edit'] = 'users/edit/'.$user->user_id;
				$actions['delete'] = 'users/delete/'.$user->user_id;
				$this->load->view('partials/editdelete', $actions);
				?>
			</td>
		</tr>
		<?php $i++; } } ?>
	</tbody>
</table>

<?php

echo $pagelinks;

echo $iconbar;

$jsst['name'] = 'st1';
$jsst['id'] = 'jsst-users';
$jsst['cols'] = array("Type", "Enabled", "Username", "Display Name", "Last Login", "Actions");
$this->load->view('partials/js-sorttable', $jsst);
