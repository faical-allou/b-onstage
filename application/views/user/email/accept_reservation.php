<html>

<body>

	<h1 style="font-size:18px;font-family:'Arial',sans-serif;color:#8e2c86;"><?php echo lang("hello") ?> <?=$pseudo?>,</h1>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><?php echo lang("users_rese_accepted_email_txt1") ?></p>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("users_rese_refuse_email_txt2") ?> : </strong><?=$reservation_id?></p>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("users_calendar_create_location") ?> : </strong><?=$stage_name?></p>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("date") ?> : </strong><?=$event_date?></p>		

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("users_rese_fees") ?> : </strong><?=$reservation?>€</p>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?php echo lang("users_rese_accepted_email_txt2") ?></p>

	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?=anchor($url_account, lang("users_rese_accepted_email_txt3"),array('style'=>'color:#8e2c86;'))?></p>	

	<?php echo lang("users_rese_accepted_email_txt4") ?>

</body>

</html>