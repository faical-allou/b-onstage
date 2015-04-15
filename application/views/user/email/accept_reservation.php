<html>

<body>
<div style="width:device-width; initial-scale=1; text-align: justify; font-family: arial; font-size: 16px;background: #676767;">
    <div style="max-width: 400px;display: block; margin: 10px auto; padding: 20px; border: 1px; background: #ffffff;text-align: center;">
        <div style="text-align: center;"> 
    		<img src="https://gallery.mailchimp.com/6f434fa5389ea8c21ee610a76/images/7e761c53-7542-496f-b9b7-977f04aaf2c1.png" width="240" style="margin: auto;display: block;">
			<span style="font-size:48px; font-weight: bold ;">b-onstage</span>
		</div>
		<div>
	<h1 style="font-size:18px;font-family:'Arial',sans-serif;color:#8e2c86;"><?php echo lang("hello") ?> <?=$pseudo?>,</h1>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><?php echo lang("users_rese_accepted_email_txt1") ?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("users_calendar_create_location") ?> : </strong><?=$stage_name?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("date") ?> : </strong><?=$event_date?></p>		
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;"><strong><?php echo lang("users_rese_fees") ?> : </strong><?=$reservation?>€</p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?php echo lang("users_rese_accepted_email_txt2") ?></p>
	<p style="font-size:15px;font-family:'Arial',sans-serif;color:#3a3a3a;font-weight:bold;"><?=anchor($url_account, lang("users_rese_accepted_email_txt3"),array('style'=>'color:#8e2c86;'))?></p>	
		</div>
	  
	<?php echo lang("users_rese_accepted_email_txt4") ?>
	
		<div style="font-size: 12px; text-align: left;">	
		<?php echo lang("email_footer") ?>
		</div>
	
	</div>	
</div>	
	
</body>

</html>