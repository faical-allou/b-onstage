<?php foreach($notifications as $notification){ ?>

		<div class="contact-line p-20 clearfix priority-<?=$notification['priority']?>">

			<div class="ml-20 left">

				<?=ucwords(strftime('%A %e %B %Y ', strtotime($notification['stamp']))).lang("at").strftime(' %Hh%M', strtotime($notification['stamp']))?>: <?=heading($notification['description'], 3, 'class="title grey fs-18"')?>

			</div>

		</div>

<?php } ?>