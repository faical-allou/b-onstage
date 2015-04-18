<html>
<body >
	<div style="width:device-width; initial-scale=1; padding: 20px; text-align: justify; font-family: arial; font-size: 16px;background: #676767;">
      <div style="max-width: 400px;display: block; margin: auto; padding: 20px; border: 1px; background: #ffffff;text-align: center;">
        <div style="text-align: center;"> 
    		<img src="https://gallery.mailchimp.com/6f434fa5389ea8c21ee610a76/images/7e761c53-7542-496f-b9b7-977f04aaf2c1.png" width="240" style="margin: auto;display: block;">
			<span style="font-size:48px; font-weight: bold ;">b-onstage</span>
		<?php echo lang("signup_active_email_txt1") ?>	
		<?=anchor('/user/activate/'. $id .'/'. $activation, lang("signup_active_email_txt2").$identity)?>
		<br />	
		<span style="font-size: 16px"><?php echo lang("signup_active_email_txt3") ?></span>
		</div>
		<div style="font-size: 12px; text-align: left;">
			<span style="font-size: 12px"><?php echo lang("email_footer") ?></span>
		</div>
	  </div>
	</div>	
</body>
</html>