<div id="content">
	
	<ul class="breadcrumb">
		<li><a href="<?=site_url('admin')?>">Home</a> <span class="divider">/</span></li>		
		<li class="active">Tools</li>
    </ul>
	
	<div class="p-20">	
		<?php if($message) {?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<?=$message?>
			</div>
		<?php } ?>
		<?php if(isset($nb_events)){ ?>
			<div class="alert alert-success"><?=$nb_events?> Events created.</div>
		<?php } ?>
		<!--show stages -->
		<form method="post" action="">
			<label for="event-id">Event ID</label>
			<input name="event-id" id="event-id">			
			<label for="date-start">Start Date <small>(YYYY-MM-DD)</small></label>
			<input name="date-start" id="date-start" placeholder="2010-01-20">			
			<label for="date-end">End Date <small>(YYYY-MM-DD)</small></label>
			<input name="date-end" id="date-end" placeholder="2010-01-20">
			<br>
			<label for="monday"><input type="checkbox" name="event-days[]" id="monday" value="1"> Monday</label>
			<label for="tuesday"><input type="checkbox" name="event-days[]" id="tuesday" value="2"> Tuesday</label>
			<label for="wednesday"><input type="checkbox" name="event-days[]" id="wednesday" value="3"> Wednesday</label>
			<label for="thursday"><input type="checkbox" name="event-days[]" id="thursday" value="4"> Thursday</label>
			<label for="friday"><input type="checkbox" name="event-days[]" id="friday" value="5"> Friday</label>
			<label for="saturday"><input type="checkbox" name="event-days[]" id="saturday" value="6"> Saturday</label>
			<label for="sunday"><input type="checkbox" name="event-days[]" id="sunday" value="7"> Sunday</label>
			<br><br>
			<button type="submit" class="btn btn-primary btn-large">SUBMIT</button>		
		</form>
		
	</div>
</div>
