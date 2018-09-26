<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h2><?php echo lang('index_heading');?></h2>
			<p><?php echo lang('index_subheading');?></p>

			<div id="infoMessage"><?php echo $message;?></div>
			<p><?php echo anchor('index.php/auth/create_user', lang('index_create_user_link'),'class="btn btn-primary"')?> <!--| <?php echo anchor('index.php/auth/create_group', lang('index_create_group_link'),'class="btn btn-primary"')?>--></p>
			<table class="table table-hover table-condensed">
				<tr>
					<th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th><?php echo lang('index_groups_th');?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
				</tr>
				<?php foreach ($users as $user):?>
				<tr>
					<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
					<td>
						<?php foreach ($user->groups as $group):?>
						<?php echo anchor("index.php/auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
						<?php endforeach?>
					</td>
					<td><?php echo ($user->active) ? anchor("index.php/auth/deactivate/".$user->id,lang('index_active_link'),'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Destivar Usuário"') : anchor("index.php/auth/activate/". $user->id,lang('index_inactive_link'),'class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="Ativar Usuário"');?></td>
					<td><?php echo anchor("index.php/auth/edit_user/".$user->id,'<i class="glyphicon glyphicon-edit"></i>','class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="Editar"');?></td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>