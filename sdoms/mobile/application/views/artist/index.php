<div id="content">

	<ul class="breadcrumb">
		<li><a href="<?=site_url('admin')?>">Home</a> <span class="divider">/</span></li>
		<li class="active">Artists</li>
    </ul>

	<div class="p-20">
		<?php if($message) {?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<?=$message?>
			</div>
		<?php } ?>
		<!--<a href="<?=site_url('artist/add')?>" class="btn btn-primary btn-large">Add artist</a>-->
		<!--show artists -->
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="artist-list">
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
				<?php foreach($artists as $artist) { ?>
					<tr>
						<!--email-->
						<td><?=$artist['email']?></td>
						<!--username-->
						<td><?=$artist['username']?></td>
						<!--company-->
						<td><?=$artist['company']?></td>
						<!--city-->
						<td><?=$artist['city']?></td>
						<!--country-->
						<td><?=$artist['country']?></td>
						<!--created on-->
						<td><?=$artist['created_on']?></td>
						
						<!--action-->
						<td>
							<a href="#artist-<?=$artist['user_id']?>" data-toggle="modal"><i class="icon-trash"></i></a>
							<div id="artist-<?=$artist['user_id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Confirm delete artist</h3>
								</div>
								<div class="modal-body">
									<p>Are you sure you want to delete this artist ?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<button class="delete-artist btn btn-primary" data-artist-id="<?=$artist['user_id']?>" data-dismiss="modal">Delete</button>
								</div>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

	</div>
</div>
