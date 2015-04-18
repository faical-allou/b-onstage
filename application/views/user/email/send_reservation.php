<html>
<body>
	<div style="width:device-width; initial-scale=1;padding: 20px; text-align: justify; font-family: arial; font-size: 16px;background: #676767;">
      <div style="max-width: 400px;display: block; margin: 10px auto; padding: 20px; border: 1px; background: #ffffff;text-align: center;">
        <div style="text-align: center;"> 
    		<img src="https://gallery.mailchimp.com/6f434fa5389ea8c21ee610a76/images/7e761c53-7542-496f-b9b7-977f04aaf2c1.png" width="240" style="margin: auto;display: block;">
			<span style="font-size:48px; font-weight: bold ;">b-onstage</span>
		</div>

	<h1 style="color:#8e2c86;"><?php echo lang("hello") ?> <?=$pseudo?>,</h1>	
	<p><?php echo lang("book_req_email_artist_txt1") ?></p>
	<p><strong><?php echo lang("scene") ?> :</strong> <?=$location?></p>
	<p><strong><?php echo lang("date") ?> :</strong> <?=$date?></p>
	<p><strong><?php echo lang("time") ?> :</strong> <?=$schedule?></p>	
	<?php echo lang("book_req_email_artist_txt2") ?>

	<div style="font-size: 12px; text-align: left;">	
		<?php echo lang("email_footer") ?>
	</div>

	   </div>
	</div>
</body>
</html>