<div id="content">
	
	<ul class="breadcrumb">
		<li><a href="<?=site_url('admin')?>">Home</a> <span class="divider">/</span></li>		
		<li class="active">Stages</li>
    </ul>
	
	<div class="p-20">	
		<?php if($message) {?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<?=$message?>
			</div>
		<?php } ?>
		<a href="<?=site_url('stage/add')?>" class="btn btn-primary btn-large">Add stage</a>
		<!--show stages -->
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="stage-list">
			<thead>
				<tr>
					<th>Email</th>
					<th>Username</th>
					<th>Company</th>
					<th>City</th>
					<th>Country</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($stages as $stage) { ?>
					<tr>
						<!--email-->
						<td><?=$stage['email']?></td>
						<!--username-->
						<td><?=$stage['username']?></td>
						<!--company-->
						<td><?=$stage['company']?></td>
						<!--city-->
						<td><?=$stage['city']?></td>						
						<!--country-->
						<td><?=$stage['country']?></td>
						<!--action-->
						<td>
							<a href="#stage-<?=$stage['id']?>" data-toggle="modal"><i class="icon-trash"></i></a>
							<div id="stage-<?=$stage['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Confirm delete stage</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete this stage ?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<button class="delete-stage btn btn-primary" data-stage-id="<?=$stage['user_id']?>" data-dismiss="modal">Delete</button>
								</div>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>	
		</table>
		
	</div>
</div>
